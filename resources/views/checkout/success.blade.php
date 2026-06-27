<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Order Confirmed - Glow Skincare</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Poppins:wght@300;400;500;600&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --primary: #ce6ad7;
            --dark: #111827;
            --light: #ffffff;
            --border: #e5e7eb;
            --text: #374151;
            --success-color: #28a745;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: var(--dark);
            background-color:#f3f4f6;
        }

        h1,
        h2 {
            font-family: 'Playfair Display', serif;
        }

        /* Navbar */
        .navbar {
            background: var(--primary);
            box-shadow: 0 1px 8px rgba(0, 0, 0, 0.08);
            padding: 1rem 0;
        }

        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: white !important;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            margin: 0 0.5rem;
            transition: all 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: white !important;
            transform: translateY(-2px);
        }
        /* Toggler Icon */
        .navbar-toggler-icon { filter: invert(1); }
        .navbar-toggler:focus, .navbar-toggler:active { outline: none; box-shadow: none; }

        .btn-custom {
            background: white;
            color: var(--primary);
            border: 2px solid white;
            padding: 0.5rem 1.5rem;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            background: transparent;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
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
            z-index: 1050;
        }

        .user-menu .dropdown-item {
            color: var(--text);
            padding: 0.75rem 1.25rem;
            border-radius: 6px;
            margin: 0.25rem 0.5rem;
            transition: all 0.3s ease;
        }

        .user-menu .dropdown-item:hover {
            background: #f3f4f6;
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

        .success-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 2rem 0;
        }

        .success-card {
            background: white;
            border-radius: 15px;
            padding: 3rem;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 600px;
            margin: 0 auto;
        }

        .success-icon {
            width: 100px;
            height: 100px;
            background: #22c55e;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2rem;
            font-size: 3rem;
            color: white;
            animation: scaleIn 0.6s ease-out;
        }

        @keyframes scaleIn {
            from {
                transform: scale(0);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .success-message {
            color: var(--success-color);
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .success-text {
            color: #666;
            font-size: 1.1rem;
            margin-bottom: 2rem;
        }

        .order-details {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 2rem;
            margin: 2rem 0;
            border-left: 5px solid var(--primary);
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 0.75rem 0;
            border-bottom: 1px solid #ddd;
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .detail-label {
            color: #666;
            font-weight: 500;
        }

        .detail-value {
            font-weight: 700;
            color: var(--dark-color);
        }

        .order-items {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            margin: 2rem 0;
            border: 1px solid #eee;
        }

        .item-row {
            display: flex;
            justify-content: space-between;
            padding: 1rem 0;
            border-bottom: 1px solid #eee;
            gap: 1rem;
            align-items: center;
        }

        .item-row:last-child {
            border-bottom: none;
        }

        .success-item-image {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 8px;
            overflow: hidden;
            flex-shrink: 0;
        }

        .success-item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .item-name {
            font-weight: 600;
        }

        .item-price {
            color: var(--primary);
            font-weight: 600;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            padding: 1rem 0;
            border-top: 2px solid #ddd;
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--primary);
        }

        .btn-group {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        .btn-primary-custom {
            background: var(--primary);
            color: white;
            border: none;
            padding: 1rem;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            flex: 1;
            display: inline-block;
            text-align: center;
        }

        .btn-primary-custom:hover {
            filter: brightness(0.92);
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(206,106,215,0.3);
            color: white;
        }

        .btn-secondary-custom {
            flex: 1;
            background: white;
            color: #6b7280;
            border: 1.5px solid var(--border);
            padding: 1rem;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            transition: all 0.3s ease;
        }

        .btn-secondary-custom:hover { background: #f3f4f6; color: var(--dark); border-color: #d1d5db; }

        .status-badge {
            display: inline-block;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: capitalize;
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
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-spa"></i> Glow Skincare
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('products') }}">Products</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('orders.index') }}">Orders</a>
                        </li>
                    @endauth
                </ul>
                <div class="navbar-actions">
                    @auth
                        <a href="{{ route('cart.index') }}" class="nav-link position-relative"
                            style="color: white; text-decoration: none;">
                            <i class="fas fa-shopping-cart"></i> Cart
                            @php
                                $cart = session()->get('cart', []);
                                $totalItems = array_sum($cart);
                            @endphp
                            <span id="cart-count-badge"
                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                                style="{{ $totalItems > 0 ? '' : 'display:none;' }}">{{ $totalItems }}</span>
                        </a>
                        <a href="{{ route('wishlist.index') }}" class="position-relative"
                            style="text-decoration: none; color: white; font-size: 1.2rem; margin-right: 1rem;">
                            <i class="fas fa-heart"></i>
                        </a>
                        <div class="user-menu">
                            @if (auth()->user()->profile_image)
                                <img src="{{ asset('storage/' . auth()->user()->profile_image) }}" alt="Profile"
                                    class="navbar-profile-image">
                            @else
                                <div class="navbar-profile-image"
                                    style="background: var(--primary); display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-user" style="color: white;"></i>
                                </div>
                            @endif
                            <span class="text-white ms-2">{{ auth()->user()->name }}</span>
                            <div class="dropdown ms-2">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false" style="color: white !important;">
                                    <i class="fas fa-chevron-down"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <div class="user-info">
                                            <div class="user-info-name">{{ auth()->user()->name }}</div>
                                            <div class="user-info-email">{{ auth()->user()->email }}</div>
                                        </div>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i
                                                class="fas fa-user-circle"></i> Profile</a></li>
                                    <li><a class="dropdown-item" href="{{ route('wishlist.index') }}"><i
                                                class="fas fa-heart"></i> My Wishlist</a></li>
                                    @if (auth()->check() && in_array(optional(auth()->user())->role, ['admin', 'super_admin'], true))
                                        <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i
                                                    class="fas fa-crown"></i> Admin Dashboard</a></li>
                                    @endif
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="dropdown-item" onclick="localStorage.clear();"><i
                                                    class="fas fa-exchange-alt"></i> Switch Account</button>
                                        </form>
                                    </li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt"></i>
                                                Logout</button>
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

    <!-- Success Message -->
    <div class="success-container">
        <div class="success-card">
            <div class="success-icon">
                <i class="fas fa-check"></i>
            </div>

            <div class="success-message">Order Placed Successfully! ✨</div>
            <p class="success-text">
                Thank you for your purchase. Your order has been received and is being processed.
            </p>

            <!-- Order Details -->
            <div class="order-details">
                <div class="detail-row">
                    <span class="detail-label">Order ID</span>
                    <span class="detail-value">#{{ $order->id }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Order Date</span>
                    <span class="detail-value">{{ $order->created_at->format('M d, Y') }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Status</span>
                    <span class="detail-value">
                        <span class="status-badge status-{{ $order->status }}">{{ $order->status }}</span>
                    </span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Fulfillment</span>
                    <span class="detail-value">{{ ucfirst($order->fulfillment_method ?? 'delivery') }}</span>
                </div>
                @if (($order->fulfillment_method ?? 'delivery') === 'delivery')
                    <div class="detail-row">
                        <span class="detail-label">Delivery Address</span>
                        <span class="detail-value">
                            {{ $order->address_line }}
                            @if ($order->city)
                                , {{ $order->city }}
                            @endif
                            @if ($order->state)
                                , {{ $order->state }}
                            @endif
                            @if ($order->postal_code)
                                , {{ $order->postal_code }}
                            @endif
                            @if ($order->country)
                                , {{ $order->country }}
                            @endif
                        </span>
                    </div>
                @endif

                <div class="detail-row">
                    <span class="detail-label">Delivery Fee</span>
                    <span class="detail-value">
                        @if(($order->fulfillment_method ?? 'delivery') === 'pickup')
                            <span style="color: #16a34a; font-weight: 600;">Free (Pick Up)</span>
                        @elseif(($order->delivery_charge ?? 0) > 0)
                            ${{ number_format($order->delivery_charge, 2) }}
                        @else
                            <span style="color: #16a34a; font-weight: 600;">Free</span>
                        @endif
                    </span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Total Amount</span>
                    <span class="detail-value" style="color: var(--primary); font-size: 1.2rem;">
                        ${{ number_format($order->total, 2) }}
                    </span>
                </div>
            </div>

            <!-- Items Summary -->
            <div class="order-items">
                <h5 class="mb-3">Order Items ({{ count($order->items) }})</h5>

                @foreach ($order->items as $item)
                    <div class="item-row">
                        <div class="success-item-image">
                            @if ($item->product->image)
                                <img src="/storage/{{ $item->product->image }}" alt="{{ $item->product->name }}">
                            @else
                                <i class="fas fa-image"></i>
                            @endif
                        </div>
                        <div style="flex: 1;">
                            <div class="item-name">{{ $item->product->name }}</div>
                            <small class="text-muted">Qty: {{ $item->quantity }}</small>
                        </div>
                        <div class="item-price">${{ number_format($item->price * $item->quantity, 2) }}</div>
                    </div>
                @endforeach

                <div class="total-row">
                    <span>Order Total</span>
                    <span>${{ number_format($order->total, 2) }}</span>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="btn-group">
                <a href="/orders/{{ $order->id }}" class="btn-primary-custom">
                    <i class="fas fa-eye me-2"></i> View Order Details
                </a>
                <a href="{{ route('orders.invoice', ['order' => $order->id]) }}" class="btn-secondary-custom">
                    <i class="fas fa-file-invoice me-2"></i> View Invoice
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
