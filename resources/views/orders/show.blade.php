<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details - Glow Skincare</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Poppins:wght@300;400;500;600&display=swap"
        rel="stylesheet">

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
            --success: #16a34a;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: var(--text);
            background: var(--secondary);
            margin: 0;
        }

        h1,
        h2,
        h3 {
            font-family: 'Playfair Display', serif;
            color: var(--dark);
        }

        /* ── Navbar ── */
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

        /* ── Page Header ── */
        .page-header {
            background: white;
            border-bottom: 3px solid var(--primary);
            padding: 2rem 0 1.75rem;
            margin-bottom: 2rem;
        }

        .page-header .back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            color: var(--primary);
            font-weight: 600;
            font-size: 0.9rem;
            text-decoration: none;
            margin-bottom: 0.75rem;
            transition: gap 0.2s ease;
        }

        .page-header .back-link:hover {
            gap: 0.6rem;
            color: var(--dark);
        }

        .page-header h1 {
            font-size: 2rem;
            font-weight: 700;
            margin: 0;
            color: var(--dark);
        }

        .page-header .order-meta {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-top: 0.5rem;
            flex-wrap: wrap;
        }

        .page-header .order-meta span {
            font-size: 0.875rem;
            color: #6b7280;
        }

        /* ── Layout ── */
        .page-body {
            padding-bottom: 3rem;
        }

        .main-col {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        /* ── Card ── */
        .card-section {
            background: white;
            border-radius: 12px;
            border: 1px solid var(--border);
            overflow: hidden;
        }

        .card-header-bar {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            padding: 1.1rem 1.5rem;
            border-bottom: 1px solid var(--border);
            background: white;
        }

        .card-header-bar .icon-wrap {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: rgba(206, 106, 215, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 0.85rem;
            flex-shrink: 0;
        }

        .card-header-bar h2 {
            font-size: 1rem;
            font-weight: 700;
            margin: 0;
            color: var(--dark);
            font-family: 'Poppins', sans-serif;
        }

        .card-body-inner {
            padding: 1.5rem;
        }

        /* ── Info Grid ── */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1rem;
        }

        .info-tile {
            background: var(--secondary);
            border-radius: 10px;
            padding: 1rem 1.1rem;
            border: 1px solid var(--border);
        }

        .info-tile .tile-label {
            font-size: 0.72rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: #9ca3af;
            margin-bottom: 0.4rem;
        }

        .info-tile .tile-value {
            font-size: 1rem;
            font-weight: 700;
            color: var(--dark);
            line-height: 1.3;
        }

        .info-tile .tile-value.small {
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--text);
        }

        /* ── Status badges ── */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.3rem 0.85rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.8rem;
        }

        .status-badge::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
            opacity: 0.7;
        }

        .status-pending {
            background: #fef9c3;
            color: #854d0e;
        }

        .status-processing {
            background: #dbeafe;
            color: #1e40af;
        }

        .status-completed {
            background: #dcfce7;
            color: #166534;
        }

        .status-cancelled {
            background: #fee2e2;
            color: #991b1b;
        }

        /* ── Fulfillment pill ── */
        .fulfillment-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.3rem 0.85rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.82rem;
        }

        .fulfillment-delivery {
            background: #ede9fe;
            color: #6d28d9;
        }

        .fulfillment-pickup {
            background: #e0f2fe;
            color: #0369a1;
        }

        /* ── Items table ── */
        .items-table {
            width: 100%;
            border-collapse: collapse;
        }

        .items-table thead tr {
            background: var(--secondary);
            border-bottom: 2px solid var(--border);
        }

        .items-table th {
            padding: 0.85rem 1rem;
            text-align: left;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #6b7280;
        }

        .items-table td {
            padding: 1rem;
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
        }

        .items-table tbody tr:last-child td {
            border-bottom: none;
        }

        .items-table tbody tr {
            transition: background 0.15s ease;
            cursor: pointer;
        }

        .items-table tbody tr:hover {
            background: #faf5ff;
        }

        .product-cell {
            display: flex;
            align-items: center;
            gap: 0.85rem;
        }

        .product-thumb {
            width: 48px;
            height: 48px;
            border-radius: 8px;
            overflow: hidden;
            flex-shrink: 0;
            border: 1px solid var(--border);
            background: var(--secondary);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #d1d5db;
            font-size: 1.1rem;
        }

        .product-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-name {
            font-weight: 600;
            color: var(--dark);
            font-size: 0.92rem;
            margin: 0;
        }

        .product-code {
            font-size: 0.78rem;
            color: #9ca3af;
            margin: 0.15rem 0 0;
        }

        .discount-chip {
            display: inline-block;
            padding: 0.1rem 0.45rem;
            background: #fef3c7;
            color: #92400e;
            border-radius: 4px;
            font-size: 0.72rem;
            font-weight: 700;
        }

        /* ── Summary sidebar ── */
        .summary-card {
            background: white;
            border-radius: 12px;
            border: 1px solid var(--border);
            overflow: hidden;
            position: sticky;
            top: 80px;
        }

        .summary-card .card-header-bar {
            border-bottom: 1px solid var(--border);
        }

        .summary-lines {
            padding: 1.25rem 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 0;
        }

        .summary-line {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.7rem 0;
            border-bottom: 1px solid var(--border);
            font-size: 0.9rem;
        }

        .summary-line:last-of-type {
            border-bottom: none;
        }

        .summary-line .lbl {
            color: #6b7280;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        .summary-line .val {
            font-weight: 600;
            color: var(--dark);
        }

        .summary-line .val.free {
            color: var(--success);
        }

        .summary-line .val.charge {
            color: var(--danger);
        }

        .summary-line .val.dash {
            color: #9ca3af;
        }

        .summary-total-row {
            margin: 0 1.5rem 1.5rem;
            background: linear-gradient(135deg, #f3e8ff 0%, #ede9fe 100%);
            border-radius: 10px;
            padding: 1.1rem 1.25rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid #ddd6fe;
        }

        .summary-total-row .total-lbl {
            font-weight: 700;
            color: var(--dark);
            font-size: 0.95rem;
        }

        .summary-total-row .total-amt {
            font-size: 1.6rem;
            font-weight: 800;
            color: var(--primary);
        }

        /* ── Action buttons ── */
        .actions-row {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        .btn-primary-custom {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            background: var(--primary);
            color: white;
            border: none;
            padding: 0.65rem 1.4rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            text-decoration: none;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .btn-primary-custom:hover {
            color: white;
            filter: brightness(0.9);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(206, 106, 215, 0.3);
        }

        .btn-outline-custom {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            background: white;
            color: var(--text);
            border: 1.5px solid var(--border);
            padding: 0.65rem 1.4rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            text-decoration: none;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .btn-outline-custom:hover {
            border-color: var(--primary);
            color: var(--primary);
            transform: translateY(-1px);
        }

        .btn-danger-custom {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            background: #fee2e2;
            color: var(--danger);
            border: 1.5px solid #fca5a5;
            padding: 0.65rem 1.4rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            text-decoration: none;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .btn-danger-custom:hover {
            background: var(--danger);
            color: white;
            border-color: var(--danger);
            transform: translateY(-1px);
        }

        /* ── Modal ── */
        .item-details-modal {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.45);
            z-index: 1050;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .item-details-modal.show {
            display: flex;
        }

        .modal-box {
            background: white;
            border-radius: 14px;
            padding: 0;
            max-width: 480px;
            width: 100%;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .modal-box-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.2rem 1.5rem;
            border-bottom: 1px solid var(--border);
        }

        .modal-box-header h3 {
            font-size: 1.05rem;
            margin: 0;
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
        }

        .modal-close-btn {
            background: var(--secondary);
            border: none;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            cursor: pointer;
            color: #6b7280;
            font-size: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }

        .modal-close-btn:hover {
            background: var(--border);
            color: var(--dark);
        }

        .modal-box-body {
            padding: 1.5rem;
        }

        .modal-detail-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 0.55rem 0;
            border-bottom: 1px solid var(--border);
            font-size: 0.88rem;
        }

        .modal-detail-row:last-child {
            border-bottom: none;
        }

        .modal-detail-row .mdr-label {
            color: #6b7280;
            flex-shrink: 0;
            margin-right: 1rem;
        }

        .modal-detail-row .mdr-value {
            font-weight: 600;
            color: var(--dark);
            text-align: right;
        }

        /* ── Footer ── */
        .footer {
            background: white;
            border-top: 1px solid var(--border);
            padding: 1.25rem 0;
            text-align: center;
            font-size: 0.85rem;
            color: #9ca3af;
        }

        /* ── Responsive ── */
        @media (max-width: 767px) {
            .info-grid {
                grid-template-columns: 1fr 1fr;
            }

            .items-table th:nth-child(3),
            .items-table th:nth-child(4),
            .items-table td:nth-child(3),
            .items-table td:nth-child(4) {
                display: none;
            }

            .summary-card {
                position: static;
            }
        }

        @media (max-width: 480px) {
            .info-grid {
                grid-template-columns: 1fr;
            }
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
                    <li class="nav-item"><a class="nav-link" href="{{ route('products') }}">Products</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ route('orders.index') }}">My Orders</a>
                    </li>
                </ul>
                <div class="navbar-actions">
                    @auth
                        <a href="{{ route('cart.index') }}" class="nav-link position-relative"
                            style="color:white;text-decoration:none;">
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
                            style="text-decoration:none;color:white;font-size:1.2rem;margin-right:1rem;">
                            <i class="fas fa-heart"></i>
                        </a>
                        <div class="user-menu">
                            @if (auth()->user()->profile_image)
                                <img src="{{ asset('storage/' . auth()->user()->profile_image) }}" alt="Profile"
                                    class="navbar-profile-image">
                            @else
                                <div class="navbar-profile-image"
                                    style="background:rgba(255,255,255,0.25);display:flex;align-items:center;justify-content:center;">
                                    <i class="fas fa-user" style="color:white;"></i>
                                </div>
                            @endif
                            <span class="text-white ms-2">{{ auth()->user()->name }}</span>
                            <div class="dropdown ms-2">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false" style="color:white !important;">
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
                                        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="dropdown-item" onclick="localStorage.clear();">
                                                <i class="fas fa-exchange-alt"></i> Switch Account
                                            </button>
                                        </form>
                                    </li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="dropdown-item">
                                                <i class="fas fa-sign-out-alt"></i> Logout
                                            </button>
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
            <a href="{{ route('orders.index') }}" class="back-link">
                <i class="fas fa-arrow-left"></i> Back to Orders
            </a>
            <h1>Order #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</h1>
            <div class="order-meta">
                <span><i class="far fa-calendar me-1"></i>{{ $order->created_at->format('M d, Y \a\t g:i A') }}</span>
                <span class="status-badge status-{{ $order->status }}">{{ ucfirst($order->status) }}</span>
            </div>
        </div>
    </div>

    <!-- Body -->
    <div class="container page-body">
        <div class="row g-4">

            <!-- Left column -->
            <div class="col-lg-8">
                <div class="main-col">

                    <!-- Order Information -->
                    <div class="card-section">
                        <div class="card-header-bar">
                            <div class="icon-wrap"><i class="fas fa-info-circle"></i></div>
                            <h2>Order Information</h2>
                        </div>
                        <div class="card-body-inner">
                            <div class="info-grid">
                                <div class="info-tile">
                                    <div class="tile-label">Order Date</div>
                                    <div class="tile-value">{{ $order->created_at->format('M d, Y') }}</div>
                                </div>
                                <div class="info-tile">
                                    <div class="tile-label">Status</div>
                                    <div class="tile-value">
                                        <span
                                            class="status-badge status-{{ $order->status }}">{{ ucfirst($order->status) }}</span>
                                    </div>
                                </div>
                                <div class="info-tile">
                                    <div class="tile-label">Items</div>
                                    <div class="tile-value">{{ $order->items->count() }}
                                        {{ Str::plural('item', $order->items->count()) }}</div>
                                </div>
                                <div class="info-tile">
                                    <div class="tile-label">Fulfillment</div>
                                    <div class="tile-value">
                                        @if ($order->fulfillment_method === 'pickup')
                                            <span class="fulfillment-pill fulfillment-pickup">
                                                <i class="fas fa-store"></i> Store Pickup
                                            </span>
                                        @else
                                            <span class="fulfillment-pill fulfillment-delivery">
                                                <i class="fas fa-truck"></i> Delivery
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                @if (($order->fulfillment_method ?? 'delivery') === 'delivery')
                                    <div class="info-tile" style="grid-column: 1 / -1;">
                                        <div class="tile-label">Delivery Address</div>
                                        <div class="tile-value small">
                                            {{ $order->address_line }}
                                            @if($order->city), {{ $order->city }} @endif
                                            @if($order->state), {{ $order->state }} @endif
                                            @if($order->postal_code), {{ $order->postal_code }} @endif
                                            @if($order->country), {{ $order->country }} @endif
                                        </div>
                                    </div>
                                @endif
                                @if ($order->delivery_notes)
                                    <div class="info-tile" style="grid-column: 1 / -1;">
                                        <div class="tile-label">Delivery Notes</div>
                                        <div class="tile-value small">{{ $order->delivery_notes }}</div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Order Items -->
                    <div class="card-section">
                        <div class="card-header-bar">
                            <div class="icon-wrap"><i class="fas fa-shopping-bag"></i></div>
                            <h2>Order Items</h2>
                        </div>
                        <div style="overflow-x: auto;">
                            <table class="items-table">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Qty</th>
                                        <th>Unit Price</th>
                                        <th>Discount</th>
                                        <th style="text-align:right;">Subtotal</th>
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
                                            if (
                                                $discountPercent <= 0 &&
                                                $unitPrice > 0 &&
                                                $finalUnitPrice < $unitPrice
                                            ) {
                                                $discountPercent = (($unitPrice - $finalUnitPrice) / $unitPrice) * 100;
                                            }
                                            $lineTotal =
                                                (float) ($item->line_total ?? $item->quantity * $finalUnitPrice);
                                        @endphp
                                        <tr onclick="showItemDetails({{ json_encode($item) }})">
                                            <td>
                                                <div class="product-cell">
                                                    <div class="product-thumb">
                                                        @if ($item->product && $item->product->image)
                                                            <img src="/storage/{{ $item->product->image }}"
                                                                alt="{{ $item->product->name }}">
                                                        @else
                                                            <i class="fas fa-image"></i>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <p class="product-name">
                                                            {{ $item->product->name ?? 'Unknown Product' }}</p>
                                                        <p class="product-code">{{ $item->product->code ?? 'N/A' }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="font-weight:600;">{{ $item->quantity }}</td>
                                            <td>${{ number_format($unitPrice, 2) }}</td>
                                            <td>
                                                @if ($discountPercent > 0 && $unitPrice > $finalUnitPrice)
                                                    <span
                                                        class="discount-chip">-{{ rtrim(rtrim(number_format($discountPercent, 2), '0'), '.') }}%</span>
                                                @else
                                                    <span style="color:#d1d5db;">—</span>
                                                @endif
                                            </td>
                                            <td style="text-align:right;font-weight:700;color:var(--dark);">
                                                ${{ number_format($lineTotal, 2) }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" style="text-align:center;color:#9ca3af;padding:2rem;">
                                                No items found in this order.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="card-section">
                        <div class="card-body-inner">
                            <div class="actions-row">
                                <a href="{{ route('orders.invoice', ['order' => $order->id]) }}"
                                    class="btn-primary-custom">
                                    <i class="fas fa-file-invoice"></i> View Invoice
                                </a>
                                <a href="{{ route('orders.index') }}" class="btn-outline-custom">
                                    <i class="fas fa-list"></i> All Orders
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Right column — Summary -->
            <div class="col-lg-4">
                <div class="summary-card">
                    <div class="card-header-bar">
                        <div class="icon-wrap"><i class="fas fa-receipt"></i></div>
                        <h2>Order Summary</h2>
                    </div>
                    <div class="summary-lines">
                        <div class="summary-line">
                            <span class="lbl"><i class="fas fa-tag"></i> Subtotal</span>
                            <span
                                class="val">${{ number_format($order->total - ($order->delivery_charge ?? 0), 2) }}</span>
                        </div>
                        <div class="summary-line">
                            <span class="lbl">
                                @if ($order->fulfillment_method === 'pickup')
                                    <i class="fas fa-store"></i> Pickup
                                @else
                                    <i class="fas fa-truck"></i> Delivery
                                @endif
                            </span>
                            @php
                                $deliveryValClass =
                                    $order->fulfillment_method === 'pickup'
                                        ? 'dash'
                                        : (($order->delivery_charge ?? 0) > 0
                                            ? 'charge'
                                            : 'free');
                            @endphp
                            <span class="val {{ $deliveryValClass }}">
                                @if ($order->fulfillment_method === 'pickup')
                                    —
                                @elseif(($order->delivery_charge ?? 0) > 0)
                                    +${{ number_format($order->delivery_charge, 2) }}
                                @else
                                    Free
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="summary-total-row">
                        <span class="total-lbl">Total</span>
                        <span class="total-amt">${{ number_format($order->total, 2) }}</span>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Item Details Modal -->
    <div class="item-details-modal" id="itemModal">
        <div class="modal-box">
            <div class="modal-box-header">
                <h3><i class="fas fa-box-open me-2" style="color:var(--primary);"></i>Item Details</h3>
                <button class="modal-close-btn" onclick="hideItemDetails()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-box-body" id="itemDetailsContent"></div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <p style="margin:0;">&copy; {{ date('Y') }} Glow Skincare. All rights reserved.</p>
    </footer>

    <script>
        function showItemDetails(item) {
            const unitPrice = parseFloat(item.unit_price ?? item.price ?? 0);
            const finalPrice = parseFloat(item.price ?? 0);
            const savedDiscount = parseFloat(item.discount_percent ?? 0);
            const computedDiscount = unitPrice > 0 && finalPrice < unitPrice ?
                ((unitPrice - finalPrice) / unitPrice) * 100 : 0;
            const discountPercent = savedDiscount > 0 ? savedDiscount : computedDiscount;
            const hasDiscount = discountPercent > 0 && unitPrice > finalPrice;
            const lineTotal = parseFloat(item.line_total ?? (item.quantity * finalPrice));

            const rows = [
                ['Product', item.product?.name || 'Unknown'],
                ['Code', item.product?.code || 'N/A'],
                ['Category', item.product?.category?.name || 'N/A'],
                ['Quantity', item.quantity],
                ['Unit Price', `$${unitPrice.toFixed(2)}`],
                ['Discount', hasDiscount ?
                    `-${discountPercent.toFixed(2).replace(/\.00$/,'')}% ($${(unitPrice-finalPrice).toFixed(2)})` :
                    '—'
                ],
                ['Final Price', `$${finalPrice.toFixed(2)}`],
                ['Subtotal', `$${lineTotal.toFixed(2)}`],
            ];

            if (item.product?.description) {
                rows.push(['Description', item.product.description]);
            }

            const html = rows.map(([label, value]) => `
            <div class="modal-detail-row">
                <span class="mdr-label">${label}</span>
                <span class="mdr-value">${value}</span>
            </div>`).join('');

            document.getElementById('itemDetailsContent').innerHTML = html;
            document.getElementById('itemModal').classList.add('show');
        }

        function hideItemDetails() {
            document.getElementById('itemModal').classList.remove('show');
        }

        document.getElementById('itemModal').addEventListener('click', function(e) {
            if (e.target === this) hideItemDetails();
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') hideItemDetails();
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
