<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {
        $keyword = $request->query('keyword');
        if (!isset($keyword) || $keyword == '') return redirect()->route('home');

        // ref: https://stackoverflow.com/questions/37464060/laravel-search-database-table-for-partial-match-from-query
        $books = Book::where([
            ['title', 'like', "%$keyword%"]
        ])->paginate(10);

        return view('pages.search', [
            'books' => [
                'items' => $books->items(),
                'pages' => $books->lastPage(),
                'page_number' => $books->currentPage()
            ],
            'orders' => [
                'items' => [],
                'page_number' => 0,
                'pages' => 0
            ],
            'user' => Auth::user(),
            'keyword' => $keyword
        ]);
    }
}
