<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $product->name }} - Glow Skincare</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #8b5cf6;
            --secondary-color: #e9d5ff;
            --dark-color: #2d1b4e;
            --light-color: #f8f9fa;
            --accent-color: #ec4899;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: var(--dark-color);
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
        }

        /* Navbar */
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

        .product-detail-container {
            padding: 60px 0;
        }

        .product-image-large {
            width: 100%;
            max-height: 500px;
            object-fit: cover;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .product-detail-info {
            padding: 2rem;
        }

        .product-category-tag {
            display: inline-block;
            background: var(--primary-color);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }

        .product-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .product-price-large {
            font-size: 2rem;
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        .stock-status-detail {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.65rem 1rem;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.95rem;
            margin-bottom: 1.5rem;
            border: 1px solid #e7ecf3;
            background: #f8fafc;
            color: #1f2937;
        }

        .stock-status-badge {
            padding: 0.3rem 0.7rem;
            border-radius: 999px;
            font-size: 0.8rem;
            font-weight: 700;
            border: 1px solid transparent;
        }

        .stock-available-detail {
            background: rgba(46, 204, 113, 0.14);
            color: #1e8e46;
            border-color: rgba(46, 204, 113, 0.28);
        }

        .stock-low-detail {
            background: rgba(255, 193, 7, 0.18);
            color: #9a6a00;
            border-color: rgba(255, 193, 7, 0.32);
        }

        .stock-out-detail {
            background: rgba(220, 53, 69, 0.16);
            color: #b02a37;
            border-color: rgba(220, 53, 69, 0.3);
        }

        .quantity-selector {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 2rem;
        }

        .quantity-label {
            font-weight: 600;
            color: var(--dark-color);
            min-width: 90px;
        }

        .quantity-control {
            display: flex;
            align-items: center;
            border: 2px solid #e7ecf3;
            border-radius: 8px;
            width: fit-content;
        }

        .quantity-btn {
            width: 40px;
            height: 40px;
            border: none;
            background: transparent;
            color: var(--primary-color);
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .quantity-btn:hover {
            background: #f8fafc;
        }

        .quantity-input {
            width: 60px;
            height: 40px;
            border: none;
            text-align: center;
            font-weight: 600;
            font-size: 1rem;
            background: transparent;
        }

        .quantity-input:focus {
            outline: none;
        }

        .related-products-section {
            padding: 60px 0;
            border-top: 1px solid #e7ecf3;
            margin-top: 60px;
        }

        .related-product-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 3px 12px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .related-product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.12);
        }

        .related-product-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            background: var(--light-color);
        }

        .related-product-info {
            padding: 1.25rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .related-product-name {
            font-size: 1rem;
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
            min-height: 2.2rem;
        }

        .related-product-price {
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .related-btn-view {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
            color: white;
            border: none;
            padding: 0.6rem 1.2rem;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            cursor: pointer;
        }

        .related-btn-view:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 107, 157, 0.3);
            color: white;
            text-decoration: none;
        }

        .btn-add-cart-large {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
            color: white;
            border: none;
            padding: 1rem 3rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }

        .btn-add-cart-large:disabled {
            opacity: 0.65;
            cursor: not-allowed;
            box-shadow: none;
        }


        .btn-back {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 2rem;
            transition: all 0.3s ease;
        }

        .btn-back:hover {
            color: var(--accent-color);
            text-decoration: none;
            transform: translateX(-5px);
        }

        .footer {
            background: linear-gradient(135deg, rgba(139, 92, 246, 0.95) 0%, rgba(236, 72, 153, 0.95) 100%);
            color: white;
            padding: 3rem 0 1rem;
            margin-top: 4rem;
        }

        .footer h5 {
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
            font-weight: 700;
        }

        .footer a {
            color: rgba(255,255,255,0.85);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer a:hover {
            color: white;
        }

        .footer-links {
            list-style: none;
            padding-left: 0;
        }

        .footer-links li {
            margin-bottom: 0.5rem;
        }

        .footer-divider {
            border-top: 1px solid rgba(255,255,255,0.2);
            margin-top: 2rem;
            padding-top: 2rem;
        }

        .social-links {
            display: flex;
            gap: 1rem;
        }

        .social-links a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .social-links a:hover {
            background: rgba(255,255,255,0.4);
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
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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

    <!-- Product Detail -->
    <div class="product-detail-container">
        <div class="container">
            <a href="{{ route('products') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Back to Products
            </a>
            
            <div class="row">
                <div class="col-lg-6 mb-4">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-image-large">
                    @else
                        <div class="product-image-large" style="background: linear-gradient(135deg, #f0f0f0 0%, #e0e0e0 100%); display: flex; align-items: center; justify-content: center; height: 500px;">
                            <i class="fas fa-image" style="font-size: 5rem; color: #999;"></i>
                        </div>
                    @endif
                </div>
                
                <div class="col-lg-6">
                    <div class="product-detail-info">
                        <span class="product-category-tag">
                            <i class="fas fa-tag"></i> {{ $product->category->name ?? 'Uncategorized' }}
                        </span>
                        <h1 class="product-title">{{ $product->name }}</h1>
                        @php
                            $discount = $product->discount ?? 0;
                            $discountedPrice = $product->price - ($product->price * $discount / 100);
                        @endphp
                        @if($discount > 0)
                            <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
                                <div class="product-price-large" style="margin: 0; text-decoration: line-through; color: #999; font-size: 1.4rem;">${{ number_format($product->price, 2) }}</div>
                                <div class="product-price-large" style="margin: 0;">${{ number_format($discountedPrice, 2) }}</div>
                                <span style="background: linear-gradient(135deg, #8b5cf6 0%, #ec4899 100%); color: white; padding: 0.5rem 1rem; border-radius: 20px; font-size: 0.9rem; font-weight: 700;">-{{ $discount }}%</span>
                            </div>
                        @else
                            <div class="product-price-large">${{ number_format($product->price, 2) }}</div>
                        @endif

                        @php
                            $stock = $product->stock ?? 0;
                            $stockClass = $stock > 10 ? 'stock-available-detail' : ($stock > 0 ? 'stock-low-detail' : 'stock-out-detail');
                            $stockLabel = $stock > 10 ? 'In stock' : ($stock > 0 ? 'Limited stock' : 'Out of stock');
                        @endphp
                        <div class="stock-status-detail">
                            <span><i class="fas fa-box"></i> {{ $stock }} in stock</span>
                            <span class="stock-status-badge {{ $stockClass }}">{{ $stockLabel }}</span>
                        </div>
                        
                        @if($product->description)
                            <div class="product-description mb-4">
                                <h5>Description</h5>
                                <p>{{ $product->description }}</p>
                            </div>
                        @endif

                        <div class="quantity-selector">
                            <label class="quantity-label">Quantity:</label>
                            <div class="quantity-control">
                                <button class="quantity-btn" onclick="decrementQuantity()">−</button>
                                <input type="number" id="productQuantity" class="quantity-input" value="1" min="1" max="{{ $stock }}">
                                <button class="quantity-btn" onclick="incrementQuantity()">+</button>
                            </div>
                        </div>
                        
                        <button class="btn-add-cart-large" onclick="addToCart({{ $product->id }})" {{ $stock <= 0 ? 'disabled' : '' }}>
                            <i class="fas fa-shopping-cart"></i> Add to Cart
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    @if($relatedProducts && $relatedProducts->count() > 0)
    <div class="related-products-section">
        <div class="container">
            <h2 style="margin-bottom: 2.5rem; font-size: 2rem;">You Might Also Like</h2>
            <div class="row">
                @foreach($relatedProducts as $relatedProduct)
                    <div class="col-md-6 col-lg-3 mb-4">
                        <div class="related-product-card">
                            @if($relatedProduct->image)
                                <img src="{{ asset('storage/' . $relatedProduct->image) }}" alt="{{ $relatedProduct->name }}" class="related-product-image">
                            @else
                                <div class="related-product-image" style="background: linear-gradient(135deg, #f0f0f0 0%, #e0e0e0 100%); display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-image" style="font-size: 2.5rem; color: #999;"></i>
                                </div>
                            @endif
                            <div class="related-product-info">
                                <h3 class="related-product-name">{{ $relatedProduct->name }}</h3>
                                @php
                                    $relatedDiscount = $relatedProduct->discount ?? 0;
                                    $relatedDiscountedPrice = $relatedProduct->price - ($relatedProduct->price * $relatedDiscount / 100);
                                @endphp
                                @if($relatedDiscount > 0)
                                    <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1rem;">
                                        <div class="related-product-price" style="margin: 0; text-decoration: line-through; color: #999; font-size: 0.9rem;">${{ number_format($relatedProduct->price, 2) }}</div>
                                        <div class="related-product-price" style="margin: 0;">${{ number_format($relatedDiscountedPrice, 2) }}</div>
                                        <span style="background: linear-gradient(135deg, #8b5cf6 0%, #ec4899 100%); color: white; padding: 0.2rem 0.5rem; border-radius: 12px; font-size: 0.7rem; font-weight: 700;">-{{ $relatedDiscount }}%</span>
                                    </div>
                                @else
                                    <div class="related-product-price">${{ number_format($relatedProduct->price, 2) }}</div>
                                @endif
                                <a href="{{ route('products.show', $relatedProduct->id) }}" class="related-btn-view">
                                    <i class="fas fa-arrow-right"></i> View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <!-- Footer -->
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
                        <li><a href="{{ route('categories') }}">Categories</a></li>
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
                            <i class="fas fa-phone" style="color: #8b5cf6; margin-right: 0.5rem;"></i>
                            <a href="tel:+85596567890" style="text-decoration: none; color: inherit;">+855 96 567 890</a>
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
        <div id="cart-toast" class="toast align-items-center border-0" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="2500">
            <div class="d-flex">
                <div id="cart-toast-body" class="toast-body text-white"></div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
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

        function incrementQuantity() {
            const input = document.getElementById('productQuantity');
            const max = parseInt(input.max);
            if (parseInt(input.value) < max) {
                input.value = parseInt(input.value) + 1;
            }
        }

        function decrementQuantity() {
            const input = document.getElementById('productQuantity');
            if (parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
            }
        }

        function addToCart(productId) {
            const quantity = parseInt(document.getElementById('productQuantity').value) || 1;
            fetch(`/cart/add`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ product_id: productId, quantity: quantity })
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
                    document.getElementById('productQuantity').value = 1;
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
