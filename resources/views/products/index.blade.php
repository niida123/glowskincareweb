<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Products - Glow Skincare</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    
<style>
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
    }

    h1, h2, h3, h4, h5, h6 {
        font-family: 'Playfair Display', serif;
        color: var(--dark);
    }

    /* Navbar */
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
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
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
    .navbar-toggler-icon {
        filter: invert(1);
    }

    .navbar-toggler:focus,
    .navbar-toggler:active {
        outline: none;
        box-shadow: none;
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

    /* Page Header */
    .page-header {
        background: white;
        padding: 40px 0;
        color: var(--dark);
        text-align: center;
        margin-bottom: 40px;
        border-bottom: 3px solid var(--primary);
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    .page-header h1 {
        font-size: 2.2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        color: var(--primary);
    }

    .page-header p {
        font-size: 1rem;
        color: #666;
        font-weight: 500;
    }

    /* Sidebar */
    .filters-sidebar {
        background: var(--secondary);
        padding: 1.5rem;
        border-radius: 10px;
        height: fit-content;
        position: sticky;
        top: 80px;
    }

    .filters-sidebar h5 {
        font-weight: 700;
        margin-bottom: 1.5rem;
        color: var(--dark);
    }

    .filter-group {
        margin-bottom: 2rem;
    }

    .filter-group label {
        display: flex;
        align-items: center;
        margin-bottom: 0.75rem;
        cursor: pointer;
        transition: color 0.3s ease;
    }

    .filter-group label:hover {
        color: var(--primary);
    }

    .filter-group input[type="radio"] {
        margin-right: 0.75rem;
        cursor: pointer;
        accent-color: var(--primary);
    }

    /* Product Card */
    .product-card {
        background: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        position: relative;
        border: 1px solid var(--border);
    }

    .product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }

    .product-image {
        width: 100%;
        height: 250px;
        object-fit: cover;
        background: var(--light);
        transition: transform 0.4s ease;
    }

    .product-card:hover .product-image {
        transform: scale(1.04);
    }

    .product-info {
        padding: 1.25rem 1.25rem 1.5rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .product-category {
        color: var(--primary);
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        letter-spacing: 0.05em;
    }

    .product-name {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 0.5rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        line-height: 1.4;
        min-height: 3rem;
    }

    /* Price (no discount case) */
    .product-price {
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--primary);
        margin-bottom: 1rem;
    }

    /* Price Row (discount case) */
    .price-row {
        display: flex;
        align-items: baseline;
        gap: 0.5rem;
        flex-wrap: wrap;
        margin-bottom: 0.5rem;
    }

    .price-old {
        text-decoration: line-through;
        color: #aaa;
        font-size: 0.85rem;
    }

    .price-new {
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--primary);
    }

    .discount-badge {
        background: var(--secondary);
        color: var(--text);
        border: 1px solid var(--border);
        font-size: 0.7rem;
        font-weight: 700;
        padding: 0.15rem 0.5rem;
        border-radius: 12px;
    }

    /* Stock pill */
    .stock-pill {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        background: var(--secondary);
        font-size: 0.85rem;
    }

    .stock-number {
        color: #6c757d;
    }

    .stock-status {
        font-weight: 600;
    }

    /* Buttons */
    .product-buttons {
        display: flex;
        gap: 0.4rem;
        margin-top: auto;
    }

    .btn-add-cart {
        flex: 1;
        background: var(--primary);
        color: white;
        border: none;
        padding: 0.5rem 0.6rem;
        font-size: 0.85rem;
        border-radius: 6px;
        font-weight: 600;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .btn-add-cart:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.15);
        color: white;
        filter: brightness(0.9);
    }

    .btn-view {
        flex: 1;
        background: white;
        color: var(--primary);
        border: 1.5px solid var(--primary);
        padding: 0.5rem 0.6rem;
        font-size: 0.85rem;
        border-radius: 6px;
        font-weight: 600;
        transition: all 0.3s ease;
        cursor: pointer;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-view:hover {
        background: var(--primary);
        color: white;
        border-color: var(--primary);
        text-decoration: none;
    }

    .btn-add-cart i,
    .btn-view i {
        font-size: 0.85em;
    }

    /* Wishlist */
    .wishlist-btn {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .wishlist-btn:hover {
        transform: scale(1.1);
    }

    /* Pagination */
    .pagination-wrapper {
        display: flex;
        justify-content: center;
        margin-top: 3rem;
    }

    .pagination {
        gap: 0.5rem;
    }

    .pagination .page-link {
        color: var(--primary);
        border-color: var(--primary);
        border-radius: 6px;
    }

    .pagination .page-item.active .page-link {
        background: var(--primary);
        border-color: var(--primary);
        color: white;
    }

    .pagination .page-link:hover {
        background: var(--primary);
        border-color: var(--primary);
        color: white;
    }

    /* Footer */
    .footer {
        background: var(--secondary);
        color: var(--text);
        padding: 1.75rem 0 0.75rem;
        margin-top: 2rem;
        border-top: 1px solid var(--border);
    }

    .footer h5 {
        font-size: 0.95rem;
        margin-bottom: 0.85rem;
        font-weight: 700;
        color: var(--dark);
    }

    .footer a {
        color: var(--text);
        text-decoration: none;
        transition: color 0.3s ease;
        font-size: 0.9rem;
    }

    .footer a:hover {
        color: var(--primary);
    }

    .footer-links {
        list-style: none;
        padding-left: 0;
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
        background: var(--primary);
        color: white;
        border-color: var(--primary);
        transform: translateY(-3px);
    }

    /* ===== Mobile ===== */
    @media (max-width: 576px) {
        #products-container .col-12 {
            padding-left: 6px;
            padding-right: 6px;
        }

        .product-card {
            border-radius: 14px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.06);
        }

        .product-image {
            height: 160px;
        }

        .product-info {
            padding: 0.85rem 0.9rem;
        }

        .product-category {
            font-size: 0.65rem;
            margin-bottom: 0.25rem;
        }

        .product-name {
            font-size: 0.85rem;
            min-height: 2rem;
            margin-bottom: 0.25rem;
        }

        .product-price {
            font-size: 1rem;
        }

        .price-new {
            font-size: 1rem;
        }

        .price-old {
            font-size: 0.75rem;
        }

        .discount-badge {
            font-size: 0.62rem;
            padding: 0.1rem 0.4rem;
        }

        .stock-pill {
            font-size: 0.7rem !important;
            padding: 0.2rem 0.5rem !important;
        }

        .stock-status {
            display: none;
        }

        .product-buttons {
            flex-direction: column;
            gap: 0.4rem;
        }

        .btn-add-cart,
        .btn-view {
            font-size: 0.7rem;
            padding: 0.45rem;
        }

        .wishlist-btn {
            width: 34px !important;
            height: 34px !important;
            top: 8px !important;
            right: 8px !important;
        }

        .wishlist-btn i {
            font-size: 1rem !important;
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
            <h1>Products</h1>
            <p>Browse our complete skincare collection</p>
        </div>
    </div>

    <!-- Main Content -->
    <main class="container mb-5">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-3 mb-4">
                <div class="filters-sidebar">
                    <h5><i class="fas fa-filter"></i> Filter by Category</h5>
                    <form method="GET" action="{{ route('products') }}">
                        <div class="filter-group">
                            <label>
                                <input type="radio" name="category" value="" @if(!request('category')) checked @endif onchange="this.form.submit()">
                                <span>All Products</span>
                            </label>
                        </div>
                        @foreach($categories as $cat)
                            <div class="filter-group">
                                <label>
                                    <input type="radio" name="category" value="{{ $cat->id }}" @if(request('category') == $cat->id) checked @endif onchange="this.form.submit()">
                                    <span>{{ $cat->name }}</span>
                                </label>
                            </div>
                        @endforeach
                    </form>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="col-lg-9">
                <div class="row" id="products-container">
                    @forelse($products as $product)
                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                            <div class="product-card" style="position: relative;">
                                @auth
                                    @php
                                        $inWishlist = in_array($product->id, $wishlistIds ?? []);
                                    @endphp
                                    <button class="wishlist-btn" onclick="toggleWishlist({{ $product->id }}, this)" style="position: absolute; top: 10px; right: 10px; background: {{ $inWishlist ? '#fce7f3' : 'white' }}; border: none; width: 40px; height: 40px; border-radius: 50%; box-shadow: 0 2px 8px rgba(0,0,0,0.15); cursor: pointer; z-index: 10; transition: all 0.3s;">
                                        <i class="{{ $inWishlist ? 'fas' : 'far' }} fa-heart" style="color: #ec4899; font-size: 1.2rem;"></i>
                                    </button>
                                @endauth
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-image">
                                @else
                                    <div class="product-image" style="background: linear-gradient(135deg, #f0f0f0 0%, #e0e0e0 100%); display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-image" style="font-size: 3rem; color: #999;"></i>
                                    </div>
                                @endif
                                <div class="product-info">
                                    <p class="product-category">{{ $product->category->name ?? 'Uncategorized' }}</p>
                                    <h3 class="product-name">{{ $product->name }}</h3>
                                    @php
                                        $discount = $product->discount ?? 0;
                                        $discountedPrice = $product->price - ($product->price * $discount / 100);
                                    @endphp
                                    <div class="product-price-section" style="margin-bottom: 1rem;">
                                        @if($discount > 0)
                                            <div class="price-row">
                                                <span class="price-old">${{ number_format($product->price, 2) }}</span>
                                                <span class="price-new">${{ number_format($discountedPrice, 2) }}</span>
                                                <span class="discount-badge">-{{ $discount }}%</span>
                                            </div>
                                        @else
                                            <p class="product-price" style="margin: 0;">${{ number_format($product->price, 2) }}</p>
                                        @endif
                                    </div>
                                    @php
                                        $stock = $product->stock ?? 0;
                                        $stockClass = $stock > 10 ? 'stock-available' : ($stock > 0 ? 'stock-low' : 'stock-out');
                                        $stockLabel = $stock > 10 ? 'In stock' : ($stock > 0 ? 'Limited stock' : 'Out of stock');
                                    @endphp
                                    <div class="stock-row" style="margin: 0.5rem 0;">
                                        <span class="stock-pill" style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.25rem 0.75rem; border-radius: 20px; background: #f8f9fa; font-size: 0.85rem;">
                                            <span class="stock-number" style="color: #6c757d;">
                                                <i class="fas fa-box"></i> {{ $stock }} in stock
                                            </span>
                                            <span class="stock-status {{ $stockClass }}" style="font-weight: 600; {{ $stock > 10 ? 'color: #28a745;' : ($stock > 0 ? 'color: #ffc107;' : 'color: #dc3545;') }}">{{ $stockLabel }}</span>
                                        </span>
                                    </div>
                                    <div class="product-buttons">
                                        <button class="btn-add-cart" onclick="addToCart({{ $product->id }})" {{ $stock <= 0 ? 'disabled' : '' }}>
                                            <i class="fas fa-shopping-cart"></i> Add to Cart
                                        </button>
                                        <a href="{{ route('products.show', $product->id) }}" class="btn-view">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-info text-center" role="alert">
                                <i class="fas fa-info-circle"></i> No products found in this category.
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if($products->hasPages())
                    <div class="pagination-wrapper">
                        {{ $products->links('pagination::bootstrap-4') }}
                    </div>
                @endif
            </div>
        </div>
    </main>

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
                            <i class="fas fa-phone" style="color: var(--primary); margin-right: 0.5rem;"></i>
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

        function addToCart(productId) {
            fetch(`/cart/add`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ product_id: productId, quantity: 1 })
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
                    showCartToast('Unable to add product to cart.', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showCartToast('Something went wrong. Please try again.', 'error');
            });
        }

        function toggleWishlist(productId, button) {
            fetch('/wishlist/toggle', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ product_id: productId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const icon = button.querySelector('i');
                    if (data.inWishlist) {
                        icon.classList.remove('far');
                        icon.classList.add('fas');
                        button.style.background = '#fce7f3';
                    } else {
                        icon.classList.remove('fas');
                        icon.classList.add('far');
                        button.style.background = 'white';
                    }
                }
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
</body>
</html>
