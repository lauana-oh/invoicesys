<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Company;
use App\Models\Invoice;
use Faker\Generator as Faker;

$factory->define(Invoice::class, function (Faker $faker) {
    return [
        'client_id' => Company::all()->keyBy('id')->keys()->random(),
        'vendor_id' => Company::all()->keyBy('id')->keys()->random(),
        'due_date' => $faker->dateTimeBetween('today','+3 month')->format('Y-m-d'),
        'delivery_date' => $faker->dateTimeBetween('-1 month', 'today')->format('Y-m-d'),
        'invoice_date' => $faker->dateTimeBetween('-3 month', '-1 month')->format('Y-m-d'),
        'status_id' => \App\Models\Status::all()->keyBy('id')->keys()->random(),
    ];
});
