<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Card;
use App\Item;
use Faker\Generator as Faker;

$factory->define(Card::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->sentence,
        'item_id' => function(){
            return Item::all()->random();
        },
    ];
});
