<?php

use App\Models\Route as ModelsRoute;
use Illuminate\Http\Request;
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

Route::get('/route', function () {
    $route = ModelsRoute::all();
    return view('route', compact('route'));
})->name('route');

Route::get('/route-detail/{id}', function (Request $request) {
    $route_detail = ModelsRoute::find($request->id);
    return view('route-detail', compact('route_detail'));
})->name('route-detail');

Route::get('/route-detail-edit/{route_id}/{sub_location_id}', function (Request $request) {
    //editing pivot table without detaching other pivot values
    
    // dd($request->sub_location_id);
    $route_detail = ModelsRoute::find($request->route_id);
    $status = $route_detail->subLocation->where('id', $request->sub_location_id)->first()->pivot->status == 'disable' ? 'enable' : 'disable';
    // dd($route_detail->subLocation->where('id', $request->sub_location_id)->first()->pivot->status, $status);
    $route_detail_edit = $route_detail->subLocation()->sync([$request->sub_location_id => ['status' => $status]], false);
    // $route_detail_edit = $route_detail->subLocation()->updateExistingPivot($request->sub_location_id, ['status'  => 'disable']);
    return back();
    return route('route-detail', $route_detail->id);
})->name('route-detail-edit');
