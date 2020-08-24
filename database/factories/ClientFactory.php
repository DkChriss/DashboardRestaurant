<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Client;
use Faker\Generator as Faker;

$factory->define(Client::class, function (Faker $faker) {
    return [
        'ci' => $faker->unique()->randomNumber($nbDigits = 8),
        'name' => $faker->name,
        'lastname' => $faker->lastname,
        'user_id' => $faker->numberBetween(1,50)
    ];
});
