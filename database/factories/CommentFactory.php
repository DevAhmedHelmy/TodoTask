<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Card;
use App\Comment;
use App\User;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
         
        'comment' => $faker->sentence,
        'user_id' => function(){
            return User::all()->random();
        },
        'card_id' => function(){
            return Card::all()->random();
        },
    ];
});
