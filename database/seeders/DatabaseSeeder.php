<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use App\Models\Item;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->count(3)
            ->create();
        Category::factory()
            ->count(5)
            ->create();
        Book::factory()
            ->count(100)
            ->create();
        Order::factory()
            ->count(50)
            ->create();
        Item::factory()
            ->count(100)
            ->create();
    }
}
