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

// $factory->define(station\Station::class, function (Faker $faker) {
//     static $password;

//     return [
//         'station_name' => $faker->name,
//         'station_location' => $faker->unique()->safeEmail,
//         'longitude' => $faker->unique()->safeEmail,
//         'latitude' => $faker->unique()->safeEmail,
//         'station_number' => $faker->unique()->safeEmail,
//         'location' => $faker->unique()->safeEmail,
//         'city' => $faker->unique()->safeEmail,
        
//     ];
// });