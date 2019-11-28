<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Invoice;
use Faker\Generator as Faker;

$factory->define(Invoice::class, function (Faker $faker) {
    return [
        'client_id' => \App\Company::all()->keyBy('id')->keys()->random(),
        'vendor_id' => \App\Company::all()->keyBy('id')->keys()->random(),
        'invoice_date' => $faker->date('Y-m-d', 'delivery_date'),
        'delivery_date' => $faker->date('Y-m-d', 'due_date'),
        'due_date' => $faker->date('Y-m-d', '+1 month'),
        'status_id' => \App\Status::all()->keyBy('id')->keys()->random(),
    ];
});
