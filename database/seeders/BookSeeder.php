<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('books')->insert([
            'title' => 'Harry Potter and the Philosopher\'s Stone',
            'author' => 'J.K ROWLING',
            'publisher' => 'BLOOMSBURY CHILDRENS BOOKS',
            'description' => '',
            'price' => 999,
            'in_stock' => 10,
            'pages' => 200,
            'year_of_publishing' => 2016
        ]);

        DB::table('books')->insert([
            'title' => 'Harry Potter and the Philosopher\'s Stone',
            'author' => 'J.K ROWLING',
            'publisher' => 'BLOOMSBURY CHILDRENS BOOKS',
            'description' => '',
            'price' => 999,
            'in_stock' => 10,
            'pages' => 200,
            'year_of_publishing' => 2016
        ]);

        DB::table('books')->insert([
            'title' => 'Harry Potter and the Philosopher\'s Stone',
            'author' => 'J.K ROWLING',
            'publisher' => 'BLOOMSBURY CHILDRENS BOOKS',
            'description' => '',
            'price' => 999,
            'in_stock' => 10,
            'pages' => 200,
            'year_of_publishing' => 2016
        ]);

        DB::table('books')->insert([
            'title' => 'Harry Potter and the Philosopher\'s Stone',
            'author' => 'J.K ROWLING',
            'publisher' => 'BLOOMSBURY CHILDRENS BOOKS',
            'description' => '',
            'price' => 999,
            'in_stock' => 10,
            'pages' => 200,
            'year_of_publishing' => 2016
        ]);
    }
}
