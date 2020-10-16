<?php

namespace App\Contracts;

use App\Models\Book;

class DefaultBookService implements BookService
{

    public function getAll(): array
    {
        echo "Get All init";
        return Book::all();
    }

    public function get(string $bid): ?Book
    {
        echo "Get specific bid = $bid";
        return Book::where('id', $bid)->first();
        // TODO: Implement get() method.
    }

    public function delete(string $bid): ?Book
    {
        echo "Get delete bid = $bid";
        return null;
        // TODO: Implement delete() method.
    }

    public function update(Book $book): bool
    {
        echo "Update";
        return true;
        // TODO: Implement update() method.
    }
}
