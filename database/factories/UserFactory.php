<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(station\User::class, function (Faker $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

 $factory->define(station\Station::class, function (Faker $faker) {
     
     return [
         'station_name' => $faker->company,
         'station_location' => $faker->streetName,
         'longitude' => $faker->longitude,
         'latitude' => $faker->latitude,
         'station_number' => $faker->unique()->numberBetween($min = 0, $max = 2147483647),
         'location' => $faker->streetName,
         'city' => $faker->city,
         'region'=>$faker->address,
         'code' => $faker->postcode,
         'date_opened' => date($format = 'Y-m-d', $min = 'now'),
         'date_closed' => date($format = 'Y-m-d', $min = 'now')
     ];
         
 });

 
 $factory->define(station\Node::class, function (Faker $faker) {

    return [
        
        'txt_key' => $faker->unique()->slug,
        'mac_address' => $faker->unique()->macAddress
    ];
});

$factory->define(station\Sensor::class, function (Faker $faker) {

    return [
        
        'parameter_read' => $faker->unique()->name,
        'identifier_used' => $faker->unique()->name,
        'min_value' => $faker->numberBetween($min = 0, $max = 10),
        'max_value' => $faker->numberBetween($min = 10, $max = 20),
        'report_key_title' => $faker->name,
        'report_key_value' => $faker->name,
        'report_time_interval' => $faker->numberBetween($min = 30, $max = 60)
    ];
});



$factory->define(station\NodeStatus::class, function (Faker $faker) {

    return [
        
        'v_in' => $faker->numberBetween($min = 0, $max = 10),
        'rssi' => $faker->unique()->double,
        'drop' => $faker->unique()->double,
        'vmcu' => $faker->unique()->double,
        'lqi' => $faker->unique()->double,
        'date_time' => $faker->unique()->dateTime
        
    ];
});


$factory->define(station\NodeStatusConfiguration::class, function (Faker $faker) {
     
     return [
         'node_id' => $faker->integer,
         'v_in_label' => $faker->unique()->string,
         'v_in_key_title' => $faker->unique()->string,
         'v_in_key_value' => $faker->unique()->string,
         'v_in_min_value' => $faker->unique()->double,
         'v_in_max_value' => $faker->unique()->double,
         'v_mcu_label' => $faker->unique()->string,
        'v_mcu_key_title' => $faker->unique()->string,
        'v_mcu_key_value' => $faker->unique()->string,
        'v_mcu_min_value' => $faker->unique()->double,
        'v_mcu_max_value' => $faker->unique()->double
     ];
         
 });