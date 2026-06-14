<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipping & Delivery - Glow Skincare</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #8b5cf6;
            --accent-color: #ec4899;
            --dark-color: #2d1b4e;
            --light-color: #f8f9fa;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: var(--dark-color);
            background: var(--light-color);
        }

        h1, h2, h3 { font-family: 'Playfair Display', serif; }
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

        /* Header */
        .shipping-header {
            color: var(--dark-color);
            padding: 50px 0;
            text-align: center;
            margin-bottom: 50px;
        }

        .shipping-header h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .shipping-header p {
            font-size: 1.1rem;
            opacity: 0.95;
        }
        .shipping-line {
        width: 100%;
        height: 1px;
        background: linear-gradient(90deg, transparent, var(--primary-color), transparent);
        margin-top: 12px;
        }

        /* Shipping Options Cards */
        .shipping-option-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 3px 15px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            border-left: 5px solid var(--primary-color);
        }

        .shipping-option-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.12);
        }

        .shipping-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin-bottom: 15px;
        }

        .shipping-option-card h3 {
            font-size: 1.3rem;
            margin-bottom: 10px;
            color: var(--dark-color);
        }

        .shipping-time {
            background: #f0f0f0;
            display: inline-block;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 15px;
        }

        .shipping-price {
            font-size: 1.5rem;
            color: var(--primary-color);
            font-weight: 700;
            margin-top: 15px;
        }

        .shipping-description {
            color: #666;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        /* Info Boxes */
        .info-box {
            background: white;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .info-box h3 {
            font-size: 1.2rem;
            margin-bottom: 15px;
            color: var(--primary-color);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .info-box .icon {
            width: 45px;
            height: 45px;
            background: rgba(139, 92, 246, 0.1);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-color);
            font-size: 1.3rem;
        }

        .info-item {
            padding: 12px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .info-item-title {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 5px;
        }

        .info-item-desc {
            color: #666;
            font-size: 0.9rem;
        }

        .section-title {
            font-size: 2rem;
            margin-bottom: 30px;
            color: var(--dark-color);
            font-weight: 700;
        }

        .back-link {
            color: var(--primary-color);
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 30px;
            transition: all 0.3s ease;
        }

        .back-link:hover {
            gap: 12px;
            color: var(--accent-color);
        }

        .faq-item {
            background: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 15px;
            border-left: 4px solid var(--primary-color);
        }

        .faq-question {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 8px;
        }

        .faq-answer {
            color: #666;
            font-size: 0.9rem;
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

    <!-- Header -->
    <div class="shipping-header">
        <div class="container">
            <h1><i class="fas fa-truck-fast me-2"></i>Shipping & Delivery</h1>
            <p>We deliver beauty to your doorstep, fast and safe</p>
            <div class="shipping-line"></div>
        </div>
    </div>

    <main class="py-5">
        <div class="container">
            <a href="/" class="back-link"><i class="fas fa-arrow-left"></i> Back to Home</a>

            <!-- Shipping Options -->
            <h2 class="section-title">Shipping Options</h2>
            <div class="row mb-5">
                <div class="col-lg-4 mb-4">
                    <div class="shipping-option-card">
                        <div class="shipping-icon">
                            <i class="fas fa-box"></i>
                        </div>
                        <h3>Standard Shipping</h3>
                        <div class="shipping-time">📦 3-5 Business Days</div>
                        <p class="shipping-description">Perfect for regular orders. Your products arrive safely in 3 to 5 business days.</p>
                        <div class="shipping-price">From $4.99</div>
                    </div>
                </div>

                <div class="col-lg-4 mb-4">
                    <div class="shipping-option-card" style="border-left-color: var(--accent-color);">
                        <div class="shipping-icon" style="background: linear-gradient(135deg, var(--accent-color) 0%, var(--primary-color) 100%);">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <h3>Express Shipping</h3>
                        <div class="shipping-time">⚡ 1-2 Business Days</div>
                        <p class="shipping-description">Get your favorite products faster! Delivered within 1 to 2 business days.</p>
                        <div class="shipping-price">From $9.99</div>
                    </div>
                </div>

                <div class="col-lg-4 mb-4">
                    <div class="shipping-option-card" style="border-left-color: #10b981;">
                        <div class="shipping-icon" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                            <i class="fas fa-rocket"></i>
                        </div>
                        <h3>Same-Day Delivery</h3>
                        <div class="shipping-time">🚀 Order by 1 PM</div>
                        <p class="shipping-description">Get it today! Order before 1 PM and receive your order by 9 PM (selected areas only).</p>
                        <div class="shipping-price">From $14.99</div>
                    </div>
                </div>
            </div>

            <div class="info-box" style="background: #fef3c7; border-left: 4px solid #f59e0b;">
                <p style="margin: 0; color: #92400e;"><strong><i class="fas fa-info-circle me-2"></i>Note:</strong> Delivery fees and timelines may vary by location and cart weight.</p>
            </div>

            <!-- Additional Services -->
            <h2 class="section-title mt-5">Additional Services</h2>
            <div class="row mb-5">
                <div class="col-lg-6">
                    <div class="info-box">
                        <h3><div class="icon"><i class="fas fa-globe"></i></div> International Shipping</h3>
                        <div class="info-item">
                            <div class="info-item-title">⏱️ Delivery Time</div>
                            <div class="info-item-desc">7-15 business days depending on your country</div>
                        </div>
                        <div class="info-item">
                            <div class="info-item-title">🛂 Customs & Taxes</div>
                            <div class="info-item-desc">Duties and taxes may apply - paid by the recipient</div>
                        </div>
                        <div class="info-item">
                            <div class="info-item-title">📍 Tracking</div>
                            <div class="info-item-desc">Full tracking provided for all international orders</div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="info-box">
                        <h3><div class="icon"><i class="fas fa-undo"></i></div> Returns & Exchanges</h3>
                        <div class="info-item">
                            <div class="info-item-title">⏳ Return Window</div>
                            <div class="info-item-desc">14 days from delivery date</div>
                        </div>
                        <div class="info-item">
                            <div class="info-item-title">📦 Condition</div>
                            <div class="info-item-desc">Items must be unopened and in original packaging</div>
                        </div>
                        <div class="info-item">
                            <div class="info-item-title">💰 Refund Time</div>
                            <div class="info-item-desc">Processed within 5-7 days after inspection</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FAQs -->
            <h2 class="section-title">Frequently Asked Questions</h2>
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="faq-item">
                        <div class="faq-question">❓ Do you offer free shipping?</div>
                        <div class="faq-answer">Yes! Orders over $50 get free standard shipping within the US.</div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question">📦 Can I track my order?</div>
                        <div class="faq-answer">Absolutely! You'll receive a tracking number via email and SMS as soon as your order ships.</div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question">🛵 Do you deliver on weekends?</div>
                        <div class="faq-answer">Express and same-day deliveries may include Saturday delivery in select areas.</div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question">🔄 Can I change my delivery address?</div>
                        <div class="faq-answer">Contact us within 24 hours of ordering. Changes after that may not be possible.</div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question">❄️ How are products packaged?</div>
                        <div class="faq-answer">All items are carefully packaged with protective materials to ensure they arrive in perfect condition.</div>
                    </div>
                </div>
            </div>

            <!-- Support -->
            <div class="row mt-5">
                <div class="col-lg-8 mx-auto">
                    <div class="info-box" style="background: linear-gradient(135deg, rgba(139, 92, 246, 0.1) 0%, rgba(236, 72, 153, 0.1) 100%); border: 2px solid var(--primary-color); text-align: center;">
                        <h3 style="justify-content: center;"><div class="icon"><i class="fas fa-headset"></i></div> Need Help?</h3>
                        <p style="color: #666; margin-bottom: 20px;">Have questions about shipping? Our support team is here to help!</p>
                        <a href="mailto:support@glowskincare.com" class="btn btn-primary" style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%); border: none; padding: 10px 25px; border-radius: 25px; font-weight: 600;">
                            <i class="fas fa-envelope me-2"></i>Contact Support
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>