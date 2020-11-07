<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    private AuthManager $authManager;

    public function __construct(AuthManager $authManager)
    {
        $this->authManager = $authManager;
    }

    public function __invoke(Request $request)
    {
        $keyword = $request->query('keyword');
        if (!isset($keyword) || $keyword == '') return redirect()->route('home');

        // ref: https://stackoverflow.com/questions/37464060/laravel-search-database-table-for-partial-match-from-query
        $books = Book::query()
            ->where('title', 'like', "%$keyword%")
            ->orWhere('author', 'like', "%$keyword%")
            ->orWhere('publisher', 'like', "%$keyword%")
            ->take(15)
            ->get()
            ->all();

        $orders = Order::query()
            ->where('customer_name', 'like', "%$keyword%")
            ->orWhere('customer_phone', 'like', "%$keyword%")
            ->orWhere('customer_address', 'like', "%$keyword%")
            ->orWhere('customer_country', 'like', "%$keyword%")
            ->orWhere('customer_city', 'like', "%$keyword%")
            ->take(15)
            ->get()
            ->all();

        $categories = Category::query()
            ->where('name', 'like', "%$keyword%")
            ->take(15)
            ->get()
            ->all();

        $customers = User::query()
            ->where('name', 'like', "%$keyword%")
            ->orWhere('email', 'like', "%$keyword%")
            ->orWhere('city', 'like', "%$keyword%")
            ->orWhere('country', 'like', "%$keyword%")
            ->orWhere('address', 'like', "%$keyword%")
            ->take(15)
            ->get()
            ->all();

        return view('pages.search', [
            'books' => $books,
            'orders' => $orders,
            'categories' => $categories,
            'customers' => $customers,
            'user' => Auth::user(),
            'keyword' => $keyword
        ]);
    }
}
