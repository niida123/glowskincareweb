<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Shopping Cart - Glow Skincare</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    
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

        h1, h2 {
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
            color: rgb(0, 0, 0);
            padding: 3rem 0;
            margin-bottom: 2rem;
        }
        .header-line {
            width: 100%;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--primary-color), transparent);
            margin-top: 12px;
        }

        .cart-item {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            display: flex;
            gap: 1.5rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }

        .item-image {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
            flex-shrink: 0;
        }

        .item-details {
            flex: 1;
        }

        .item-name {
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
        }

        .item-price {
            color: var(--primary-color);
            font-weight: 600;
            font-size: 1.2rem;
        }

        .quantity-control {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 0.5rem;
        }

        .quantity-control button {
            width: 35px;
            height: 35px;
            padding: 0;
            border: 1px solid #ddd;
            background: white;
            cursor: pointer;
            border-radius: 4px;
        }

        .quantity-control input {
            width: 50px;
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 0.25rem;
        }

        .item-subtotal {
            text-align: right;
            font-weight: 700;
            font-size: 1.2rem;
            color: var(--primary-color);
        }

        .cart-summary {
            background: white;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 0.75rem 0;
            border-bottom: 1px solid #eee;
        }

        .summary-row.total {
            border: none;
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--primary-color);
            padding-top: 1rem;
            margin-top: 1rem;
        }

        .btn-checkout {
            width: 100%;
            background: linear-gradient(135deg, #8b5cf6 0%, #ec4899 100%);
            color: white;
            border: none;
            padding: 1rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1.1rem;
            margin-top: 1rem;
            transition: all 0.3s ease;
        }

        .btn-checkout:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(255, 107, 157, 0.3);
            color: white;
        }

        .btn-continue {
            width: 100%;
            background: #6c757d;
            color: white;
            border: none;
            padding: 0.75rem;
            border-radius: 8px;
            font-weight: 600;
            margin-top: 0.5rem;
        }

        .empty-cart {
            text-align: center;
            padding: 4rem 2rem;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 15px;
            border: 2px dashed #dee2e6;
            margin-top: 2rem;
        }

        .empty-cart-icon {
            font-size: 5rem;
            background: linear-gradient(135deg, #8b5cf6 0%, #ec4899 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1.5rem;
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        .empty-cart h3 {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
            font-weight: 700;
        }

        .empty-cart-text {
            color: #6c757d;
            font-size: 1rem;
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .empty-cart-actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-shop {
            background: linear-gradient(135deg, #8b5cf6 0%, #ec4899 100%);
            color: white;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-shop:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(255, 107, 157, 0.3);
            color: white;
        }

        .btn-browse {
            background: white;
            color: var(--primary-color);
            border: 2px solid var(--primary-color);
            padding: 0.55rem 1.8rem;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-browse:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-2px);
        }

        .empty-cart-tips {
            margin-top: 2.5rem;
            padding-top: 2rem;
            border-top: 1px solid #dee2e6;
        }

        .empty-cart-tips h5 {
            color: var(--dark-color);
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .tips-list {
            display: flex;
            justify-content: center;
            gap: 2rem;
            flex-wrap: wrap;
            font-size: 0.95rem;
            color: #6c757d;
        }

        .tips-list div {
            flex: 0 0 auto;
        }

        .tips-list i {
            color: var(--primary-color);
            margin-right: 0.5rem;
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
                            <a class="nav-link" href="{{ route('orders.index') }}">Orders</a>
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
            <h1><i class="fas fa-shopping-cart me-2"></i> Shopping Cart</h1>
            <div class="header-line"></div>
        </div>
    </div>

    <!-- Cart Contents -->
    <div class="container py-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            <div class="col-lg-8">
                @forelse($cartItems as $item)
                    <div class="cart-item">
                        <div class="item-image">
                            @if($item['product']->image)
                                <img src="/storage/{{ $item['product']->image }}" alt="{{ $item['product']->name }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px;">
                            @else
                                <i class="fas fa-image"></i>
                            @endif
                        </div>
                        <div class="item-details flex-grow-1">
                            <div class="item-name">{{ $item['product']->name }}</div>
                            <div class="item-price">${{ number_format($item['finalPrice'], 2) }}</div>
                            @if(($item['product']->discount ?? 0) > 0)
                                <small class="text-muted">
                                    <s>${{ number_format($item['product']->price, 2) }}</s>
                                    <span class="text-success ms-1">-{{ rtrim(rtrim(number_format($item['product']->discount, 2), '0'), '.') }}%</span>
                                </small>
                            @endif
                            <div class="quantity-control">
                                <button onclick="updateQuantity({{ $item['product']->id }}, -1)">−</button>
                                <input type="number" id="qty-{{ $item['product']->id }}" value="{{ $item['quantity'] }}" min="1" onchange="updateQuantity({{ $item['product']->id }}, parseInt(this.value))">
                                <button onclick="updateQuantity({{ $item['product']->id }}, 1)">+</button>
                                <button type="button" class="btn btn-outline-danger" onclick="removeItem({{ $item['product']->id }})">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </div>
                        <div class="item-subtotal">
                            ${{ number_format($item['subtotal'], 2) }}
                        </div>
                    </div>
                @empty
                    <div class="empty-cart">
                        <div class="empty-cart-icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <h3>Your Cart is Empty</h3>
                        <p class="empty-cart-text">
                            Looks like you haven't added any items yet.<br>
                            Start exploring our collection of premium skincare products!
                        </p>
                        <div class="empty-cart-actions">
                            <a href="{{ route('products') }}" class="btn-shop">
                                <i class="fas fa-spa"></i> Shop Now
                            </a>
                            <a href="{{ route('home') }}" class="btn-browse">
                                <i class="fas fa-home"></i> Browse Home
                            </a>
                        </div>
                        <div class="empty-cart-tips">
                            <h5>Why Shop With Us?</h5>
                            <div class="tips-list">
                                <div>
                                    <i class="fas fa-shipping-fast"></i> Fast Shipping
                                </div>
                                <div>
                                    <i class="fas fa-shield-alt"></i> Secure Checkout
                                </div>
                                <div>
                                    <i class="fas fa-star"></i> Premium Quality
                                </div>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>

            @if(count($cartItems) > 0)
                <div class="col-lg-4">
                    <div class="cart-summary">
                        <h4 class="mb-3">Order Summary</h4>
                        
                        <div class="summary-row">
                            <span>Subtotal:</span>
                            <span>${{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="summary-row">
                            <span>Shipping:</span>
                            <span>Free</span>
                        </div>
                        <div class="summary-row total">
                            <span>Total:</span>
                            <span>${{ number_format($total, 2) }}</span>
                        </div>

                        <a href="{{ route('checkout.index') }}" class="btn btn-checkout">
                            <i class="fas fa-credit-card me-2"></i> Proceed to Checkout
                        </a>
                        <a href="{{ route('products') }}" class="btn btn-continue">Continue Shopping</a>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';

        function updateQuantity(productId, newQuantity) {
            // If newQuantity is a delta (from +/- buttons), calculate absolute quantity
            const input = document.getElementById('qty-' + productId);
            const currentQty = parseInt(input.value);
            
            // If passed value is -1 or +1, it's a delta
            let finalQuantity;
            if (newQuantity === -1 || newQuantity === 1) {
                finalQuantity = Math.max(1, currentQty + newQuantity);
            } else {
                finalQuantity = Math.max(1, newQuantity);
            }
            
            axios.post('/cart/update', {
                product_id: productId,
                quantity: finalQuantity
            }, {
                headers: {'X-CSRF-TOKEN': token}
            }).then(() => {
                location.reload();
            }).catch(error => {
                console.error('Error updating cart:', error);
                alert('Failed to update cart');
            });
        }

        function removeItem(productId) {
            if (confirm('Remove this item from cart?')) {
                axios.post('/cart/remove', {
                    product_id: productId
                }, {
                    headers: {'X-CSRF-TOKEN': token}
                }).then(() => {
                    location.reload();
                }).catch(error => {
                    console.error('Error removing item:', error);
                    alert('Failed to remove item');
                });
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
