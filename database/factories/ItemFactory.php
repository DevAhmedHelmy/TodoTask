<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Item;
use Faker\Generator as Faker;
use App\Todo;
$factory->define(Item::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
         
        'todo_id' => function(){
            return Todo::all()->random();
        },
    ];
});
