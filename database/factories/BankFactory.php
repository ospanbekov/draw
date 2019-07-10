<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\User\Account\Bank;
use Faker\Generator as Faker;

$factory->define(Bank::class, function (Faker $faker) {
    return [
        'account' => $faker->bankAccountNumber
    ];
});
