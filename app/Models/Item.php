<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public Book $book;

    public int $count;

    public function __construct(Book $book, int $count)
    {
        $this->book = $book;
        $this->count = $count;
    }

    public function get_cost(): int
    {
        return $this->book->price ?? 0 * $this->count;
    }
}
