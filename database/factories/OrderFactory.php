<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    static $combinations;
    static $invoiceIdFactory;
    static $productIdFactory;
    $combinations = $combinations ?: [[]];
    do {
        $invoiceIdFactory = \App\Invoice::all()->keyBy('id')->keys()->random();
        $productIdFactory = \App\Product::all()->keyBy('id')->keys()->random();
    } while (in_array([$invoiceIdFactory, $productIdFactory], $combinations));
    $combinations[] = [$invoiceIdFactory, $productIdFactory];
    
    return [
        'invoice_id' => $invoiceIdFactory,
        'product_id' => $productIdFactory,
        'quantity' =>  $faker->numberBetween(1,20),
        'unit_price' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 100),
        'product_iva' => $faker->randomFloat($nbMaxDecimals = 4, $min = 0, $max = 0.5000),
    ];
});
