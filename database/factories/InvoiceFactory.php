<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Company;
use App\Models\Invoice;
use Faker\Generator as Faker;

$factory->define(Invoice::class, function (Faker $faker) {
    $dueDate = $faker->dateTimeThisYear('+3 month')->format('Y-m-d');
    $deliveryDate = $faker->dateTimeThisYear($dueDate)->format('Y-m-d');
    return [
        'client_id' => Company::all()->keyBy('id')->keys()->random(),
        'vendor_id' => Company::all()->keyBy('id')->keys()->random(),
        'due_date' => $dueDate,
        'delivery_date' => $deliveryDate,
        'invoice_date' => $faker->dateTimeThisYear($deliveryDate)->format('Y-m-d'),
        'status_id' => \App\Models\Status::all()->keyBy('id')->keys()->random(),
    ];
});
