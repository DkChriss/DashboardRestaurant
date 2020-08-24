<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Shopping;
use Faker\Generator as Faker;

$factory->define(Shopping::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1,50),
        'name' => $faker->name,
        'price' => $faker->numberBetween(1,50),
        'quantity' => $faker->numberBetween(1,50)
    ];
});
