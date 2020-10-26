<?php

use App\Models\Book;
use App\Models\User;
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
        return view('pages.dashboard', ['username' => 'Sherlock Holmes']);
    });

    Route::get('/book', function () {
        $page_number = Request::query('page') ?? 1;

        return view('pages.books', [
            'books' => [],
            'page_number' => $page_number,
            'pages' => 20,
            'username' => 'Sherlock Holmes'
        ]);
    });

    Route::get('/order', function () {
        $page_number = Request::query('page') ?? 1;

        return view('pages.orders', [
            'orders' => [],
            'page_number' => $page_number,
            'pages' => 20,
            'username' => 'Sherlock Holmes'
        ]);
    });

    Route::get('/customer', function () {
        $page_number = Request::query('page') ?? 1;

        return view('pages.customers', [
            'customers' => [],
            'page_number' => $page_number,
            'pages' => 20,
            'username' => 'Sherlock Holmes'
        ]);
    });

    Route::get('/profile', function () {
        return view('pages.profile', [
            'user' => new User(
                '123', 'teddybear123', 'teddy@gmail.com',
                'Mr', 'Bean', '221B Baker Street',
                'London', 'UK', 'private detective'),
            'username' => 'Sherlock Holmes']);
    });

    Route::get('/setting', function () {
        return view('pages.settings', ['username' => 'Sherlock Holmes']);
    });

});
