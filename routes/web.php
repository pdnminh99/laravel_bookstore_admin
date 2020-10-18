<?php

use Illuminate\Support\Facades\Route;

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
    return view('pages.dashboard');
});

Route::get('/book', function () {
    return view('pages.books');
});

Route::get('/order', function () {
    return view('pages.order');
});

Route::get('/customer', function () {
    return view('pages.customers');
});

Route::get('/profile', function () {
    return view('pages.profile');
});

Route::get('/setting', function () {
    return view('pages.settings');
});
