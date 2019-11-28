<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Invoice;
use Faker\Generator as Faker;

$factory->define(Invoice::class, function (Faker $faker) {
    return [
        'client_id' => \App\Company::all()->keyBy('id')->keys()->random(),
        'vendor_id' => \App\Company::all()->keyBy('id')->keys()->random(),
        'invoice_date' => $faker->date('Y-m-d', 'now'),
        'delivery_date' => $faker->date('Y-m-d', 'now'),
        'due_date' => $faker->date('Y-m-d', 'now'),
    ];
});
