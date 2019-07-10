<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Item;
use Faker\Generator as Faker;

$factory->define(Item::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'image' => $faker->imageUrl(),
        'quantity' => $faker->randomDigit
    ];
});
