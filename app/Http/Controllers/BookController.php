<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $paginator = Book::orderBy('id')->paginate(10);
        if ($paginator->currentPage() > $paginator->lastPage()) return redirect()->route('books.index', ['page' => $paginator->lastPage()]);

        // Ref: https://hdtuto.com/article/how-to-get-current-user-details-in-laravel-57
        return view('pages.books', [
            'books' => $paginator->items(),
            'page_number' => $paginator->currentPage(),
            'pages' => $paginator->lastPage(),
            'user' => $this->authManager->user()
        ]);
    }

    public function create()
    {
        return view('pages.books-detail',
            [
                'book' => new Book(),
                'user' => $this->authManager->user(),
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
            'description' => '',
            'price' => 'required|integer|min:0',
            'in_stock' => 'required|integer|min:0',
            'pages' => 'required|integer|min:0',
            'category_id' => 'required|integer|min:0',
            'year_of_publishing' => "required|integer|between:0,$current_year"
        ]);

        $new_book = new Book;
        $new_book->title = $validated_book['title'];
        $new_book->author = $validated_book['author'];
        $new_book->publisher = $validated_book['publisher'];
        $new_book->description = $validated_book['description'] ?? '';
        $new_book->price = $validated_book['price'];
        $new_book->in_stock = $validated_book['in_stock'];
        $new_book->pages = $validated_book['pages'];
        $new_book->category_id = $validated_book['category_id'];
        $new_book->year_of_publishing = $validated_book['year_of_publishing'];
        $new_book->save();

        $file = $request->file('asset');

        if (!is_null($file) && $file->isValid()) {
            $type = $file->getClientOriginalExtension();
            $image = $new_book->id . '.' . $type;

            /**
             * Check this solution:
             * https://stackoverflow.com/questions/45619248/laravel-5-4-fopen-filename-cannot-be-empty
             */

            $file->storeAs("books", $image, 'public');
            $new_book->image = $image;
            $new_book->save();
        }

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
                'user' => $this->authManager->user(),
                'action' => "/books/$id",
                'method' => "PATCH"
            ]);
    }

    public function update(Request $request, Book $book)
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
            'category_id' => 'required|integer|min:0',
            'year_of_publishing' => "required|integer|between:0,$current_year"
        ]);

        $book->title = $validated_book['title'];
        $book->author = $validated_book['author'];
        $book->publisher = $validated_book['publisher'];
        $book->description = $validated_book['description'];
        $book->price = $validated_book['price'];
        $book->in_stock = $validated_book['in_stock'];
        $book->pages = $validated_book['pages'];
        $book->category_id = $validated_book['category_id'];
        $book->year_of_publishing = $validated_book['year_of_publishing'];

        $file = $request->file('asset');

        if (!is_null($file) && $file->isValid()) {
            if (!is_null($book->image))
                Storage::disk('public')
                    ->delete("storage/books/" . $book->image);

            $type = $file->getClientOriginalExtension();
            $image = $book->id . '.' . $type;
            $file->storeAs("books", $image, 'public');
            $book->image = $image;
        }

        $book->save();
        return redirect()
            ->route('books.show', ['book' => $book->id])
            ->with('success', 'Book info updated successfully');
    }

    public function destroy(Book $book)
    {
        if (!is_null($book->image)) Storage::disk('public')
            ->delete("storage/books/" . $book->image);
        $book->delete();
        return back()->with('success', "Book with id $book->id is deleted successfully");
    }
}
