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

        .order-card {
            background: white;
            border-radius: 12px;
            padding: 1.8rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 12px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            border-left: 5px solid var(--primary-color);
        }

        .order-card:hover {
            box-shadow: 0 6px 20px rgba(0,0,0,0.12);
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
            border-left-color: #ef4444;
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
            color: var(--primary-color);
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
            border-bottom: 1px solid #f0f0f0;
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
            color: var(--dark-color);
            font-size: 1.05rem;
        }

        .summary-total {
            font-size: 1.3rem;
            color: var(--primary-color);
            font-weight: 700;
        }

        .order-items {
            background: #f9f9f9;
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
            border-bottom: 1px solid #eee;
        }

        .item-row:last-child {
            border-bottom: none;
        }

        .item-name {
            font-weight: 500;
            color: var(--dark-color);
        }

        .btn-view-details {
            background: linear-gradient(135deg, var(--primary-color) 0%, #ec4899 100%);
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
            box-shadow: 0 5px 15px rgba(139, 92, 246, 0.3);
            text-decoration: none;
        }

        .btn-cancel-order {
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

        .btn-cancel-order:hover {
            background: #dc2626;
            color: white !important;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(239, 68, 68, 0.3);
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
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            color: white;
            margin-top: 3rem;
            padding: 2rem 0;
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
                        <span class="summary-label">Total</span>
                        <span class="summary-total">${{ number_format($order->total, 2) }}</span>
                    </div>
                </div>

                @if($order->items->count() > 0)
                    <div class="order-items">
                        <div class="item-label">📦 Items Ordered</div>
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
                                <span class="item-name">{{ $item->product->name ?? 'Unknown' }}</span>
                                <span>
                                    @if($discountPercent > 0 && $unitPrice > $finalUnitPrice)
                                        {{ $item->quantity }} ×
                                        <span style="text-decoration: line-through; color: #9ca3af;">${{ number_format($unitPrice, 2) }}</span>
                                        <span style="font-weight: 700; color: var(--primary-color);">${{ number_format($finalUnitPrice, 2) }}</span>
                                        <span style="background: linear-gradient(135deg, #8b5cf6 0%, #ec4899 100%); color: white; padding: 0.15rem 0.5rem; border-radius: 999px; font-size: 0.72rem; font-weight: 700; margin-left: 0.35rem;">-{{ rtrim(rtrim(number_format($discountPercent, 2), '0'), '.') }}%</span>
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
                <a href="/" class="btn btn-primary mt-3" style="background: linear-gradient(135deg, var(--primary-color) 0%, #ec4899 100%); border: none;">
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
