<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Todo;
use App\Item;
use App\Card;
use App\Comment;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        factory(User::class, 10)->create();
        factory(Todo::class, 10)->create();
        factory(Item::class, 10)->create();
        factory(Card::class, 10)->create();
        factory(Comment::class, 10)->create();
    }
}
