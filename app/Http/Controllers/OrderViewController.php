<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderViewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function myOrders()
    {
        $orders = Order::where('user_id', auth()->id())
            ->with('items.product')
            ->orderByDesc('id')
            ->get();
        
        return view('orders.my-orders', compact('orders'));
    }

    public function show(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $order->load('items.product');
        return view('orders.show', compact('order'));
    }

    public function itemDetails(Request $request)
    {
        $itemId = $request->get('item_id');
        $item = \App\Models\OrderItem::with('product', 'order')
            ->findOrFail($itemId);
        
        if ($item->order->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        return response()->json($item);
    }

    public function cancel(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        if (!$order->canTransitionTo(Order::STATUS_CANCELLED)) {
            return redirect()->route('orders.show', $order->id)
                ->with('error', 'Cannot cancel ' . $order->status . ' orders.');
        }

        $order->transitionTo(Order::STATUS_CANCELLED, auth()->id());

        return redirect()->route('orders.show', $order->id)
            ->with('success', 'Order cancelled successfully.');
    }
}
