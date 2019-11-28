<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'invoice_id' => \App\Invoice::all()->keyBy('id')->keys()->random(),
        'product_id' => \App\Product::all()->keyBy('id')->keys()->random(),
        'quantity' =>  $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 100),
        'unit_price' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 2000),
        'productIva' => $faker->randomFloat($nbMaxDecimals = 4, $min = 0, $max = 0.5),
    ];
});
