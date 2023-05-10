<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Vimeo\Laravel\Facades\Vimeo;

Route::get('/', function () {
    return view('welcome');
});

Route::post('vimeo', function (Request $request) {
    $file = $request->file('video');
    $fileName = time() . '_' . $file->getClientOriginalName();
    $filePath = $file->move(public_path(''), $fileName);
    $uri = Vimeo::upload($filePath, [
        'name' => 'test title',
        'description' => 'test description',
    ]);
    unlink($filePath);
    dd($uri);
})->name('vimeo');
