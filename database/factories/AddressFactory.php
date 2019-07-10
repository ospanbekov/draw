<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\User\Address;
use Faker\Generator as Faker;

$factory->define(Address::class, function (Faker $faker) {
    return [
        'country' => $faker->country,
        'city' => $faker->city,
        'address' => $faker->address,
        'zip' => $faker->postcode
    ];
});
