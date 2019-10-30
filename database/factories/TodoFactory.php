<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Todo;
use Faker\Generator as Faker;
use App\User;
$factory->define(Todo::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
         
        'user_id' => function(){
            return User::all()->random();
        },
    ];
});
