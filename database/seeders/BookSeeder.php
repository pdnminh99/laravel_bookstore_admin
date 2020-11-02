<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BookSeeder extends Seeder
{
    public function run()
    {
        DB::table('categories')->insert([
            'name' => 'Sci-fi',
            'description' => Str::random(10)
        ]);

        DB::table('categories')->insert([
            'name' => 'News',
            'description' => Str::random(10)
        ]);

        DB::table('categories')->insert([
            'name' => 'Comics',
            'description' => Str::random(10)
        ]);

        for ($i = 0; $i < 100; $i++) {
            DB::table('books')->insert([
                'title' => Str::random(10),
                'author' => Str::random(10),
                'publisher' => Str::random(10),
                'description' => Str::random(10),
                'price' => rand(0, 9999),
                'in_stock' => rand(0, 100),
                'pages' => rand(0, 100),
                'year_of_publishing' => rand(0, 2000),
                'category_id' => 1
            ]);
        }
    }
}
