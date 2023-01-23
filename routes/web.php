<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

    $url = "https://pue.zus.pl:8500/ws/zus.channel.platnikRaportyZla:wsdlPlatnikRaportyZla/z us_channel_platnikRaportyZla_wsdlPlatnikRaportyZla_Port";
    $xmlBodyContent = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:zus="http://zus/zus.channel.platnikRaportyZla:wsdlPlatnikRaportyZla">
    <soapenv:Header/>
    <soapenv:Body>
    <zus:PobierzRaporty>
    <login>kwodzinski@cashdirector.com</login>
    <haslo>C@shDirector1</haslo>
    <nip>9151680204</nip>
    <dataOd>2023-01-01</dataOd>
    </zus:PobierzRaporty>
    </soapenv:Body>
    </soapenv:Envelope>';

    $response = Http::withBasicAuth('b2b_platnik_raporty_zla', 'b2b_platnik_raporty_zla')->withHeaders([
        'Content-Type' => 'application/text',
        'SOAPAction' => 'zus_channel_platnikRaportyZla_wsdlPlatnikRaportyZla_Binder_pobierzRaporty'
    ])->send('POST', $url, [
        'body' => $xmlBodyContent
    ]);

    // return response($response->body())->withHeaders([
    //     'Content-Typedata' => 'application/xml'
    // ]);

    $data = simplexml_load_string($response->body());
    $data = $data->children('soapenv', true)->Body->children('ser-root', true)->PobierzRaportyResponse->children()->raporty;
    $data = json_decode(json_encode($data), true)['raport'];

    $final_data = [];
    foreach ($data as $item) {
        $item['dataWygenerowania'];
        $item['zawartosc'];
        $zipStr = $item['zawartosc'];

        $zipStrDecode = base64_decode($zipStr);

        $folder = 'zip-archive';
        File::deleteDirectory(public_path($folder));
        File::makeDirectory($folder, 0777);
        $filename = public_path($folder . "/test.zip");

        $new = fopen($filename, "w");
        fwrite($new, $zipStrDecode);

        $zip = new ZipArchive();
        if ($zip->open($filename) === TRUE) {
            $zip->setPassword('C@shDirector1');
            if ($zip->extractTo(public_path($folder))) {
                $extractedFilename = $zip->getNameIndex(0);
                $final_data[$item['dataWygenerowania']] = simplexml_load_file(public_path($folder . '/' . $extractedFilename));
            } else {
                dd('extraction failed');
            }
            $zip->close();
        } else {
            dd('fail to open zip');
        }
    }
    File::deleteDirectory(public_path($folder));
    dd('here', $final_data);

    return view('welcome');
});
