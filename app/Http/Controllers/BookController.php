<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    private AuthManager $authManager;

    public function __construct(AuthManager $authManager)
    {
        $this->authManager = $authManager;
    }

    public function index(Request $request)
    {
        if ($request->query('page') < 1) return redirect()->route('books.index', ['page' => 1]);
        $paginator = Book::paginate(10);
        if ($paginator->currentPage() > $paginator->lastPage()) return redirect()->route('books.index', ['page' => $paginator->lastPage()]);

        // Ref: https://hdtuto.com/article/how-to-get-current-user-details-in-laravel-57
        return view('pages.books', [
            'books' => $paginator->items(),
            'page_number' => $paginator->currentPage(),
            'pages' => $paginator->lastPage(),
            'username' => $this->authManager->user()->name
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        return view('pages.books-detail', ['id' => $id, 'username' => Auth::user()->name]);
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return back();
    }
}
