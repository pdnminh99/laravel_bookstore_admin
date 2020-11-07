<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use App\Models\Item;
use App\Models\Order;
use Illuminate\Http\Request;
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
    return redirect('/books?page=1');
})->name('home');

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
    Route::get('/search', SearchController::class);

    Route::resource('books', BookController::class)
        ->except(['edit']);

    Route::resource('categories', CategoryController::class);

    Route::get('orders/filter', function (Illuminate\Http\Request $request) {
        $filters = $request->session()->get('filters');

        if (!isset($filters['creation_date'])) {
            $filters['creation_date'] = 'ASC';
        }
        if (!isset($filters['status'])) {
            $filters['status'] = 'NONE';
        }
        if (!isset($filters['from'])) {
            $filters['from'] = date('Y-m-d', 0);
        }
        if (!isset($filters['to'])) {
            $filters['to'] = date('Y-m-d');
        }

        return view('pages.orders-filter', [
            'filters' => $filters,
            'user' => Auth::user()
        ]);
    });

    Route::delete('orders/items/{order}/{item}', function (Order $order, Item $item) {
        $item_name = $item->book->title;
        $item->delete();
        return redirect()
            ->route('orders.show', ['order' => $order->id])
            ->with('success', "Item $item_name is deleted successfully!");
    });

    Route::post('orders/filter', function (Request $request) {
        $earliest_date = date('Y-m-d', 0);
        $today = date('Y-m-d');
        $from = $request->input('from');
        $to = $request->input('to');

        $filters = $request->validate([
            'from' => "required|date_format:Y-m-d|before_or_equal:$to|after_or_equal:$earliest_date",
            'to' => "required|date_format:Y-m-d|before_or_equal:$today|after_or_equal:$from",
            'status' => 'required|string',
            'creation_date' => 'required|string'
        ]);
        session(['filters' => $filters]);
        return redirect()->to('/orders?page=1');
    });

    Route::resource('orders', OrderController::class)
        ->only(['index', 'show', 'update', 'destroy']);

    Route::resource('users', UserController::class)
        ->only(['index', 'show', 'update']);

    Route::get('/logout', function () {
        Auth::logout();
        return redirect('/login');
    });

});
