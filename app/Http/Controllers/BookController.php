<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $page_number = $request->query('page') ?? 1;
        return view('pages.books', [
            'books' => Book::paginate(10)->items(),
            'page_number' => $page_number,
            'pages' => 20,
            'username' => 'Sherlock Holmes'
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

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(string $id)
    {
        Book::find($id)->delete();
        return redirect('books');
    }
}
