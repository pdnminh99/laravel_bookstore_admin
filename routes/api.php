<?php

use App\Http\Controllers\BookController;
use App\Http\Middleware\VerifyBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//
//Route::middleware([VerifyBook::class])->group(function () {
//    echo "<h1>Accessing book controllers<h1/>\n";
//
//    Route::get('/', [BookController::class, 'getAll']);
//
//    Route::get('/{bid}', [BookController::class, 'get']);
//});
