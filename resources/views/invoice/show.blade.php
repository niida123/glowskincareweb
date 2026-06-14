<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print {
            .no-print { display: none !important; }
            .card { box-shadow: none; border: none; }
        }
        .invoice-header { border-bottom: 2px solid #eee; padding-bottom: 1rem; margin-bottom: 1rem; }
        .brand { font-weight: 700; font-size: 1.25rem; }
        .status { text-transform: capitalize; }
        .totals { font-size: 1.1rem; }
        .totals .grand { font-size: 1.3rem; font-weight: 700; }
    </style>
</head>
<body>
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center invoice-header">
            <div>
                <div class="brand">Glow Skincare</div>
                <small class="text-muted">Invoice</small>
            </div>
            <div class="text-end">
                <div><strong>Invoice #</strong> {{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</div>
                <div><strong>Date:</strong> {{ $order->created_at->format('M d, Y') }}</div>
                <div class="status"><strong>Status:</strong> {{ ucfirst($order->status) }}</div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <h6>Bill To</h6>
                <div>{{ $order->user->name }}</div>
                <div class="text-muted">{{ $order->user->email }}</div>
            </div>
            <div class="col-md-6">
                <h6>Fulfillment</h6>
                <div>{{ ucfirst($order->fulfillment_method ?? 'delivery') }}</div>
                @if(($order->fulfillment_method ?? 'delivery') === 'delivery')
                    <div class="text-muted">
                        {{ $order->address_line }}
                        @if($order->city) , {{ $order->city }} @endif
                        @if($order->state) , {{ $order->state }} @endif
                        @if($order->postal_code) , {{ $order->postal_code }} @endif
                        @if($order->country) , {{ $order->country }} @endif
                    </div>
                @endif
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-body p-0">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th style="width: 60px;">Image</th>
                            <th>Item</th>
                            <th class="text-end">Qty</th>
                            <th class="text-end">Unit Price</th>
                            <th class="text-end">Discount</th>
                            <th class="text-end">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                            @php
                                $unitPrice = (float) ($item->unit_price ?? 0);
                                $finalUnitPrice = (float) ($item->price ?? 0);
                                if ($unitPrice <= 0) {
                                    $unitPrice = $finalUnitPrice;
                                }
                                $discountPercent = (float) ($item->discount_percent ?? 0);
                                if ($discountPercent <= 0 && $unitPrice > 0 && $finalUnitPrice < $unitPrice) {
                                    $discountPercent = (($unitPrice - $finalUnitPrice) / $unitPrice) * 100;
                                }
                                $lineTotal = (float) ($item->line_total ?? ($item->quantity * $finalUnitPrice));
                            @endphp
                            <tr>
                                <td>
                                    @if($item->product && $item->product->image)
                                        <img src="{{ asset('/storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
                                    @else
                                        <div style="width: 50px; height: 50px; background: #e9ecef; border-radius: 4px; display: flex; align-items: center; justify-content: center; font-size: 0.8rem; color: #999;">No Image</div>
                                    @endif
                                </td>
                                <td>{{ $item->product->name ?? 'Unknown Product' }}</td>
                                <td class="text-end">{{ $item->quantity }}</td>
                                <td class="text-end">${{ number_format($unitPrice, 2) }}</td>
                                <td class="text-end">
                                    @if($discountPercent > 0 && $unitPrice > $finalUnitPrice)
                                        -{{ rtrim(rtrim(number_format($discountPercent, 2), '0'), '.') }}% (${{ number_format($unitPrice - $finalUnitPrice, 2) }})
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="text-end">${{ number_format($lineTotal, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row justify-content-end">
            <div class="col-md-6">
                <div class="border rounded p-3 totals">
                    <div class="d-flex justify-content-between">
                        <span>Subtotal</span>
                        <span>${{ number_format($order->total, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Shipping</span>
                        <span>$0.00</span>
                    </div>
                    <div class="d-flex justify-content-between grand">
                        <span>Total</span>
                        <span>${{ number_format($order->total, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4 no-print d-flex gap-2">
            <button class="btn btn-primary" onclick="window.print()">Print / Save as PDF</button>
            <a href="{{ route('orders.index') }}" class="btn btn-light">Back to Orders</a>
        </div>
    </div>
</body>
</html>
