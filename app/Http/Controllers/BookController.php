<?php

namespace App\Http\Controllers;

use App\Contracts\BookService;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    private BookService $service;

    public function __construct(BookService $service)
    {
        $this->service = $service;
    }

    public function getAll(Request $request): array
    {
        $name = $request->input('bid');
        echo "<h1>Route is: $name</h1>\n";
        return $this->service->getAll();
    }

    public function get(Request $request, string $bid): ?Book
    {
        $name = $request->input('bid');
        echo "<h1>Route is: $name</h1>\n";
        return $this->service->get($bid);
    }
}
