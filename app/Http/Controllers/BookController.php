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
        $paginator = Book::query()->orderBy('updated_at', 'DESC')->paginate(10);
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
        return view('pages.books-detail',
            [
                'book' => new Book(),
                'username' => $this->authManager->user()->name,
                'action' => "/books",
                'method' => "POST"
            ]);
    }

    public function store(Request $request)
    {
        $current_year = date('Y');

        $validated_book = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'string|max:255',
            'publisher' => 'string|max:255',
            'description' => 'string',
            'price' => 'required|integer|min:0',
            'in_stock' => 'required|integer|min:0',
            'pages' => 'required|integer|min:0',
            'year_of_publishing' => "required|integer|between:0,$current_year"
        ]);

        Book::insert($validated_book);
        return redirect()
            ->route('books.index', ['page' => 1])
            ->with('success', "Book title ${validated_book['title']} created successfully.");
    }

    public function show(string $id)
    {
        $book = Book::find($id);
        return view('pages.books-detail',
            [
                'book' => $book,
                'username' => $this->authManager->user()->name,
                'action' => "/books/$id",
                'method' => "PATCH"
            ]);
    }

    public function update(Request $request, $id)
    {
        $current_year = date('Y');

        $validated_book = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'string|max:255',
            'publisher' => 'string|max:255',
            'description' => '',
            'price' => 'required|integer|min:0',
            'in_stock' => 'required|integer|min:0',
            'pages' => 'required|integer|min:0',
            'year_of_publishing' => "required|integer|between:0,$current_year"
        ]);

        Book::where('id', $id)->update($validated_book);
        return back()->with('success', 'Book info updated successfully');
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return back()->with('success', "Book with id $book->id is deleted successfully");
    }
}
