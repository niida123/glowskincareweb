<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Checkout - Glow Skincare</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Poppins:wght@300;400;500;600&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --primary-color: #8b5cf6;
            --dark-color: #2d1b4e;
            --light-color: #f8f9fa;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: var(--dark-color);
            background-color: var(--light-color);
        }

        h1,
        h2 {
            font-family: 'Playfair Display', serif;
        }

        /* Navbar */
        .navbar {
            background: linear-gradient(135deg, rgba(139, 92, 246, 0.95) 0%, rgba(236, 72, 153, 0.95) 100%);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
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

        .btn-custom {
            background: white;
            color: var(--primary-color);
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
            color: purple;
            padding: 1rem 0;
            margin-bottom: 2rem;
        }

        .header-line {
            width: 100%;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--primary-color), transparent);
            margin-top: 12px;
        }

        .checkout-card {
            background: white;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            margin-bottom: 1.5rem;
        }

        .order-item {
            display: flex;
            justify-content: space-between;
            padding: 1rem;
            border-bottom: 1px solid #eee;
            align-items: center;
            gap: 1rem;
        }

        .order-item:last-child {
            border-bottom: none;
        }

        .order-item-image {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 8px;
            overflow: hidden;
            flex-shrink: 0;
        }

        .order-item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .item-name {
            font-weight: 600;
        }

        .item-details {
            color: #666;
            font-size: 0.9rem;
        }

        .item-price {
            text-align: right;
            font-weight: 600;
            color: var(--primary-color);
        }

        .summary-section {
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 0.75rem 0;
            border-bottom: 1px solid #ddd;
        }

        .summary-row.total {
            border: none;
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--primary-color);
            padding-top: 1rem;
            margin-top: 1rem;
            border-top: 2px solid #ddd;
        }

        .user-info {
            background: #f0f7ff;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            border-left: 4px solid var(--primary-color);
        }

        .confirmation-checkbox {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem;
            background: #fff3cd;
            border-radius: 8px;
            margin: 1.5rem 0;
        }

        .confirmation-checkbox input[type="checkbox"] {
            width: 20px;
            height: 20px;
            cursor: pointer;
        }

        .btn-place-order {
            width: 100%;
            background: linear-gradient(135deg, #8b5cf6 0%, #ec4899 100%);
            color: white;
            border: none;
            padding: 1rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }

        .btn-place-order:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(255, 107, 157, 0.3);
            color: white;
        }

        .btn-place-order:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .btn-back {
            width: 100%;
            background: #6c757d;
            color: white;
            border: none;
            padding: 0.75rem;
            border-radius: 8px;
            font-weight: 600;
            margin-top: 0.5rem;
        }

        .error-alert {
            display: none;
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
                                    style="background: var(--primary-color); display: flex; align-items: center; justify-content: center;">
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

    <!-- Page Header -->
    <div class="page-header">
        <div class="container">
            <h1><i class="fas fa-lock me-2"></i> Secure Checkout</h1>
            <div class="header-line"></div>
        </div>
    </div>

    <!-- Checkout Form -->
    <div class="container py-4">
        <div class="row">
            <div class="col-lg-8">
                <!-- User Info -->
                <div class="checkout-card">
                    <h4 class="mb-3"><i class="fas fa-user me-2"></i> Billing Information</h4>
                    <div class="user-info">
                        <div><strong>Name:</strong> {{ auth()->user()->name }}</div>
                        <div><strong>Email:</strong> {{ auth()->user()->email }}</div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="checkout-card">
                    <h4 class="mb-3"><i class="fas fa-list me-2"></i> Order Summary</h4>

                    @foreach ($cartItems as $item)
                        <div class="order-item">
                            <div class="order-item-image">
                                @if ($item['product']->image)
                                    <img src="/storage/{{ $item['product']->image }}"
                                        alt="{{ $item['product']->name }}">
                                @else
                                    <i class="fas fa-image"></i>
                                @endif
                            </div>
                            <div style="flex: 1;">
                                <div class="item-name">{{ $item['product']->name }}</div>
                                <div class="item-details">
                                    Qty: {{ $item['quantity'] }} × ${{ number_format($item['finalPrice'], 2) }}
                                </div>
                                @if(($item['product']->discount ?? 0) > 0)
                                    <small class="text-muted d-block">
                                        <s>${{ number_format($item['product']->price, 2) }}</s>
                                        <span class="text-success ms-1">-{{ rtrim(rtrim(number_format($item['product']->discount, 2), '0'), '.') }}% (save ${{ number_format($item['product']->price - $item['finalPrice'], 2) }})</span>
                                    </small>
                                @endif
                            </div>
                            <div class="item-price">
                                ${{ number_format($item['subtotal'], 2) }}
                            </div>
                        </div>
                    @endforeach

                    <div class="summary-section mt-3">
                        <div class="summary-row">
                            <span>Subtotal:</span>
                            <span id="subtotalMain">${{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="summary-row" id="deliveryDistanceRowMain" style="display:none;">
                            <span>Distance:</span>
                            <span id="deliveryDistanceMain">0.00 km</span>
                        </div>
                        <div class="summary-row">
                            <span>Delivery Fee:</span>
                            <span id="deliveryFeeMain">$0.00</span>
                        </div>
                        <div class="summary-row total">
                            <span>Total:</span>
                            <span id="totalMain">${{ number_format($total, 2) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Fulfillment Method & Location -->
                <div class="checkout-card">
                    <h4 class="mb-3"><i class="fas fa-truck me-2"></i> Fulfillment</h4>
                    <form action="/checkout" method="POST" id="checkoutForm">
                        @csrf

                        @if ($errors->any())
                            <div class="alert alert-danger" role="alert">
                                <strong>Error placing order:</strong>
                                <ul class="mb-0 mt-2">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="error-alert" id="errorAlert" role="alert"
                            style="color: #721c24; background-color: #f8d7da; border: 1px solid #f5c6cb; padding: 12px; border-radius: 4px;">
                            Please confirm the order to proceed.
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Choose Method</label>
                            <div class="d-flex gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="fulfillment_method"
                                        id="methodPickup" value="pickup" required>
                                    <label class="form-check-label" for="methodPickup">
                                        <i class="fas fa-store me-1"></i> Pick Up
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="fulfillment_method"
                                        id="methodDelivery" value="delivery" required>
                                    <label class="form-check-label" for="methodDelivery">
                                        <i class="fas fa-truck-fast me-1"></i> Delivery
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div id="deliveryAddressFields" class="border rounded p-3 mb-3"
                            style="display:none; background:#f8f9fa;">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label">Search or pick your delivery location</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                                        <input type="text" id="address_search" class="form-control"
                                            placeholder="Search an address...">
                                        <button type="button" class="btn btn-outline-secondary" id="searchAddressBtn">
                                            Search
                                        </button>
                                    </div>
                                    <div id="map" style="height: 320px; border-radius: 8px;" class="mb-2"></div>
                                    <button type="button" class="btn btn-sm btn-outline-primary mb-3" id="locateMeBtn">
                                        <i class="fas fa-location-crosshairs me-1"></i> Use My Location
                                    </button>
                                    <input type="hidden" name="latitude" id="latitude">
                                    <input type="hidden" name="longitude" id="longitude">
                                </div>
                                <div class="col-12">
                                    <label for="address_line" class="form-label">Address</label>
                                    <input type="text" name="address_line" id="address_line" class="form-control"
                                        placeholder="Street, building, apartment">
                                </div>
                                <div class="col-md-6">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" name="city" id="city" class="form-control"
                                        placeholder="City">
                                </div>
                                <div class="col-md-6">
                                    <label for="state" class="form-label">State/Province</label>
                                    <input type="text" name="state" id="state" class="form-control"
                                        placeholder="State or Province">
                                </div>
                                <div class="col-md-6">
                                    <label for="postal_code" class="form-label">Postal Code</label>
                                    <input type="text" name="postal_code" id="postal_code" class="form-control"
                                        placeholder="Postal Code">
                                </div>
                                <div class="col-md-6">
                                    <label for="country_select" class="form-label">Country</label>
                                    <select name="country_select" id="country_select" class="form-select">
                                        <option value="" selected disabled>Select a country</option>
                                        <option value="cambodia">Cambodia</option>
                                        <option value="Philippines">Philippines</option>
                                        <option value="Vietnam">Vietnam</option>
                                        <option value="United States">United States</option>
                                        <option value="Canada">Canada</option>
                                        <option value="United Kingdom">United Kingdom</option>
                                        <option value="Australia">Australia</option>
                                        <option value="Singapore">Singapore</option>
                                        <option value="Japan">Japan</option>
                                        <option value="Germany">Germany</option>
                                        <option value="France">France</option>
                                        <option value="Philippines">Philippines</option>
                                        <option value="Malaysia">Malaysia</option>
                                        <option value="Thailand">Thailand</option>
                                        <option value="Indonesia">Indonesia</option>
                                        <option value="India">India</option>
                                        <option value="China">China</option>
                                        <option value="South Korea">South Korea</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                                <div class="col-md-6" id="country_other_container" style="display:none;">
                                    <label for="country_other" class="form-label">Country (Other)</label>
                                    <input type="text" id="country_other" class="form-control"
                                        placeholder="Enter your country">
                                </div>
                                <input type="hidden" name="country" id="country_hidden" value="">
                                <div class="col-12">
                                    <label for="delivery_notes" class="form-label">Delivery Notes (optional)</label>
                                    <textarea name="delivery_notes" id="delivery_notes" class="form-control" rows="2"
                                        placeholder="Gate code, instructions, contact preference..."></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="confirmation-checkbox">
                            <input type="checkbox" name="confirm" id="confirmCheckbox" value="1" required>
                            <label for="confirmCheckbox" class="mb-0">
                                I confirm this order and agree to the terms and conditions
                            </label>
                        </div>

                        @if (config('services.paypal.client_id'))
                            <div class="mb-3">
                                <div id="paypal-button-container"></div>
                                <small class="text-muted">Pay securely with PayPal.</small>
                            </div>
                        @endif

                        <button type="submit" class="btn btn-place-order" id="placeOrderBtn">
                            <i class="fas fa-check me-2"></i> Place Order
                        </button>
                        <a href="/cart" class="btn btn-back">
                            <i class="fas fa-arrow-left me-2"></i> Back to Cart
                        </a>
                    </form>
                </div>
            </div>

            <!-- Order Total Sidebar -->
            <div class="col-lg-4">
                <div class="checkout-card sticky-top" style="top: 100px;">
                    <h5 class="mb-3">Order Total</h5>
                    <div class="summary-section">
                        <div class="summary-row">
                            <span>Items ({{ count($cartItems) }}):</span>
                            <span id="subtotalSidebar">${{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="summary-row" id="deliveryDistanceRowSidebar" style="display:none;">
                            <span>Distance:</span>
                            <span id="deliveryDistanceSidebar">0.00 km</span>
                        </div>
                        <div class="summary-row">
                            <span>Delivery Fee:</span>
                            <span id="deliveryFeeSidebar">$0.00</span>
                        </div>
                        <div class="summary-row">
                            <span>Tax:</span>
                            <span>$0.00</span>
                        </div>
                        <div class="summary-row total">
                            <span>Total:</span>
                            <span id="totalSidebar">${{ number_format($total, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    @if (config('services.paypal.client_id'))
        <script src="https://www.paypal.com/sdk/js?client-id={{ config('services.paypal.client_id') }}&currency=USD"></script>
    @endif

    <script>
        // ─── Element references ───────────────────────────────────────────────
        const confirmCheckbox = document.getElementById('confirmCheckbox');
        const placeOrderBtn = document.getElementById('placeOrderBtn');
        const errorAlert = document.getElementById('errorAlert');
        const checkoutForm = document.getElementById('checkoutForm');
        const methodPickup = document.getElementById('methodPickup');
        const methodDelivery = document.getElementById('methodDelivery');
        const deliveryFields = document.getElementById('deliveryAddressFields');
        const countrySelect = document.getElementById('country_select');
        const countryOtherCont = document.getElementById('country_other_container');
        const countryOtherInput = document.getElementById('country_other');
        const countryHidden = document.getElementById('country_hidden');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const subtotalValue = Number(@json((float) $subtotal));
        @php
            $deliveryConfigForJs = $deliveryConfig ?? [
                'origin_lat' => 11.5564,
                'origin_lng' => 104.9282,
                'base_fee' => 1.50,
                'fee_per_km' => 0.35,
            ];
        @endphp
        const deliveryConfig = @json($deliveryConfigForJs);

        const deliveryDistanceRowMain = document.getElementById('deliveryDistanceRowMain');
        const deliveryDistanceRowSidebar = document.getElementById('deliveryDistanceRowSidebar');
        const deliveryDistanceMain = document.getElementById('deliveryDistanceMain');
        const deliveryDistanceSidebar = document.getElementById('deliveryDistanceSidebar');
        const deliveryFeeMain = document.getElementById('deliveryFeeMain');
        const deliveryFeeSidebar = document.getElementById('deliveryFeeSidebar');
        const totalMain = document.getElementById('totalMain');
        const totalSidebar = document.getElementById('totalSidebar');

        function toMoney(value) {
            return `$${Number(value).toFixed(2)}`;
        }

        function round2(value) {
            return Math.round(Number(value) * 100) / 100;
        }

        function distanceKm(fromLat, fromLng, toLat, toLng) {
            const earthRadiusKm = 6371;
            const dLat = (toLat - fromLat) * Math.PI / 180;
            const dLng = (toLng - fromLng) * Math.PI / 180;
            const a =
                Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                Math.cos(fromLat * Math.PI / 180) * Math.cos(toLat * Math.PI / 180) *
                Math.sin(dLng / 2) * Math.sin(dLng / 2);
            const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            return earthRadiusKm * c;
        }

        function calculateDeliveryPricing() {
            if (!methodDelivery.checked) {
                return {
                    distanceKm: 0,
                    fee: 0,
                    total: round2(subtotalValue),
                };
            }

            const destinationLat = parseFloat(document.getElementById('latitude').value);
            const destinationLng = parseFloat(document.getElementById('longitude').value);

            if (!Number.isFinite(destinationLat) || !Number.isFinite(destinationLng)) {
                return {
                    distanceKm: 0,
                    fee: 0,
                    total: round2(subtotalValue),
                };
            }

            const originLat = Number(deliveryConfig.origin_lat ?? 11.5564);
            const originLng = Number(deliveryConfig.origin_lng ?? 104.9282);
            const baseFee = Number(deliveryConfig.base_fee ?? 1.5);
            const feePerKm = Number(deliveryConfig.fee_per_km ?? 0.35);

            const km = distanceKm(originLat, originLng, destinationLat, destinationLng);
            const fee = round2(baseFee + (km * feePerKm));

            return {
                distanceKm: round2(km),
                fee: Math.max(0, fee),
                total: round2(subtotalValue + Math.max(0, fee)),
            };
        }

        function updatePricingSummary() {
            const pricing = calculateDeliveryPricing();
            const showDistance = methodDelivery.checked;

            if (deliveryDistanceRowMain) {
                deliveryDistanceRowMain.style.display = showDistance ? '' : 'none';
            }
            if (deliveryDistanceRowSidebar) {
                deliveryDistanceRowSidebar.style.display = showDistance ? '' : 'none';
            }
            if (deliveryDistanceMain) {
                deliveryDistanceMain.textContent = `${pricing.distanceKm.toFixed(2)} km`;
            }
            if (deliveryDistanceSidebar) {
                deliveryDistanceSidebar.textContent = `${pricing.distanceKm.toFixed(2)} km`;
            }

            if (deliveryFeeMain) {
                deliveryFeeMain.textContent = methodDelivery.checked ? toMoney(pricing.fee) : 'Free';
                deliveryFeeMain.classList.toggle('text-success', !methodDelivery.checked);
            }
            if (deliveryFeeSidebar) {
                deliveryFeeSidebar.textContent = methodDelivery.checked ? toMoney(pricing.fee) : 'Free';
                deliveryFeeSidebar.classList.toggle('text-success', !methodDelivery.checked);
            }
            if (totalMain) {
                totalMain.textContent = toMoney(pricing.total);
            }
            if (totalSidebar) {
                totalSidebar.textContent = toMoney(pricing.total);
            }
        }

        // ─── Confirm checkbox ─────────────────────────────────────────────────
        placeOrderBtn.disabled = !confirmCheckbox.checked;
        confirmCheckbox.addEventListener('change', function() {
            placeOrderBtn.disabled = !this.checked;
            if (this.checked) errorAlert.style.display = 'none';
        });

        // ─── Country dropdown ─────────────────────────────────────────────────
        function updateCountryUI() {
            const sel = countrySelect.value;
            const isOther = sel === 'Other';
            countryOtherCont.style.display = isOther ? 'block' : 'none';
            countryHidden.value = isOther ? countryOtherInput.value.trim() : (sel || '');
        }
        countrySelect.addEventListener('change', updateCountryUI);
        countryOtherInput.addEventListener('input', updateCountryUI);

        // Restore old() value if validation failed on a previous POST
        const oldCountry = @json(old('country', ''));
        if (oldCountry) {
            const vals = Array.from(countrySelect.options).map(o => o.value);
            if (vals.includes(oldCountry)) {
                countrySelect.value = oldCountry;
            } else {
                countrySelect.value = 'Other';
                countryOtherInput.value = oldCountry;
            }
        }
        updateCountryUI();

        // ─── Fulfillment toggle ───────────────────────────────────────────────
        function updateDeliveryVisibility() {
            const isDelivery = methodDelivery.checked;
            deliveryFields.style.display = isDelivery ? 'block' : 'none';

            if (isDelivery) {
                initDeliveryMap();
            }

            updatePricingSummary();
        }
        [methodPickup, methodDelivery].forEach(r => r.addEventListener('change', updateDeliveryVisibility));
        updateDeliveryVisibility(); // Run once on page load

        // ─── Form submission validation ───────────────────────────────────────
        checkoutForm.addEventListener('submit', function(e) {
            if (!confirmCheckbox.checked) {
                e.preventDefault();
                errorAlert.style.display = 'block';
                return;
            }

            if (methodDelivery.checked) {
                const addressLine = document.getElementById('address_line').value.trim();
                const city = document.getElementById('city').value.trim();

                if (!addressLine || !city) {
                    e.preventDefault();
                    alert('Please provide a delivery address and city.');
                    document.getElementById(addressLine ? 'city' : 'address_line').focus();
                    return;
                }

                const sel = countrySelect.value;
                if (!sel) {
                    e.preventDefault();
                    alert('Please select your country.');
                    countrySelect.focus();
                    return;
                }
                if (sel === 'Other' && !countryOtherInput.value.trim()) {
                    e.preventDefault();
                    alert('Please enter your country name.');
                    countryOtherInput.focus();
                    return;
                }
                // Sync country hidden field one final time
                countryHidden.value = (sel === 'Other') ? countryOtherInput.value.trim() : sel;
            }
        });

        // ─── Leaflet Map (OpenStreetMap + Nominatim) ─────────────────────────
        let map, marker;
        let mapInitialised = false;

        // Default: Phnom Penh, Cambodia
        const DEFAULT_CENTER = {
            lat: 11.5564,
            lng: 104.9282
        };

        function initDeliveryMap() {
            if (mapInitialised) {
                map.invalidateSize();
                return;
            }
            mapInitialised = true;

            map = L.map('map').setView([DEFAULT_CENTER.lat, DEFAULT_CENTER.lng], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            marker = L.marker([DEFAULT_CENTER.lat, DEFAULT_CENTER.lng], {
                draggable: true,
                title: 'Drag me to your delivery location'
            }).addTo(map);

            // Seed hidden fields with default center
            setHiddenLatLng(DEFAULT_CENTER.lat, DEFAULT_CENTER.lng);
            reverseGeocode(DEFAULT_CENTER.lat, DEFAULT_CENTER.lng);

            // Click on map -> move marker
            map.on('click', function(e) {
                applyLatLng(e.latlng.lat, e.latlng.lng);
            });

            // Drag end -> update fields
            marker.on('dragend', function() {
                const pos = marker.getLatLng();
                applyLatLng(pos.lat, pos.lng);
            });

            // Address search (via Nominatim)
            const searchInput = document.getElementById('address_search');
            const searchBtn = document.getElementById('searchAddressBtn');
            if (searchInput) {
                searchInput.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        searchAddress();
                    }
                });
            }
            if (searchBtn) {
                searchBtn.addEventListener('click', searchAddress);
            }

            // "Use My Location" button
            const locateBtn = document.getElementById('locateMeBtn');
            if (locateBtn) {
                locateBtn.addEventListener('click', function() {
                    if (!navigator.geolocation) {
                        alert('Geolocation is not supported by your browser.');
                        return;
                    }
                    const origHTML = locateBtn.innerHTML;
                    locateBtn.disabled = true;
                    locateBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Locating...';

                    navigator.geolocation.getCurrentPosition(
                        function(pos) {
                            locateBtn.disabled = false;
                            locateBtn.innerHTML = origHTML;
                            applyLatLng(pos.coords.latitude, pos.coords.longitude);
                        },
                        function() {
                            locateBtn.disabled = false;
                            locateBtn.innerHTML = origHTML;
                            alert(
                                'Unable to get your location. Please allow location access or pick a spot on the map.');
                        }, {
                            enableHighAccuracy: true,
                            timeout: 10000,
                            maximumAge: 0
                        }
                    );
                });
            }
        }

        async function searchAddress() {
            const searchInput = document.getElementById('address_search');
            const query = searchInput ? searchInput.value.trim() : '';
            if (!query) return;

            try {
                const endpoint =
                    `https://nominatim.openstreetmap.org/search?format=json&addressdetails=1&limit=1&q=${encodeURIComponent(query)}`;
                const res = await fetch(endpoint);
                const data = await res.json();
                if (!Array.isArray(data) || data.length === 0) {
                    alert('Address not found. Try a more specific search.');
                    return;
                }

                const hit = data[0];
                applyLatLng(parseFloat(hit.lat), parseFloat(hit.lon));
                fillAddressFromNominatim(hit);
            } catch (e) {
                alert('Unable to search address right now. Please try again.');
            }
        }

        // Move marker + pan map + update hidden fields + reverse geocode
        function applyLatLng(lat, lng) {
            marker.setLatLng([lat, lng]);
            map.panTo([lat, lng]);
            setHiddenLatLng(lat, lng);
            reverseGeocode(lat, lng);
        }

        function setHiddenLatLng(lat, lng) {
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;
            updatePricingSummary();
        }

        // Convert coordinates -> human-readable address fields
        async function reverseGeocode(lat, lng) {
            try {
                const endpoint =
                    `https://nominatim.openstreetmap.org/reverse?format=json&addressdetails=1&lat=${lat}&lon=${lng}`;
                const res = await fetch(endpoint);
                const data = await res.json();
                if (data) {
                    fillAddressFromNominatim(data);
                }
            } catch (e) {
                // Silent fail: users can still fill address manually
            }
        }

        // Populate form fields from Nominatim address payload
        function fillAddressFromNominatim(result) {
            const address = result.address || {};

            const streetNumber = address.house_number || '';
            const route = address.road || '';
            const sublocality = address.suburb || address.neighbourhood || '';
            const locality = address.city || address.town || address.village || address.county || '';
            const admin1 = address.state || '';
            const postal = address.postcode || '';
            const countryName = address.country || '';

            let addressLine = [streetNumber, route, sublocality].filter(Boolean).join(' ').trim();
            if (!addressLine) {
                addressLine = result.display_name || '';
            }

            document.getElementById('address_line').value = addressLine;
            document.getElementById('city').value = locality;
            document.getElementById('state').value = admin1;
            document.getElementById('postal_code').value = postal;

            // Map country to dropdown or "Other"
            if (countryName) {
                const vals = Array.from(countrySelect.options).map(o => o.value);
                if (vals.includes(countryName)) {
                    countrySelect.value = countryName;
                    countryOtherInput.value = '';
                } else {
                    countrySelect.value = 'Other';
                    countryOtherInput.value = countryName;
                }
                updateCountryUI();
            }
        }

        // ─── PayPal ───────────────────────────────────────────────────────────
        @if (config('services.paypal.client_id'))
            if (window.paypal && document.getElementById('paypal-button-container')) {
                paypal.Buttons({
                    createOrder: function() {
                        const formData = new FormData(checkoutForm);
                        const payload = Object.fromEntries(formData.entries());

                        return fetch('{{ route('paypal.create-order') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                            },
                            body: JSON.stringify(payload),
                        }).then(r => r.json()).then(d => d.id);
                    },
                    onApprove: function(data) {
                        const formData = new FormData(checkoutForm);
                        return fetch(`{{ url('/paypal/capture-order') }}/${data.orderID}`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken
                            },
                            body: formData,
                        }).then(r => r.json()).then(res => {
                            if (res.redirect) window.location.href = res.redirect;
                            else alert(res.message || 'Payment captured but redirect missing.');
                        }).catch(() => alert('Unable to capture payment.'));
                    },
                    onError: function() {
                        alert('PayPal payment failed. Please try again.');
                    },
                }).render('#paypal-button-container');
            }
        @endif

        // ─── Show server-side validation errors ──────────────────────────────
        @if ($errors->any() && request()->isMethod('POST'))
            errorAlert.style.display = 'block';
        @endif

        updatePricingSummary();
    </script>
</body>

</html>
