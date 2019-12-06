<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->sentence(1, true),
        'description' => $faker->text($maxNbChars = 200),
        'unit_price' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 2000),
        'stock'=>$faker->numberBetween(0,1000),
        'category_id' => \App\Category::all()->keyBy('id')->keys()->random(),
    ];
});
