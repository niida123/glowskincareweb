<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>My Wishlist - Glow Skincare</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Poppins:wght@300;400;500;600&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --primary-color: #ce6ad7;
            --dark-color: #111827;
            --light-color: #f3f4f6;
            --border: #e5e7eb;
            --text: #374151;
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

        .navbar {
            background: var(--primary-color);
            box-shadow: 0 1px 8px rgba(0, 0, 0, 0.08);
            padding: 1rem
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
            background: var(--light-color);
            color: var(--dark-color);
        }

        .user-info {
            padding: 0.75rem 1.25rem;
            border-bottom: 1px solid var(--border);
            margin-bottom: 0.5rem;
        }

        .user-info-name {
            color: var(--dark-color);
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
            color: var(--dark-color);
            padding: 2.2rem 0;
            margin-bottom: 2rem;
            border-bottom: 4px solid var(--primary-color);
        }

        .page-header h1 {
            font-size: 2.2rem;
            font-weight: 700;
            margin: 0;
            color: var(--primary-color);
        }

        .wishlist-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }

        .wishlist-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            position: relative;
        }

        .wishlist-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .wishlist-image {
            width: 100%;
            height: 220px;
            object-fit: cover;
            background: var(--primary-color);
        }

        .wishlist-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .wishlist-content {
            padding: 1.25rem;
        }

        .wishlist-category {
            color: #6c757d;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.5rem;
        }

        .wishlist-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--dark-color);
        }

        .wishlist-price {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--primary-color);
            margin: 0.75rem 0;
        }

        .wishlist-stock {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .stock-in {
            background: #d4edda;
            color: #155724;
        }

        .stock-out {
            background: #f8d7da;
            color: #721c24;
        }

        .wishlist-actions {
            display: flex;
            gap: 0.5rem;
        }

        .btn-add-cart {
            flex: 1;
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 0.65rem 1rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-add-cart:hover:not(:disabled) {
            filter: brightness(0.9);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
        }

        .btn-add-cart:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .btn-view {
            background: white;
            color: var(--primary-color);
            border: 1.5px solid var(--primary-color);
            padding: 0.65rem 1rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .btn-view:hover {
            background: var(--primary-color);
            color: white;
        }

        .btn-remove {
            position: absolute;
            top: 10px;
            right: 10px;
            background: white;
            color: #dc3545;
            border: none;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            z-index: 10;
        }

        .btn-remove:hover {
            background: #dc3545;
            color: white;
            transform: scale(1.1);
        }

        .empty-wishlist {
            text-align: center;
            padding: 5rem 2rem;
            background: white;
            border-radius: 15px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
            margin-top: 2rem;
        }

        .empty-wishlist-icon {
            font-size: 6rem;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
        }

        .empty-wishlist h3 {
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 0.75rem;
        }

        .empty-wishlist p {
            font-size: 1.1rem;
            color: #6c757d;
            margin-bottom: 2rem;
        }

        .btn-browse {
            display: inline-block;
            background: var(--primary-color);
            color: white;
            padding: 0.85rem 2.5rem;
            border-radius: 30px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 1.05rem;
        }

        .btn-browse:hover {
            filter: brightness(0.92);
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            color: white;
        }

        .footer {
            background: var(--light-color);
            color: var(--text);
            padding: 1.75rem 0 0.75rem;
            margin-top: 2rem;
            border-top: 1px solid var(--border);
        }

        .footer h5 {
            font-size: 0.95rem;
            margin-bottom: 0.85rem;
            font-weight: 700;
            color: var(--dark-color);
        }

        .footer p {
            font-size: 0.9rem;
            color: var(--text);
        }

        .footer a {
            color: var(--text);
            text-decoration: none;
            transition: color 0.3s ease;
            font-size: 0.9rem;
        }

        .footer a:hover {
            color: var(--primary-color);
        }

        .footer-links {
            list-style: none;
            padding-left: 0;
            margin-bottom: 0;
        }

        .footer-links li {
            margin-bottom: 0.3rem;
        }

        .footer-divider {
            border-top: 1px solid var(--border);
            margin-top: 1.25rem;
            padding-top: 1rem;
            font-size: 0.85rem;
        }

        .social-links {
            display: flex;
            gap: 1rem;
        }

        .social-links a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 34px;
            height: 34px;
            background: white;
            border: 1px solid var(--border);
            color: var(--text);
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .social-links a:hover {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
            transform: translateY(-3px);
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
            <h1><i class="fas fa-heart me-3"></i>My Wishlist</h1>
        </div>
    </div>

    <!-- Wishlist Contents -->
    <div class="container py-4">
        @if ($wishlistItems->count() > 0)
            <div class="wishlist-grid">
                @foreach ($wishlistItems as $item)
                    @if ($item->product)
                        <div class="wishlist-card">
                            <form action="{{ route('wishlist.remove') }}" method="POST" style="display: inline;">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                                <button type="submit" class="btn-remove" title="Remove from wishlist">
                                    <i class="fas fa-times"></i>
                                </button>
                            </form>
                            <div class="wishlist-image">
                                @if ($item->product->image)
                                    <img src="/storage/{{ $item->product->image }}"
                                        alt="{{ $item->product->name }}">
                                @else
                                    <div
                                        style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-image" style="color: white; font-size: 3rem;"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="wishlist-content">
                                <p class="wishlist-category">{{ $item->product->category->name ?? 'Uncategorized' }}
                                </p>
                                <h3 class="wishlist-title">{{ $item->product->name }}</h3>
                                @php
                                    $discount = $item->product->discount ?? 0;
                                    $discountedPrice =
                                        $item->product->price - ($item->product->price * $discount) / 100;
                                @endphp
                                @if ($discount > 0)
                                    <div class="wishlist-price" style="margin-bottom: 0.25rem;">
                                        <span
                                            style="text-decoration: line-through; color: #9ca3af; font-size: 1rem; margin-right: 0.5rem;">${{ number_format($item->product->price, 2) }}</span>
                                        <span>${{ number_format($discountedPrice, 2) }}</span>
                                    </div>
                                    <div
                                        style="display: inline-block; background: var(--primary-color); color: white; padding: 0.2rem 0.6rem; border-radius: 999px; font-size: 0.75rem; font-weight: 700; margin-bottom: 0.75rem;">
                                        -{{ rtrim(rtrim(number_format($discount, 2), '0'), '.') }}%
                                    </div>
                                @else
                                    <div class="wishlist-price">${{ number_format($item->product->price, 2) }}</div>
                                @endif
                                @if ($item->product->stock > 0)
                                    <span class="wishlist-stock stock-in">
                                        <i class="fas fa-check-circle"></i> In Stock
                                    </span>
                                @else
                                    <span class="wishlist-stock stock-out">
                                        <i class="fas fa-times-circle"></i> Out of Stock
                                    </span>
                                @endif
                                <div class="wishlist-actions">
                                    <button class="btn-add-cart" onclick="addToCart({{ $item->product->id }})"
                                        {{ $item->product->stock <= 0 ? 'disabled' : '' }}>
                                        <i class="fas fa-shopping-cart"></i> Add to Cart
                                    </button>
                                    <a href="{{ route('products.show', $item->product->id) }}" class="btn-view">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @else
            <div class="empty-wishlist">
                <div class="empty-wishlist-icon">
                    <i class="fas fa-heart-broken"></i>
                </div>
                <h3>Your Wishlist is Empty</h3>
                <p>Start adding your favorite products to your wishlist!</p>
                <a href="{{ route('products') }}" class="btn-browse">
                    <i class="fas fa-shopping-bag me-2"></i>Browse Products
                </a>
            </div>
        @endif
    </div>

    <footer class="footer">
        <div class="container">
            <div class="row mb-4">
                <div class="col-md-4 mb-4">
                    <h5><i class="fas fa-spa"></i> Glow Skincare</h5>
                    <p>Premium skincare products for your beauty needs.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <h5>Quick Links</h5>
                    <ul class="footer-links">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('products') }}">Products</a></li>
                        <li><a href="{{ route('pages.shipping') }}">Shipping Info</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h5>Follow Us</h5>
                    <div class="social-links">
                        <a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" title="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" title="Twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" title="TikTok"><i class="fab fa-tiktok"></i></a>
                        <a href="#" title="Telegram"><i class="fab fa-telegram"></i></a>
                    </div>
                    <div style="margin-top: 1rem;">
                        <p style="margin: 0.5rem 0; font-size: 0.95rem;">
                            <i class="fas fa-phone" style="color: var(--primary-color); margin-right: 0.5rem;"></i>
                            <a href="tel:+85596567890" style="text-decoration: none; color: inherit;">+855 96 567
                                890</a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="footer-divider">
                <p class="text-center mb-0">&copy; 2025 Glow Skincare. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1080;">
        <div id="cart-toast" class="toast align-items-center border-0" role="alert" aria-live="assertive"
            aria-atomic="true" data-bs-delay="2500">
            <div class="d-flex">
                <div id="cart-toast-body" class="toast-body text-white"></div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function showCartToast(message, type = 'success') {
            const toastElement = document.getElementById('cart-toast');
            const toastBody = document.getElementById('cart-toast-body');
            if (!toastElement || !toastBody) return;

            toastBody.textContent = message;
            toastElement.classList.remove('bg-success', 'bg-danger');
            toastElement.classList.add(type === 'success' ? 'bg-success' : 'bg-danger');

            const toast = bootstrap.Toast.getOrCreateInstance(toastElement);
            toast.show();
        }

        function addToCart(productId) {
            fetch('/cart/add', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        product_id: productId,
                        quantity: 1
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const badge = document.getElementById('cart-count-badge');
                        if (badge) {
                            badge.textContent = data.cartCount ?? '';
                            if (data.cartCount && data.cartCount > 0) {
                                badge.style.display = 'inline-block';
                            } else {
                                badge.style.display = 'none';
                            }
                        }
                        showCartToast('Product added to cart!', 'success');
                    } else {
                        showCartToast(data.message || 'Unable to add product to cart.', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showCartToast('Something went wrong. Please try again.', 'error');
                });
        }
    </script>
</body>

</html>
