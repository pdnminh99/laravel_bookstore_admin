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
        $filters = $request->session()->get('filters');

        $status = $filters['status'] ?? 'NONE';
        $creation_date = $filters['creation_date'] ?? 'ASC';
        $from = $filters['from'] ?? date('Y-m-d', 0);
        $to = $filters['to'] ?? date('Y-m-d');

        $paginator = ($status != 'NONE') ?
            Order::where('status', '=', $status)->orderBy('created_at', $creation_date) :
            Order::orderBy('created_at', $creation_date);

        $paginator = $paginator
            ->whereDate('created_at', '>=', $from)
            ->whereDate('created_at', '<=', $to)
            ->paginate(10);

        if ($paginator->currentPage() > $paginator->lastPage()) return redirect()->route('order.index', ['page' => $paginator->lastPage()]);

        return view('pages.orders', [
            'orders' => $paginator->items(),
            'page_number' => $paginator->currentPage(),
            'pages' => $paginator->lastPage(),
            'user' => $this->authManager->user()
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
                'user' => $this->authManager->user()
            ]);
    }

    public function update(Request $request, $id)
    {
        $validated_order = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:255',
            'customer_address' => 'required|string|max:255',
            'customer_country' => '',
            'customer_city' => '',
            'note' => '',
            'status' => 'required|string'
        ]);

        Order::where('id', $id)->update($validated_order);
        return back()->with('success', 'Order info updated successfully');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return back()->with('success', "Order with id $order->id is deleted successfully");
    }
}
