<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Vimeo\Laravel\Facades\Vimeo;
use Vimeo\Vimeo as VimeoVimeo;

Route::get('/', function () {
    // $access_token = env('VIMEO_PUBLIC_ACCESS');
    $access_token = env('VIMEO_PRIVATE_ACCESS');
    $client = new VimeoVimeo(env('VIMEO_CLIENT'), env('VIMEO_SECRET'), $access_token);

    $video_uri = '/videos/825739976';
    $response = $client->request($video_uri);
    // dd($response);

    $data['video_data'] = $response['body'];

    // $data['a'] = Vimeo::request('/me/videos', ['per_page' => 10], 'GET');
    // dd($data['a']['body']['data'][0]['uri']);
    // dd($data['a']);

    return view('welcome', $data ?? []);
});

Route::post('vimeo', function (Request $request) {
    $file = $request->file('video');
    $fileName = time() . '_' . $file->getClientOriginalName();
    $filePath = $file->move(public_path(''), $fileName);
    $uri = Vimeo::upload($filePath, [
        'name' => 'test title',
        'description' => 'test description',
        // 'privacy' => ['view' => 'nobody']
    ]);
    unlink($filePath);
    dd($uri);
})->name('vimeo');

Route::get('/vimeo-sign-up', function () {
    $client_id = env('VIMEO_CLIENT');
    $client_secret = env('VIMEO_SECRET');
    $redirect_uri = 'http://127.0.0.1:8000/return';

    $client = new VimeoVimeo($client_id, $client_secret);
    $authorize_url = $client->buildAuthorizationEndpoint($redirect_uri, ['public', 'private']);
    header('Location: ' . $authorize_url);
    dump($authorize_url);
});

Route::get('/return', function () {
    $client_id = env('VIMEO_CLIENT');
    $client_secret = env('VIMEO_SECRET');
    $redirect_uri = 'http://127.0.0.1:8000/return';
    $client = new VimeoVimeo($client_id, $client_secret);

    $code = $_GET['code'];
    $token_response = $client->accessToken($code, $redirect_uri);
    $access_token = $token_response['body']['access_token'];
});
