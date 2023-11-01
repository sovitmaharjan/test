<?php

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
    $response = Http::asForm()->post('http://127.0.0.1:8005/oauth/token', [
        'grant_type' => 'client_credentials',
        'client_id' => 2, // Replace with the actual client ID from the `id` column
        'client_secret' => 'wyNGTgsMDYeCRYgiZJGRUdE5PjEzoXOctIT2q892', // Replace with the actual client secret from the `secret` column
        'scope' => '*',
    ]);
    return $response->json();
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
