<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\OrderController;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Fortify;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/home');
});

Fortify::loginView(function () {
    return view('pages.login');
});

Fortify::registerView(function () {
    return view('pages.register');
});

Fortify::verifyEmailView(function () {
    return view('pages.verify-email');
});

Route::middleware(['verified'])->group(function () {
    Route::get('/home', function () {
        return view('pages.dashboard', ['username' => Auth::user()->name]);
    })->name('home');

    Route::get('/search', function () {
        $keyword = Request::query('keyword');
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
            'username' => Auth::user()->name,
            'keyword' => $keyword
        ]);
    });

    Route::resource('books', BookController::class)->except(['edit']);

    Route::resource('orders', OrderController::class);

    Route::get('/users', function () {
        $page_number = Request::query('page') ?? 1;

        return view('pages.customers', [
            'customers' => [],
            'page_number' => $page_number,
            'pages' => 20,
            'username' => Auth::user()->name
        ]);
    });

    Route::get('/profile', function () {
        return view('pages.profile', [
            'user' => Auth::user(),
            'username' => Auth::user()->name]);
    });

    Route::get('/setting', function () {
        return view('pages.settings', ['username' => Auth::user()->name]);
    });

    Route::get('/logout', function () {
        Auth::logout();
        return redirect('/login');
    });

});
