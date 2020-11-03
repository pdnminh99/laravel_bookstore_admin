<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition()
    {
        return [
            'title' => Str::random(10),
            'author' => Str::random(10),
            'publisher' => Str::random(10),
            'description' => Str::random(10),
            'price' => rand(0, 9999),
            'in_stock' => rand(0, 100),
            'pages' => rand(0, 100),
            'year_of_publishing' => rand(0, 2000),
            'category_id' => rand(1, 5),
            'user_id' => rand(1, 3)
        ];
    }
}
