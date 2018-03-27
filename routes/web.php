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

Route::get('/faker',function(){
    $faker = Faker\Factory::create();

    $limit = 15;

    for ($i = 0; $i < $limit; $i++) {
        // $fakers[] = $faker->name . ', Email Address: ' . $faker->unique()->email . ', Contact No' . $faker->phoneNumber;
        // $fakers[] = 'randomElement: '.$faker->unique()->randomElement($array = array('Hello', 'World', 'Am', 'Eugene', 'Owak'));
        $fakers[] = $faker->unique()->postcode;
        // $fakers[] = $faker->unique()->title($gender = null);
    }

    return view('layouts/fakerTests', compact('fakers'));
});