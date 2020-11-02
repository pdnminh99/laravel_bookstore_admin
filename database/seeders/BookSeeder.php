<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    function random_string($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 100; $i++) {
            DB::table('books')->insert([
                'title' => $this->random_string(),
                'author' => $this->random_string(),
                'publisher' => $this->random_string(),
                'description' => '',
                'price' => rand(0, 9999),
                'in_stock' => rand(0, 100),
                'pages' => rand(0, 100),
                'year_of_publishing' => rand(0, 2000)
            ]);
        }

        DB::table('categories')->insert([
            'name' => 'Sci-fi',
            'description' => ''
        ]);

        DB::table('categories')->insert([
            'name' => 'News',
            'description' => ''
        ]);

        DB::table('categories')->insert([
            'name' => 'Comics',
            'description' => ''
        ]);
    }
}
