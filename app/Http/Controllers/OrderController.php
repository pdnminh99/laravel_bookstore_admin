<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private AuthManager $authManager;

    public function __construct(AuthManager $authManager)
    {
        $this->authManager = $authManager;
    }

    public function index(Request $request)
    {
//        if ($request->query('page') < 1) return redirect()->route('orders.index', ['page' => 1]);
//        $paginator = Order::paginate(10);
//        if ($paginator->currentPage() > $paginator->lastPage()) return redirect()->route('order.index', ['page' => $paginator->lastPage()]);

        $page_number = $request->query('page') ?? 1;

        return view('pages.orders', [
            'orders' => [],
            'page_number' => $page_number,
            'pages' => 1,
            'username' => $this->authManager->user()->name
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

    public function show(string $id)
    {
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(Order $order)
    {
        $order->delete();
    }
}
