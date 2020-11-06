<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Cable;
use Faker\Generator as Faker;

$factory->define(Cable::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'color' => $faker->hexcolor,
        'dotted' => 0,
        'size' => 4,
    ];
});
