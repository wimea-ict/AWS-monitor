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
         'station_name' => $faker->name,
         'station_location' => $faker->unique()->safeEmail,
         'longitude' => $faker->unique()->safeEmail,
         'latitude' => $faker->unique()->safeEmail,
         'station_number' => $faker->unique()->safeEmail,
         'location' => $faker->unique()->safeEmail,
         'city' => $faker->unique()->safeEmail,
        'code' => $faker->unique()->safeEmail,
        'date_opened' => $faker->unique()->safeEmail,
        'date_closed' => $faker->unique()->safeEmail
     ];
         
 });

 
 $factory->define(station\Node::class, function (Faker $faker) {

    return [
        'station_id' => $faker->integer,
        'txt_key' => $faker->unique()->string,
        'mac_address' => str_random(10)
    ];
});

$factory->define(station\Sensor::class, function (Faker $faker) {

    return [
        'node_id' => $faker->integer,
        'parameter_read' => $faker->unique()->string,
        'identifier_used' => $faker->unique()->string,
        'min_value' => $faker->unique()->string,
        'max_value' => $faker->unique()->string,
        'report_key_title' => $faker->unique()->string,
        'report_key_value' => $faker->unique()->string,
        'report_time_interval' => str_random(10)
    ];
});



$factory->define(station\NodeStatus::class, function (Faker $faker) {

    return [
        'node_id' => $faker->integer,
        'v_in' => $faker->unique()->double,
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