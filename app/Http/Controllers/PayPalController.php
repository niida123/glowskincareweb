<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Support\DeliveryFee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class PayPalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function createOrder(Request $request)
    {
        [$items, $subtotal, $deliveryFee, $total] = $this->cartSummary($request);
        if (empty($items)) {
            return response()->json(['message' => 'Cart is empty'], 422);
        }

        $accessToken = $this->getAccessToken();
        if (!$accessToken) {
            return response()->json(['message' => 'Unable to authenticate with PayPal'], 500);
        }

        $baseUrl = $this->paypalBaseUrl();
        $response = Http::withToken($accessToken)
            ->post($baseUrl . '/v2/checkout/orders', [
                'intent' => 'CAPTURE',
                'purchase_units' => [[
                    'amount' => [
                        'currency_code' => 'USD',
                        'value' => number_format($total, 2, '.', ''),
                    ],
                ]],
            ]);

        if (!$response->successful()) {
            return response()->json(['message' => 'Failed to create PayPal order'], 500);
        }

        return response()->json(['id' => $response->json('id')]);
    }

    public function captureOrder(Request $request, string $paypalOrderId)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return response()->json(['message' => 'Cart is empty'], 422);
        }

        $accessToken = $this->getAccessToken();
        if (!$accessToken) {
            return response()->json(['message' => 'Unable to authenticate with PayPal'], 500);
        }

        $baseUrl = $this->paypalBaseUrl();
        $response = Http::withToken($accessToken)
            ->post($baseUrl . "/v2/checkout/orders/{$paypalOrderId}/capture");

        if (!$response->successful() || $response->json('status') !== 'COMPLETED') {
            return response()->json(['message' => 'Payment not completed'], 422);
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

                    if ($product->stock !== null) {
                        $product->decrement('stock', $quantity);
                    }
                }

                $delivery = DeliveryFee::calculate(
                    $request->input('fulfillment_method', 'pickup'),
                    $request->input('latitude') !== null ? (float) $request->input('latitude') : null,
                    $request->input('longitude') !== null ? (float) $request->input('longitude') : null,
                );
                $total = $subtotal + (float) $delivery['fee'];

                $order = Order::create([
                    'user_id' => Auth::id(),
                    'total' => $total,
                    'status' => Order::STATUS_PENDING,
                    'fulfillment_method' => $request->input('fulfillment_method', 'pickup'),
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

                $order->transitionTo(Order::STATUS_PAID, Auth::id());

                return $order;
            });
        } catch (\RuntimeException $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }

        session()->forget('cart');

        return response()->json([
            'order_id' => $order->id,
            'redirect' => route('orders.success', ['order' => $order->id]),
        ]);
    }

    private function cartSummary(Request $request): array
    {
        $cart = session()->get('cart', []);
        $items = [];
        $subtotal = 0;

        foreach ($cart as $productId => $quantity) {
            $product = Product::find($productId);
            if (!$product) {
                continue;
            }
            $finalPrice = $product->price * (1 - $product->discount / 100);
            $lineSubtotal = $finalPrice * $quantity;
            $subtotal += $lineSubtotal;
            $items[] = [
                'product_id' => $productId,
                'quantity' => $quantity,
                'price' => $finalPrice,
            ];
        }

        $delivery = DeliveryFee::calculate(
            $request->input('fulfillment_method', 'pickup'),
            $request->input('latitude') !== null ? (float) $request->input('latitude') : null,
            $request->input('longitude') !== null ? (float) $request->input('longitude') : null,
        );

        $deliveryFee = (float) $delivery['fee'];
        $total = $subtotal + $deliveryFee;

        return [$items, $subtotal, $deliveryFee, $total];
    }

    private function getAccessToken(): ?string
    {
        $clientId = config('services.paypal.client_id');
        $secret = config('services.paypal.secret');
        if (empty($clientId) || empty($secret)) {
            return null;
        }

        $response = Http::asForm()
            ->withBasicAuth($clientId, $secret)
            ->post($this->paypalBaseUrl() . '/v1/oauth2/token', [
                'grant_type' => 'client_credentials',
            ]);

        if (!$response->successful()) {
            return null;
        }

        return $response->json('access_token');
    }

    private function paypalBaseUrl(): string
    {
        $mode = config('services.paypal.mode', 'sandbox');
        return $mode === 'live'
            ? 'https://api-m.paypal.com'
            : 'https://api-m.sandbox.paypal.com';
    }
}
