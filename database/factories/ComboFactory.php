<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Combo;
use Faker\Generator as Faker;

$factory->define(Combo::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'price' => $faker->numberBetween(1,50),
        'dish_id' => $faker->numberBetween(1,10),
        'drink_id' => $faker->numberBetween(1,10),
        'description' => $faker->address,
    ];
});
