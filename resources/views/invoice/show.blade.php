<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #ce6ad7;
            --dark: #111827;
            --light: #ffffff;
            --border: #e5e7eb;
            --text: #374151;
            --secondary: #f3f4f6;
        }

        @media print {
            .no-print { display: none !important; }

            @page {
                size: A4;
                margin: 12mm;
            }

            body {
                background: white !important;
                padding: 0 !important;
                color: #000 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .container {
                max-width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
            }

            .invoice-wrapper {
                box-shadow: none !important;
                border: none !important;
                border-radius: 0 !important;
                max-width: 100% !important;
                margin: 0 !important;
            }

            .invoice-topbar {
                background: var(--primary) !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
                padding: 1rem 1.5rem !important;
            }

            .invoice-body {
                padding: 1.25rem 1.5rem !important;
            }

            .party-box,
            .meta-chip,
            .totals-box {
                background: #f8f8f8 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
                border: 0.5px solid #ddd !important;
            }

            .invoice-table thead tr {
                background: #f0f0f0 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .invoice-table tbody tr {
                page-break-inside: avoid;
            }

            .invoice-table tbody tr:hover {
                background: transparent !important;
            }

            .status-badge,
            .discount-tag,
            .free-badge {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .totals-box {
                page-break-inside: avoid;
            }

            a {
                text-decoration: none !important;
                color: inherit !important;
            }

            img {
                max-width: 50px !important;
            }
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--secondary);
            color: var(--text);
            min-height: 100vh;
            padding: 2rem 0;
        }

        .invoice-wrapper {
            background: white;
            border-radius: 12px;
            border: 0.5px solid var(--border);
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
            overflow: hidden;
            max-width: 860px;
            margin: 0 auto;
        }

        /* Top header bar */
        .invoice-topbar {
            background: var(--primary);
            padding: 1.5rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .invoice-brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.6rem;
            font-weight: 700;
            color: white;
        }

        .invoice-brand i {
            margin-right: 0.4rem;
        }

        .invoice-label {
            color: rgba(255,255,255,0.85);
            font-size: 0.85rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .invoice-number {
            color: white;
            font-size: 1.1rem;
            font-weight: 600;
        }

        /* Body padding */
        .invoice-body {
            padding: 2rem;
        }

        /* Meta row: date, status */
        .invoice-meta {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 0.5px solid var(--border);
        }

        .meta-chip {
            background: var(--secondary);
            border: 0.5px solid var(--border);
            border-radius: 8px;
            padding: 0.5rem 1rem;
            font-size: 0.85rem;
        }

        .meta-chip span {
            color: #6b7280;
            margin-right: 0.25rem;
        }

        .meta-chip strong {
            color: var(--dark);
        }

        /* Bill to / Fulfillment section */
        .invoice-parties {
            display: flex;
            gap: 2rem;
            flex-wrap: wrap;
            margin-bottom: 2rem;
        }

        .party-box {
            flex: 1;
            min-width: 200px;
            background: var(--secondary);
            border-radius: 8px;
            border: 0.5px solid var(--border);
            padding: 1rem 1.25rem;
        }

        .party-box h6 {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--primary);
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .party-box .name {
            font-weight: 600;
            color: var(--dark);
            font-size: 0.95rem;
        }

        .party-box .sub {
            color: #6b7280;
            font-size: 0.85rem;
            margin-top: 0.15rem;
        }

        /* Table */
        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1.5rem;
            font-size: 0.88rem;
        }

        .invoice-table thead tr {
            background: var(--secondary);
            border-bottom: 1.5px solid var(--border);
        }

        .invoice-table thead th {
            padding: 0.75rem 1rem;
            color: #6b7280;
            font-weight: 600;
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .invoice-table tbody tr {
            border-bottom: 0.5px solid var(--border);
            transition: background 0.15s;
        }

        .invoice-table tbody tr:last-child {
            border-bottom: none;
        }

        .invoice-table tbody tr:hover {
            background: #fafafa;
        }

        .invoice-table tbody td {
            padding: 0.85rem 1rem;
            color: var(--text);
            vertical-align: middle;
        }

        .product-name {
            font-weight: 600;
            color: var(--dark);
        }

        .discount-tag {
            display: inline-block;
            background: #f0fdf4;
            color: #16a34a;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
            padding: 1px 8px;
            margin-top: 2px;
        }

        /* Totals */
        .totals-box {
            background: var(--secondary);
            border: 0.5px solid var(--border);
            border-radius: 10px;
            padding: 1.25rem 1.5rem;
            max-width: 320px;
            margin-left: auto;
        }

        .totals-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 0;
            border-bottom: 0.5px solid var(--border);
            font-size: 0.9rem;
        }

        .totals-row:last-child {
            border-bottom: none;
        }

        .totals-row .label {
            color: #6b7280;
        }

        .totals-row .value {
            font-weight: 600;
            color: var(--dark);
        }

        .totals-grand {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 0 0;
            margin-top: 0.5rem;
            border-top: 1.5px solid var(--primary);
        }

        .totals-grand .label {
            font-size: 1rem;
            font-weight: 600;
            color: var(--dark);
        }

        .totals-grand .value {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--primary);
        }

        .free-badge {
            background: #f0fdf4;
            color: #16a34a;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            padding: 2px 10px;
        }

        /* Status badge */
        .status-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.8rem;
            text-transform: capitalize;
        }
        .status-pending    { background: #fff3cd; color: #856404; }
        .status-processing { background: #cfe2ff; color: #084298; }
        .status-completed  { background: #d1e7dd; color: #0f5132; }

        /* Action buttons */
        .btn-invoice-print {
            background: var(--primary);
            color: white;
            border: none;
            padding: 0.65rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-invoice-print:hover {
            filter: brightness(0.92);
            transform: translateY(-1px);
        }

        .btn-invoice-back {
            background: white;
            color: #6b7280;
            border: 1.5px solid var(--border);
            padding: 0.65rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .btn-invoice-back:hover {
            background: var(--secondary);
            color: var(--dark);
            border-color: #d1d5db;
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Action Buttons (no-print) -->
    <div class="d-flex gap-2 mb-3 no-print" style="max-width: 860px; margin: 0 auto;">
        <button class="btn-invoice-print" onclick="window.print()">
            <i class="fas fa-print me-2"></i> Print / Save as PDF
        </button>
        <a href="{{ route('orders.index') }}" class="btn-invoice-back">
            <i class="fas fa-arrow-left me-2"></i> Back to Orders
        </a>
    </div>

    <div class="invoice-wrapper">

        <!-- Top Bar -->
        <div class="invoice-topbar">
            <div>
                <div class="invoice-brand"><i class="fas fa-spa"></i> Glow Skincare</div>
                <div class="invoice-label">Official Invoice</div>
            </div>
            <div style="text-align: right;">
                <div class="invoice-label">Invoice number</div>
                <div class="invoice-number">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</div>
            </div>
        </div>

        <div class="invoice-body">

            <!-- Meta chips -->
            <div class="invoice-meta">
                <div class="meta-chip">
                    <span>Date:</span>
                    <strong>{{ $order->created_at->format('M d, Y') }}</strong>
                </div>
                <div class="meta-chip">
                    <span>Status:</span>
                    <span class="status-badge status-{{ $order->status }}">{{ ucfirst($order->status) }}</span>
                </div>
                <div class="meta-chip">
                    <span>Fulfillment:</span>
                    <strong>{{ ucfirst($order->fulfillment_method ?? 'delivery') }}</strong>
                </div>
            </div>

            <!-- Bill To / Fulfillment -->
            <div class="invoice-parties">
                <div class="party-box">
                    <h6><i class="fas fa-user me-1"></i> Bill To</h6>
                    <div class="name">{{ $order->user->name }}</div>
                    <div class="sub">{{ $order->user->email }}</div>
                </div>

                @if(($order->fulfillment_method ?? 'delivery') === 'delivery')
                <div class="party-box">
                    <h6><i class="fas fa-truck me-1"></i> Delivery Address</h6>
                    <div class="sub">
                        {{ collect([$order->city, $order->state, $order->postal_code, $order->country])->filter()->implode(', ') }}
                    </div>
                </div>
                @else
                <div class="party-box">
                    <h6><i class="fas fa-store me-1"></i> Pick Up</h6>
                    <div class="name">In-store pick up</div>
                    <div class="sub">No delivery address required</div>
                </div>
                @endif
            </div>

            <!-- Items Table -->
            <table class="invoice-table">
                <thead>
                    <tr>
                        <th style="width: 56px;">Image</th>
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
                            $unitPrice      = (float) ($item->unit_price ?? 0);
                            $finalUnitPrice = (float) ($item->price ?? 0);
                            if ($unitPrice <= 0) { $unitPrice = $finalUnitPrice; }
                            $discountPercent = (float) ($item->discount_percent ?? 0);
                            if ($discountPercent <= 0 && $unitPrice > 0 && $finalUnitPrice < $unitPrice) {
                                $discountPercent = (($unitPrice - $finalUnitPrice) / $unitPrice) * 100;
                            }
                            $lineTotal = (float) ($item->line_total ?? ($item->quantity * $finalUnitPrice));
                        @endphp
                        <tr>
                            <td>
                                @if($item->product && $item->product->image)
                                    <img src="{{ asset('/storage/' . $item->product->image) }}"
                                         alt="{{ $item->product->name }}"
                                         style="width:50px; height:50px; object-fit:cover; border-radius:6px; border: 0.5px solid #e5e7eb;">
                                @else
                                    <div style="width:50px; height:50px; background:#f3f4f6; border-radius:6px; display:flex; align-items:center; justify-content:center; color:#9ca3af;">
                                        <i class="fas fa-image"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="product-name">{{ $item->product->name ?? 'Unknown Product' }}</div>
                            </td>
                            <td class="text-end">{{ $item->quantity }}</td>
                            <td class="text-end">${{ number_format($unitPrice, 2) }}</td>
                            <td class="text-end">
                                @if($discountPercent > 0 && $unitPrice > $finalUnitPrice)
                                    <span class="discount-tag">
                                        -{{ rtrim(rtrim(number_format($discountPercent, 2), '0'), '.') }}%
                                    </span>
                                    <div style="font-size:0.8rem; color:#6b7280;">-${{ number_format(($unitPrice - $finalUnitPrice) * $item->quantity, 2) }}</div>
                                @else
                                    <span style="color:#9ca3af;">—</span>
                                @endif
                            </td>
                            <td class="text-end" style="font-weight:600; color: var(--dark);">
                                ${{ number_format($lineTotal, 2) }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Totals -->
            @php
                $delivery_charge = (float) ($order->delivery_charge ?? 0);
                $subtotal    = $order->total - $delivery_charge;
            @endphp

            <div class="totals-box">
                <div class="totals-row">
                    <span class="label">Subtotal</span>
                    <span class="value">${{ number_format($subtotal, 2) }}</span>
                </div>
                <div class="totals-row">
                    <span class="label">Delivery fee</span>
                    <span class="value">
                        @if(($order->fulfillment_method ?? 'delivery') === 'pickup' || $delivery_charge <= 0)
                            <span class="free-badge">Free</span>
                        @else
                            ${{ number_format($delivery_charge, 2) }}
                        @endif
                    </span>
                </div>
                <div class="totals-row">
                    <span class="label">Tax</span>
                    <span class="value" style="color:#9ca3af;">$0.00</span>
                </div>
                <div class="totals-grand">
                    <span class="label">Total</span>
                    <span class="value">${{ number_format($order->total, 2) }}</span>
                </div>
            </div>

            <!-- Footer note -->
            <p style="margin-top: 2rem; font-size: 0.8rem; color: #9ca3af; text-align: center;">
                Thank you for shopping with Glow Skincare. For questions, contact us at support@glowskincare.com
            </p>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>