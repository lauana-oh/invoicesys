<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use App\Models\Company;
use Faker\Generator as Faker;

$factory->define(Company::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'nit'=> $faker->unique()->numerify('###########'),
        'email'=> $faker->optional(0.7)->companyEmail,
        'phone'=> $faker->optional(0.7)->numerify('#########'),
        'address'=>$faker->optional(0.7)->address,
    ];
});
