<?php

use App\Http\Controllers\PostController;
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

// Route::get('/', function () {
//     $a = DB::table('posts')
//         ->whereBetween('created_at', ['2022-06-25', '2022-06-29'])
//         ->count();

//     $a = DB::select('select (select count(id) from posts where date(created_at) <= "2022-06-27" and date(created_at) >= "2022-06-25") as ongoing_event, (select count(id) from posts where date(created_at) <= "2022-06-27" and date(created_at) >= "2022-06-25") as total_event');

//     $b = DB::table('posts')
//         ->select(DB::raw('count(id) as ongoing_event'))
//         ->where('created_at', '<=', "2022-06-27")
//         ->where('created_at', '>=', "2022-06-25")
//         ->get();
//     dd(collect($a), $b);
// });

Route::resource('/post', PostController::class);
