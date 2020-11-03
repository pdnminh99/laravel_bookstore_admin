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
        if ($request->query('page') < 1) return redirect()->route('orders.index', ['page' => 1]);
        $paginator = Order::orderBy('updated_at', 'DESC')->paginate(10);
        if ($paginator->currentPage() > $paginator->lastPage()) return redirect()->route('order.index', ['page' => $paginator->lastPage()]);

        return view('pages.orders', [
            'orders' => $paginator->items(),
            'page_number' => $paginator->currentPage(),
            'pages' => $paginator->lastPage(),
            'username' => $this->authManager->user()->name
        ]);
    }

    public function show(string $id, Request $request)
    {
        if ($request->query('page') < 1) return redirect()->to("/orders/$id?page=1");
        $order = Order::find($id);
        $paginator = $order->items()->paginate(10);
        if ($paginator->currentPage() > $paginator->lastPage()) return redirect()->to("/orders/$id?page=>$paginator->lastPage()");

        return view('pages.orders-detail',
            [
                'order' => $order,
                'items' => $paginator->items(),
                'page_number' => $paginator->currentPage(),
                'pages' => $paginator->lastPage(),
                'username' => $this->authManager->user()->name
            ]);
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
