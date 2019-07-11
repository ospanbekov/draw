<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Account;
use Faker\Generator as Faker;

$factory->define(Account::class, function (Faker $faker) {
    return [
        'amount' => $faker->randomNumber(5),
        'currency' => 'USD',
        'description' => 'Refill'
    ];
});
