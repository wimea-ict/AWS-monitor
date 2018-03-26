<?php

use Faker\Generator as Faker;

$factory->define(station\Station::class, function (Faker $faker) {
    return [
        //
        /* 
        * The city, region should come from a fixed set of locations.
        */
        'station_name' => $faker->unique()->firstName,
        'station_location' => $faker->unique()->state,
        'longitude' => $faker->unique()->longitude,
        'latitude' => $faker->unique()->latitude,
        'station_number' => $faker->unique()->longitude,
        'location' => $faker->unique()->longitude,
        'city' => $faker->randomElement($array = array('Kampala','Mbarara','Rukungiri','Gulu','Jinja')),
        'region' => $faker->randomElement($array = array('Northern','Western','Eastern','Southern')),
        'code' => $faker->unique()->postcode,
        'date_opened' => $faker->unique()->longitude,
        'date_closed' => $faker->unique()->longitude,
    ];
});
