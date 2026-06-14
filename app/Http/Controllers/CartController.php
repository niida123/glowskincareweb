<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function view()
    {
        $cart = session()->get('cart', []);
        $cartItems = [];
        $subtotal = 0;
        $categories = \App\Models\Category::all();

        foreach ($cart as $productId => $quantity) {
            $product = Product::find($productId);
            if ($product) {
                $finalPrice = $product->price * (1 - $product->discount / 100);
                $lineSubtotal = $finalPrice * $quantity;
                $cartItems[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                    'finalPrice' => $finalPrice,
                    'subtotal' => $lineSubtotal,
                ];
                $subtotal += $lineSubtotal;
            }
        }

        $total = $subtotal;

        return view('cart.index', compact(
            'cartItems',
            'subtotal',
            'total',
            'categories'
        ));
    }

    public function add(Request $request)
    {
        // Handle GET request (redirect to cart)
        if ($request->isMethod('get') && !$request->expectsJson()) {
            return redirect('/cart');
        }

        $productId = $request->get('product_id');
        $quantity = (int) $request->get('quantity', 1);

        if ($quantity <= 0) {
            return response()->json(['success' => false, 'message' => 'Quantity must be at least 1'], 422);
        }

        $product = Product::find($productId);
        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Product not found'], 404);
        }

        $cart = session()->get('cart', []);
        $existingQty = isset($cart[$productId]) ? (int) $cart[$productId] : 0;
        $newQty = $existingQty + $quantity;

        if ($product->stock !== null && $newQty > (int) $product->stock) {
            return response()->json([
                'success' => false,
                'message' => 'Only ' . (int) $product->stock . ' item(s) available in stock'
            ], 422);
        }
        
        if (isset($cart[$productId])) {
            $cart[$productId] += $quantity;
        } else {
            $cart[$productId] = $quantity;
        }

        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'message' => 'Product added to cart',
            'cartCount' => array_sum($cart)
        ]);
    }

    public function update(Request $request)
    {
        $productId = $request->get('product_id');
        $quantity = $request->get('quantity', 1);

        $cart = session()->get('cart', []);

        if ($quantity <= 0) {
            unset($cart[$productId]);
        } else {
            $cart[$productId] = $quantity;
        }

        session()->put('cart', $cart);

        return response()->json(['success' => true, 'message' => 'Cart updated']);
    }

    public function remove(Request $request)
    {
        $productId = $request->get('product_id');
        $cart = session()->get('cart', []);
        
        unset($cart[$productId]);
        
        session()->put('cart', $cart);

        return response()->json(['success' => true, 'message' => 'Item removed from cart']);
    }

    public function clear()
    {
        session()->forget('cart');
        return redirect('/cart')->with('success', 'Cart cleared');
    }
}
