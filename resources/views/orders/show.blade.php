<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details - Glow Skincare</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #8b5cf6;
            --secondary-color: #e9d5ff;
            --dark-color: #2d1b4e;
            --light-color: #f8f9fa;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: var(--dark-color);
            background-color: var(--light-color);
        }

        h1, h2, h3 {
            font-family: 'Playfair Display', serif;
        }

        .navbar {
            background: linear-gradient(135deg, rgba(139, 92, 246, 0.95) 0%, rgba(236, 72, 153, 0.95) 100%);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
            padding: 1rem 0;
        }

        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: white !important;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }

        .navbar-nav .nav-link {
            color: rgba(255,255,255,0.9) !important;
            font-weight: 500;
            margin: 0 0.5rem;
            transition: all 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: white !important;
            transform: translateY(-2px);
        }

        .navbar-profile-image {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid white;
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .user-menu .dropdown-menu {
            background: linear-gradient(135deg, rgba(255, 107, 157, 0.98) 0%, rgba(192, 108, 132, 0.98) 100%);
            border: none;
            border-radius: 10px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            min-width: 200px;
            margin-top: 0.5rem;
        }

        .user-menu .dropdown-item {
            color: white;
            padding: 0.75rem 1.25rem;
            border-radius: 6px;
            margin: 0.25rem 0.5rem;
            transition: all 0.3s ease;
        }

        .user-menu .dropdown-item:hover {
            background: rgba(255, 255, 255, 0.15);
            color: white;
        }

        .user-menu .dropdown-item i {
            margin-right: 0.5rem;
            width: 18px;
        }

        .user-info {
            padding: 0.75rem 1.25rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 0.5rem;
        }

        .user-info-name {
            color: white;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .user-info-email {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.8rem;
        }

        .navbar-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .page-header {
            background: white;
            color: var(--dark-color);
            padding: 2.2rem 0;
            margin-bottom: 2rem;
            border-bottom: 4px solid var(--primary-color);
        }

        .page-header h1 {
            color: var(--dark-color);
            font-size: 2.2rem;
            font-weight: 700;
        }

        .page-header p {
            color: #666;
            font-size: 1rem;
        }

        .order-section {
            background: white;
            border-radius: 10px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }

        .section-title {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: var(--dark-color);
            border-bottom: 3px solid var(--primary-color);
            padding-bottom: 0.5rem;
            display: inline-block;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 1.5rem;
        }

        .info-box {
            padding: 1rem;
            background: var(--light-color);
            border-radius: 8px;
            border-left: 4px solid var(--primary-color);
        }

        .info-label {
            font-size: 0.85rem;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.5rem;
        }

        .info-value {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--dark-color);
        }

        .status-badge {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            font-weight: 600;
            font-size: 1rem;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-processing {
            background: #cfe2ff;
            color: #084298;
        }

        .status-completed {
            background: #d1e7dd;
            color: #0f5132;
        }

        .status-cancelled {
            background: #f8d7da;
            color: #842029;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
        }

        .items-table th {
            background: var(--light-color);
            border-bottom: 2px solid #dee2e6;
            padding: 1rem;
            text-align: left;
            font-weight: 600;
        }

        .items-table td {
            border-bottom: 1px solid #dee2e6;
            padding: 1rem;
        }

        .item-row:hover {
            background: var(--light-color);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .product-cell {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .product-image {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .product-info h6 {
            margin: 0;
            font-weight: 600;
        }

        .product-info p {
            margin: 0;
            font-size: 0.9rem;
            color: #6c757d;
        }

        .item-details-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .item-details-modal.show {
            display: flex;
        }

        .modal-content-custom {
            background: white;
            border-radius: 10px;
            padding: 2rem;
            max-width: 500px;
            width: 90%;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
        }

        .modal-close {
            float: right;
            font-size: 1.5rem;
            cursor: pointer;
            color: #6c757d;
        }

        .modal-close:hover {
            color: var(--dark-color);
        }

        .order-total {
            background: linear-gradient(135deg, #8b5cf6 0%, #ec4899 100%);
            color: white;
            padding: 1.5rem;
            border-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
        }

        .order-total h4 {
            margin: 0;
            font-size: 1.2rem;
            opacity: 0.9;
        }

        .order-total-amount {
            font-size: 2rem;
            font-weight: 700;
        }

        .btn-back {
            display: inline-block;
            margin-bottom: 1rem;
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-back:hover {
            color: var(--dark-color);
            transform: translateX(-5px);
        }

        .btn-cancel {
            background: #ef4444;
            color: white !important;
            border: none;
            padding: 0.65rem 1.4rem;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            cursor: pointer;
        }

        .btn-cancel:hover {
            background: #dc2626;
            color: white !important;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(239, 68, 68, 0.3);
            text-decoration: none;
        }

        .btn-cancel:disabled {
            background: #999;
            cursor: not-allowed;
            transform: none;
            opacity: 0.6;
        }
        .footer {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            color: white;
            margin-top: 3rem;
            padding: 2rem 0;
            text-align: center;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-spa"></i> Glow Skincare
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products') }}">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('orders.index') }}">My Orders</a>
                    </li>
                </ul>
                <div class="navbar-actions">
                    @auth
                        <a href="{{ route('cart.index') }}" class="nav-link position-relative" style="color: white; text-decoration: none;">
                            <i class="fas fa-shopping-cart"></i> Cart
                            @php
                                $cart = session()->get('cart', []);
                                $totalItems = array_sum($cart);
                            @endphp
                            <span id="cart-count-badge" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="{{ $totalItems > 0 ? '' : 'display:none;' }}">{{ $totalItems }}</span>
                        </a>
                        <a href="{{ route('wishlist.index') }}" class="position-relative" style="text-decoration: none; color: white; font-size: 1.2rem; margin-right: 1rem;">
                            <i class="fas fa-heart"></i>
                        </a>
                        <div class="user-menu">
                            @if(auth()->user()->profile_image)
                                <img src="{{ asset('storage/' . auth()->user()->profile_image) }}" alt="Profile" class="navbar-profile-image">
                            @else
                                <div class="navbar-profile-image" style="background: var(--primary-color); display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-user" style="color: white;"></i>
                                </div>
                            @endif
                            <span class="text-white ms-2">{{ auth()->user()->name }}</span>
                            <div class="dropdown ms-2">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: white !important;">
                                    <i class="fas fa-chevron-down"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <div class="user-info">
                                            <div class="user-info-name">{{ auth()->user()->name }}</div>
                                            <div class="user-info-email">{{ auth()->user()->email }}</div>
                                        </div>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fas fa-user-circle"></i> Profile</a></li>
                                    <li><a class="dropdown-item" href="{{ route('wishlist.index') }}"><i class="fas fa-heart"></i> My Wishlist</a></li>
                                    @if(auth()->check() && in_array(optional(auth()->user())->role, ['admin','super_admin'], true))
                                        <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="fas fa-crown"></i> Admin Dashboard</a></li>
                                    @endif
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="dropdown-item" onclick="localStorage.clear();"><i class="fas fa-exchange-alt"></i> Switch Account</button>
                                        </form>
                                    </li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Logout</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-light">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-outline-light ms-2">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Page Header -->
    <div class="page-header">
        <div class="container">
            <a href="{{ route('orders.index') }}" class="btn-back"><i class="fas fa-arrow-left me-2"></i> Back to Orders</a>
            <h1>Order #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</h1>
        </div>
    </div>

    <!-- Order Details -->
    <div class="container py-4">
        <!-- Order Status -->
        <div class="order-section">
            <h2 class="section-title"><i class="fas fa-info-circle me-2"></i> Order Information</h2>
            <div class="info-grid">
                <div class="info-box">
                    <div class="info-label">Order Date</div>
                    <div class="info-value">{{ $order->created_at->format('M d, Y') }}</div>
                </div>
                <div class="info-box">
                    <div class="info-label">Order Status</div>
                    <div><span class="status-badge status-{{ $order->status }}">{{ ucfirst($order->status) }}</span></div>
                </div>
                <div class="info-box">
                    <div class="info-label">Number of Items</div>
                    <div class="info-value">{{ $order->items->count() }}</div>
                </div>
                <div class="info-box">
                    <div class="info-label">Fulfillment</div>
                    <div class="info-value">{{ ucfirst($order->fulfillment_method ?? 'delivery') }}</div>
                </div>
                @if(($order->fulfillment_method ?? 'delivery') === 'delivery')
                <div class="info-box">
                    <div class="info-label">Delivery Address</div>
                    <div>
                        {{ $order->address_line }}
                        @if($order->city) , {{ $order->city }} @endif
                        @if($order->state) , {{ $order->state }} @endif
                        @if($order->postal_code) , {{ $order->postal_code }} @endif
                        @if($order->country) , {{ $order->country }} @endif
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Order Items -->
        <div class="order-section">
            <h2 class="section-title"><i class="fas fa-shopping-bag me-2"></i> Order Items</h2>
            <table class="items-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Discount</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($order->items as $item)
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
                        <tr class="item-row" onclick="showItemDetails({{ json_encode($item) }})">
                            <td>
                                <div class="product-cell">
                                    <div class="product-image">
                                        @if($item->product && $item->product->image)
                                            <img src="/storage/{{ $item->product->image }}" alt="{{ $item->product->name }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px;">
                                        @else
                                            <i class="fas fa-image"></i>
                                        @endif
                                    </div>
                                    <div class="product-info">
                                        <h6>{{ $item->product->name ?? 'Unknown Product' }}</h6>
                                        <p>{{ $item->product->code ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $item->quantity }}</td>
                            <td>${{ number_format($unitPrice, 2) }}</td>
                            <td>
                                @if($discountPercent > 0 && $unitPrice > $finalUnitPrice)
                                    -{{ rtrim(rtrim(number_format($discountPercent, 2), '0'), '.') }}% (${{ number_format($unitPrice - $finalUnitPrice, 2) }})
                                @else
                                    -
                                @endif
                            </td>
                            <td><strong>${{ number_format($lineTotal, 2) }}</strong></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">No items in this order</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Order Total -->
        <div class="order-section">
            <div class="order-total">
                <h4>Total Amount</h4>
                <div class="order-total-amount">${{ number_format($order->total, 2) }}</div>
            </div>
        </div>

        <!-- Actions -->
        <div class="order-section">
            <a href="{{ route('orders.invoice', ['order' => $order->id]) }}" class="btn btn-custom">
                <i class="fas fa-file-invoice me-2"></i> View Invoice
            </a>
        </div>
    </div>

    <!-- Item Details Modal -->
    <div class="item-details-modal" id="itemModal">
        <div class="modal-content-custom">
            <span class="modal-close" onclick="hideItemDetails()">&times;</span>
            <h3>Item Details</h3>
            <div id="itemDetailsContent"></div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer mt-5">
        <p>&copy; {{ date('Y') }} Glow Skincare. All rights reserved.</p>
    </footer>

    <script>
        function showItemDetails(item) {
            const unitPrice = parseFloat(item.unit_price ?? item.price ?? 0);
            const finalPrice = parseFloat(item.price ?? 0);
            const savedDiscount = parseFloat(item.discount_percent ?? 0);
            const computedDiscount = unitPrice > 0 && finalPrice < unitPrice
                ? ((unitPrice - finalPrice) / unitPrice) * 100
                : 0;
            const discountPercent = savedDiscount > 0 ? savedDiscount : computedDiscount;
            const hasDiscount = discountPercent > 0 && unitPrice > finalPrice;
            const lineTotal = parseFloat(item.line_total ?? (item.quantity * finalPrice));
            const html = `
                <div class="mt-3">
                    <p><strong>Product Name:</strong> ${item.product?.name || 'Unknown'}</p>
                    <p><strong>Product Code:</strong> ${item.product?.code || 'N/A'}</p>
                    <p><strong>Quantity:</strong> ${item.quantity}</p>
                    <p><strong>Unit Price:</strong> $${unitPrice.toFixed(2)}</p>
                    <p><strong>Discount:</strong> ${hasDiscount
                        ? `-${discountPercent.toFixed(2).replace(/\.00$/, '')}% ($${(unitPrice - finalPrice).toFixed(2)})`
                        : '-'}</p>
                    <p><strong>Final Unit Price:</strong> $${finalPrice.toFixed(2)}</p>
                    <p><strong>Subtotal:</strong> $${lineTotal.toFixed(2)}</p>
                    <p><strong>Category:</strong> ${item.product?.category?.name || 'N/A'}</p>
                    ${item.product?.description ? `<p><strong>Description:</strong> ${item.product.description}</p>` : ''}
                </div>
            `;
            document.getElementById('itemDetailsContent').innerHTML = html;
            document.getElementById('itemModal').classList.add('show');
        }

        function hideItemDetails() {
            document.getElementById('itemModal').classList.remove('show');
        }

        document.getElementById('itemModal').addEventListener('click', function(e) {
            if (e.target === this) {
                hideItemDetails();
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
