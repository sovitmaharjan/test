<?php

use App\Events\FormSubmitted;
use App\Http\Controllers\HomeController;
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
    return view('welcome');
});

Route::get('/counter', function() {
    return view('counter');
});

Route::get('/sender', function() {
    return view('sender');
});

Route::post('/sender', function() {
    $text = request()->text;
    event(new FormSubmitted($text));
    // return view('sender');
});

Route::get('test', function () {
    event(new App\Events\MyEvent('notification test'));
    return "Event has been sent!";
});

Route::get('/notify', [HomeController::class, 'notify']);