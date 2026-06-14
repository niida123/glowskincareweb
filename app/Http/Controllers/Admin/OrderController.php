<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;

class OrderController extends Controller
{
    public function index()
    {
        return view('admin.layouts.orders.index');
    }

    public function list()
    {
        $orders = Order::with('user', 'items.product')
            ->orderByDesc('id')
            ->get();
        
        return response()->json($orders);
    }

    public function show(Order $order)
    {
        $order->load('user', 'items.product');
        return response()->json($order);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'status' => 'required|string|in:pending,processing,completed,cancelled',
            'total' => 'required|numeric|min:0',
        ]);

        $order = Order::create($data);
        $order->load('user', 'items');
        return response()->json($order, 201);
    }

    public function update(Request $request, Order $order)
    {
        $data = $request->validate([
            'status' => 'required|string|in:pending,processing,completed,cancelled',
            'total' => 'required|numeric|min:0',
        ]);

        $order->update($data);
        $order->load('user', 'items');
        return response()->json($order);
    }

    public function destroy(Order $order)
    {
        $order->items()->delete();
        $order->delete();
        return response()->json(['message' => 'Order deleted']);
    }
}
