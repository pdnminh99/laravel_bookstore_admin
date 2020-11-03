<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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

    Route::get('/search', SearchController::class);

    Route::resource('books', BookController::class)
        ->except(['edit']);

    Route::resource('categories', CategoryController::class);

    Route::resource('orders', OrderController::class)
        ->only(['index', 'show', 'update', 'destroy']);

    Route::resource('users', UserController::class)
        ->only(['index', 'show', 'update']);

    Route::get('/setting', function () {
        return view('pages.settings', ['username' => Auth::user()->name]);
    });

    Route::get('/logout', function () {
        Auth::logout();
        return redirect('/login');
    });

});
