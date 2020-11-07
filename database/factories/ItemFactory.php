<?php

namespace Database\Factories;

use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    protected $model = Item::class;

    public function definition()
    {
        return [
            'price' => rand(10, 999),
            'count' => rand(1, 10),
            'order_id' => rand(1, 50),
            'book_id' => rand(1, 5)
        ];
    }
}
