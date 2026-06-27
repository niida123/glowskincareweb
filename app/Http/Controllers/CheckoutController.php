<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Support\DeliveryFee;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect('/cart')->with('error', 'Your cart is empty');
        }

        $cartItems = [];
        $subtotal = 0;

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

        $deliveryConfig = DeliveryFee::config();
        $deliveryFee = 0;
        $deliveryDistanceKm = 0;
        $total = $subtotal;
        $savedLat = auth()->user()->latitude;
        $savedLng = auth()->user()->longitude;
        $savedAddress = auth()->user()->address_line;

        return view('checkout.index', compact(
            'cartItems',
            'subtotal',
            'deliveryConfig',
            'deliveryFee',
            'deliveryDistanceKm',
            'total',
            'savedLat',
            'savedLng',
            'savedAddress'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'confirm' => 'required|accepted',
            'fulfillment_method' => 'required|in:pickup,delivery',
            'address_line' => 'required_if:fulfillment_method,delivery|nullable|string|max:255',
            'city' => 'required_if:fulfillment_method,delivery|nullable|string|max:120',
            'state' => 'nullable|string|max:120',
            'postal_code' => 'nullable|string|max:30',
            'country' => 'nullable|string|max:120',
            'latitude' => 'required_if:fulfillment_method,delivery|nullable|numeric',
            'longitude' => 'required_if:fulfillment_method,delivery|nullable|numeric',
            'delivery_notes' => 'nullable|string|max:1000',
            
        ]);

        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return back()->withErrors('Your cart is empty');
        }
        try {
            $order = DB::transaction(function () use ($request, $cart) {
                $items = [];
                $subtotal = 0;

                foreach ($cart as $productId => $quantity) {
                    $product = Product::lockForUpdate()->find($productId);
                    if (!$product) {
                        throw new \RuntimeException('One of the products is unavailable.');
                    }
                    if ($product->stock !== null && $product->stock < $quantity) {
                        throw new \RuntimeException("Not enough stock for {$product->name}.");
                    }

                    $unitPrice = $product->price;
                    $discountPercent = $product->discount ?? 0;
                    $finalPrice = $unitPrice * (1 - $discountPercent / 100);
                    $lineTotal = $finalPrice * $quantity;
                    $taxAmount = 0;

                    $subtotal += $lineTotal;
                    $items[] = [
                        'product_id' => $productId,
                        'quantity' => $quantity,
                        'unit_price' => $unitPrice,
                        'discount_percent' => $discountPercent,
                        'tax_amount' => $taxAmount,
                        'line_total' => $lineTotal,
                        'price' => $finalPrice,
                    ];

                    // Decrement stock to prevent oversell
                    if ($product->stock !== null) {
                        $product->decrement('stock', $quantity);
                    }
                }

                $delivery = DeliveryFee::calculate(
                    $request->input('fulfillment_method'),
                    $request->input('latitude') !== null ? (float) $request->input('latitude') : null,
                    $request->input('longitude') !== null ? (float) $request->input('longitude') : null,
                );
                $total = $subtotal + (float) $delivery['fee'];

                $order = Order::create([
                    'user_id' => auth()->id(),
                    'total' => $total,
                    'status' => Order::STATUS_PENDING,
                    'fulfillment_method' => $request->input('fulfillment_method'),
                    'delivery_charge' => (float) $delivery['fee'], 
                    'address_line' => $request->input('address_line'),
                    'city' => $request->input('city'),
                    'state' => $request->input('state'),
                    'postal_code' => $request->input('postal_code'),
                    'country' => $request->input('country'),
                    'latitude' => $request->input('latitude'),
                    'longitude' => $request->input('longitude'),
                    'delivery_notes' => $request->input('delivery_notes'),
                ]);

                foreach ($items as $item) {
                    OrderItem::create(array_merge($item, [
                        'order_id' => $order->id,
                    ]));
                }

                return $order;
            });
        } catch (\RuntimeException $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }

        // Clear cart
        session()->forget('cart');

        return redirect()->route('orders.success', ['order' => $order->id])
                        ->with('success', 'Order placed successfully!');
    }

    public function success(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $order->load('items.product');
        return view('checkout.success', compact('order'));
    }
}
