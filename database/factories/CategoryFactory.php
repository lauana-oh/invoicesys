<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->domainWord,
        'description' => $faker->text($maxNbChars = 200),
        'iva' => $faker->randomFloat($nbMaxDecimals = 4, $min = 0, $max = 0.5000),
    ];
});
