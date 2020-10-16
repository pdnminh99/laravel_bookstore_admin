<?php

namespace App\Contracts;

use App\Models\Book;

interface BookService
{
    public function getAll(): array;

    public function get(string $bid): ?Book;

    public function delete(string $bid): ?Book;

    public function update(Book $book): bool;
}
