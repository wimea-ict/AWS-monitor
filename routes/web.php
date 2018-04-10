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
Route::post('updateTenMNode', 'TenMNodeController@update');
Route::resource('configure2mnode', 'TwoMNodeController');
Route::post('updateTwoMNode', 'TwoMNodeController@update');
Route::resource('configuresinknode', 'SinkNodeController');
Route::post('updateSinkNode', 'SinkNodeController@update');
Route::resource('configuregroundnode', 'GroundNodeController');
Route::post('updateGroundNode', 'GroundNodeController@update');
Route::resource('configureproblem', 'ProblemConfigurationsController');
Route::resource('editProblemConfigurations', 'ProblemsController');
Route::post('updateProblemConfigurations', 'ProblemsController@update');

Route::get('/', function () {
    return view('/auth/login');
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
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
