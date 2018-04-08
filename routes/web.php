<?php

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
Route::resource('addstation', 'StationsController');
Route::resource('configurestation', 'ConfigureStaion');
Route::post('updateStation','ConfigureStaion@update');

Route::resource('configure10mnode', 'TenMNodeController');
Route::resource('configure2mnode', 'TwoMNodeController');
Route::resource('configuresinknode', 'SinkNodeController');
Route::resource('configuregroundnode', 'GroundNodeController');
Route::get('/', function () {
    return view('main');
});

Route::get('/ajax-model', function () {

    return view('layouts/ajax-model.php');
});



Route::get('/addnode', function () {
    return view('layouts/addnode');
});

Route::get('/configurenode', function () {
    return view('layouts/configurenode');
});

Route::get('/addsensor', function () {
    return view('layouts/addsensor');
});

Route::get('/configuresensor', function () {
    return view('layouts/configuresensor');
});

Route::get('/tester', 'AnalyzerController@analyze');