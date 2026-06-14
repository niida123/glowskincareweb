<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Product;

class OrderItemController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        $item = OrderItem::create($data);
        $item->load('product', 'order');
        return response()->json($item, 201);
    }

    public function update(Request $request, OrderItem $item)
    {
        $data = $request->validate([
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        $item->update($data);
        $item->load('product', 'order');
        return response()->json($item);
    }

    public function destroy(OrderItem $item)
    {
        $item->delete();
        return response()->json(['message' => 'Item deleted']);
    }
}
