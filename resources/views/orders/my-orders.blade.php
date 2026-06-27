<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders - Glow Skincare</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <style>
        .navbar-toggler-icon {
            filter: invert(1);
        }
        .navbar-toggler:focus,
        .navbar-toggler:active {
            outline: none;
            box-shadow: none;
        }
        :root {
            --primary: #ce6ad7;
            --secondary: #f3f4f6;
            --dark: #111827;
            --light: #ffffff;
            --border: #e5e7eb;
            --text: #374151;
            --danger: #ef4444;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: var(--text);
            background-color: var(--secondary);
        }

        h1, h2, h3 {
            font-family: 'Playfair Display', serif;
            color: var(--dark);
        }

        .navbar {
            background: var(--primary);
            box-shadow: 0 1px 8px rgba(0,0,0,0.08);
            padding: 1rem 0;
        }

        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: white !important;
        }

        .navbar-nav .nav-link {
            color: rgba(255,255,255,0.9) !important;
            font-weight: 500;
            margin: 0 0.5rem;
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
            background: white;
            border: 1px solid var(--border);
            border-radius: 10px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            min-width: 200px;
            margin-top: 0.5rem;
        }

        .user-menu .dropdown-item {
            color: var(--text);
            padding: 0.75rem 1.25rem;
            border-radius: 6px;
            margin: 0.25rem 0.5rem;
            transition: all 0.3s ease;
        }

        .user-menu .dropdown-item:hover {
            background: var(--secondary);
            color: var(--dark);
        }

        .user-menu .dropdown-item i {
            margin-right: 0.5rem;
            width: 18px;
        }

        .user-info {
            padding: 0.75rem 1.25rem;
            border-bottom: 1px solid var(--border);
            margin-bottom: 0.5rem;
        }

        .user-info-name {
            color: var(--dark);
            font-weight: 600;
            font-size: 0.9rem;
        }

        .user-info-email {
            color: #6b7280;
            font-size: 0.8rem;
        }

        .navbar-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        @media (max-width: 991.98px) {
            .navbar {
                padding: 0.75rem 0;
            }

            .navbar-collapse {
                margin-top: 1rem;
                padding: 1rem 1.25rem;
                border-radius: 16px;
                background: rgba(255, 255, 255, 0.08);
                backdrop-filter: blur(12px);
            }

            .navbar-nav {
                margin-bottom: 1rem;
                align-items: flex-start;
            }

            .navbar-actions,
            .user-menu {
                width: 100%;
                flex-wrap: wrap;
                justify-content: flex-start;
            }

            .navbar-actions {
                gap: 0.75rem;
            }

            .user-menu {
                align-items: flex-start;
            }

            .navbar-actions .btn,
            .navbar-actions .nav-link,
            .navbar-actions .dropdown,
            .navbar-actions form {
                width: 100%;
            }

            .navbar-actions .dropdown {
                display: flex;
                justify-content: flex-start;
            }

            .navbar-brand {
                font-size: 1.5rem;
            }
        }

        .page-header {
            background: white;
            color: var(--primary);
            padding: 2.2rem 0;
            margin-bottom: 2rem;
            border-bottom: 4px solid var(--primary);
        }

        .page-header h1 {
            color: var(--primary);
            font-size: 2.2rem;
            font-weight: 700;
        }

        .page-header p {
            color: #666;
            font-size: 1rem;
        }

        .order-card {
            background: white;
            border-radius: 12px;
            padding: 1.8rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
            transition: all 0.3s ease;
            border-left: 5px solid var(--primary);
        }

        .order-card:hover {
            box-shadow: 0 6px 20px rgba(0,0,0,0.1);
            transform: translateY(-2px);
        }

        .order-card.completed {
            border-left-color: #10b981;
        }

        .order-card.processing {
            border-left-color: #3b82f6;
        }

        .order-card.pending {
            border-left-color: #f59e0b;
        }

        .order-card.cancelled {
            border-left-color: var(--danger);
        }

        .order-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1rem;
        }

        .order-id {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--primary);
        }

        .order-date {
            color: #666;
            font-size: 0.9rem;
        }

        .status-badge {
            display: inline-block;
            padding: 0.45rem 1.1rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.8rem;
        }

        .status-completed {
            background: #d1e7dd;
            color: #0f5132;
        }

        .status-processing {
            background: #cfe2ff;
            color: #084298;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-cancelled {
            background: #f8d7da;
            color: #842029;
        }

        .order-summary {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1rem;
            margin-bottom: 1.2rem;
            padding-bottom: 1.2rem;
            border-bottom: 1px solid var(--border);
        }

        .summary-item {
            display: flex;
            flex-direction: column;
        }

        .summary-label {
            font-size: 0.8rem;
            color: #999;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            margin-bottom: 0.3rem;
        }

        .summary-value {
            font-weight: 600;
            color: var(--dark);
            font-size: 1.05rem;
        }

        .summary-total {
            font-size: 1.3rem;
            color: var(--primary);
            font-weight: 700;
        }

        .order-items {
            background: var(--secondary);
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
        }

        .item-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #666;
            margin-bottom: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .item-row {
            display: flex;
            justify-content: space-between;
            font-size: 0.9rem;
            padding: 0.5rem 0;
            color: #666;
            border-bottom: 1px solid var(--border);
        }

        .item-row:last-child {
            border-bottom: none;
        }

        .item-name {
            font-weight: 500;
            color: var(--dark);
        }

        .item-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.9rem;
            padding: 0.5rem 0;
            color: #666;
            border-bottom: 1px solid var(--border);
        }

        .item-name-wrap {
            display: flex;
            align-items: center;
            gap: 0.65rem;
        }

        .item-thumb {
            width: 42px;
            height: 42px;
            border-radius: 8px;
            object-fit: cover;
            flex-shrink: 0;
            border: 1px solid var(--border);
        }

        .item-thumb-placeholder {
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--secondary);
            color: #999;
            font-size: 1rem;
        }

        .btn-view-details {
            background: var(--primary);
            color: white !important;
            border: none;
            padding: 0.65rem 1.4rem;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-view-details:hover {
            color: white !important;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.15);
            text-decoration: none;
            filter: brightness(0.9);
        }

        .btn-cancel-order {
            background: var(--danger);
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

        .btn-cancel-order:hover {
            background: #dc2626;
            color: white !important;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(239, 68, 68, 0.25);
            text-decoration: none;
        }

        .btn-cancel-order:disabled {
            background: #9ca3af;
            cursor: not-allowed;
            transform: none;
            opacity: 0.6;
        }

        .order-actions {
            display: flex;
            gap: 0.75rem;
            justify-content: flex-end;
            flex-wrap: wrap;
        }

        .footer {
            background: var(--secondary);
            color: var(--text);
            margin-top: 3rem;
            padding: 1.5rem 0;
            border-top: 1px solid var(--border);
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
                    @auth
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('orders.index') }}">My Orders</a>
                    </li>
                    @endauth
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
                                <div class="navbar-profile-image" style="background: var(--primary); display: flex; align-items: center; justify-content: center;">
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
            <h1><i class="fas fa-receipt me-2"></i>My Orders</h1>
            <p class="mb-0">View and manage your order history</p>
        </div>
    </div>

    <!-- Orders List -->
    <div class="container py-4">
        @forelse($orders as $order)
            <div class="order-card {{ $order->status }}">
                <div class="order-top">
                    <div>
                        <div class="order-id">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</div>
                        <div class="order-date">{{ $order->created_at->format('M d, Y \a\t g:i A') }}</div>
                    </div>
                    <span class="status-badge status-{{ $order->status }}">{{ ucfirst($order->status) }}</span>
                </div>

                <div class="order-summary">
                    <div class="summary-item">
                        <span class="summary-label">Items</span>
                        <span class="summary-value">{{ $order->items->count() }}</span>
                    </div>
                    <div class="summary-item">
                        <span class="summary-label">Fulfillment</span>
                        <span class="summary-value">
                            @if($order->fulfillment_method === 'pickup')
                                <span style="color: #8c57e9;"><i class="fas fa-store me-1"></i> Pickup</span>
                            @else
                                <span style="color: #eb25cd;"><i class="fas fa-truck me-1"></i> Delivery</span>
                            @endif
                        </span>
                    </div>
                    <div class="summary-item">
                        <span class="summary-label">Delivery Charge</span>
                        <span class="summary-value">
                            @if($order->fulfillment_method === 'pickup')
                                <span style="color: #6b7280;">—</span>
                            @elseif(($order->delivery_charge ?? 0) > 0)
                                <span style="color: #ef4444; font-weight: 700;">${{ number_format($order->delivery_charge, 2) }}</span>
                            @else
                                <span style="color: #16a34a; font-weight: 700;">Free</span>
                            @endif
                        </span>
                    </div>
                    <div class="summary-item">
                        <span class="summary-label">Total</span>
                        <span class="summary-total">${{ number_format($order->total, 2) }}</span>
                    </div>
                </div>

                @if($order->items->count() > 0)
                    <div class="order-items">
                        <div class="item-label" style="font-weight: 700; color: var(--primary);"><i class="fas fa-box-open me-2"></i>Items Ordered</div>
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
                            @endphp
                            <div class="item-row">
                                <div class="item-name-wrap">
                                    @if($item->product && $item->product->image)
                                        <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="item-thumb">
                                    @else
                                        <div class="item-thumb item-thumb-placeholder">
                                            <i class="fas fa-image"></i>
                                        </div>
                                    @endif
                                    <span class="item-name">{{ $item->product->name ?? 'Unknown' }}</span>
                                </div>
                                <span>
                                    @if($discountPercent > 0 && $unitPrice > $finalUnitPrice)
                                        {{ $item->quantity }} ×
                                        <span style="text-decoration: line-through; color: #9ca3af;">${{ number_format($unitPrice, 2) }}</span>
                                        <span style="font-weight: 700; color: var(--primary);">${{ number_format($finalUnitPrice, 2) }}</span>
                                        <span style="background: var(--secondary); color: var(--text); border: 1px solid var(--border); padding: 0.15rem 0.5rem; border-radius: 999px; font-size: 0.72rem; font-weight: 700; margin-left: 0.35rem;">-{{ rtrim(rtrim(number_format($discountPercent, 2), '0'), '.') }}%</span>
                                    @else
                                        {{ $item->quantity }} × ${{ number_format($finalUnitPrice, 2) }}
                                    @endif
                                </span>
                            </div>
                        @endforeach
                    </div>
                @endif

                <div style="text-align: right;">
                    <a href="{{ route('orders.show', $order->id) }}" class="btn-view-details">
                        <i class="fas fa-eye me-1"></i> View Details
                    </a>
                </div>
            </div>
        @empty
            <div style="text-align: center; padding: 4rem; background: white; border-radius: 12px;">
                <i class="fas fa-inbox" style="font-size: 4rem; color: #ddd; margin-bottom: 1rem; display: block;"></i>
                <h3>No Orders Yet</h3>
                <p class="text-muted">You haven't placed any orders yet. Start shopping now!</p>
                <a href="/" class="btn btn-primary mt-3" style="background: var(--primary); border: none;">
                    <i class="fas fa-shopping-bag me-2"></i> Browse Products
                </a>
            </div>
        @endforelse
    </div>

    <!-- Footer -->
    <footer class="footer mt-5">
        <div class="container text-center">
            <p>&copy; {{ date('Y') }} Glow Skincare. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
