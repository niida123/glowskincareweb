<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>My Profile - Glow Skincare</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Poppins:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />


    <style>
        /* Navbar Toggler Icon */
        .navbar-toggler-icon {
            filter: invert(1);
        }

        .navbar-toggler:focus,
        .navbar-toggler:active {
            outline: none;
            box-shadow: none;
        }

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

        /* Navbar */
        .navbar {
            background: var(--primary-color);
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
            color: var(--dark-color);
            padding: 1.5rem 0;
            /* reduce from 3rem */
            margin-bottom: 1rem;

        }

        .header-line {
            width: 100%;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--primary-color), transparent);
            margin-top: 12px;
        }

        .profile-card {
            background: white;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            max-width: 600px;
            margin: 0 auto;
        }

        .profile-image-section {
            text-align: center;
            margin-bottom: 2rem;
            padding-bottom: 2rem;
            border-bottom: 1px solid #eee;
        }

        .profile-image {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid var(--primary-color);
            box-shadow: 0 4px 15px rgba(206, 106, 215, 0.2);
        }

        .profile-image-placeholder {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: var(--primary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 3rem;
            border: 4px solid var(--primary-color);
            box-shadow: 0 4px 15px rgba(206, 106, 215, 0.2);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
        }

        .form-control {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            font-size: 1rem;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(206, 106, 215, 0.25);
        }

        .btn-save {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            width: 100%;
        }


        .btn-save:hover {
            filter: brightness(0.92);
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
            color: white;
        }

        .alert {
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }

        .error-message {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
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
            <h1><i class="fas fa-user-circle me-2"></i> My Profile</h1>
            <p class="mb-0">Manage your account information</p>
            <div class="header-line"></div>
        </div>
    </div>

    <!-- Profile Form -->
    <div class="container py-4">
        <div class="profile-card">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Please fix the following errors:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf

                <!-- Profile Image Section -->
                <div class="profile-image-section">
                    <div class="mb-3">
                        @if ($user->profile_image)
                            <img src="/storage/{{ $user->profile_image }}" alt="Profile Image"
                                class="profile-image">
                        @else
                            <div class="profile-image-placeholder mx-auto">
                                <i class="fas fa-user"></i>
                            </div>
                        @endif
                    </div>
                    <p class="text-muted mb-0" style="font-size: 0.9rem;">Current Profile Picture</p>
                </div>

                <div class="form-group">
                    <label for="profile_image" class="form-label">Upload New Profile Picture</label>
                    <input type="file" name="profile_image" id="profile_image"
                        class="form-control @error('profile_image') is-invalid @enderror" accept="image/*"
                        onchange="previewImage(event)">
                    <small class="text-muted d-block mt-2">JPG, PNG, or GIF (Max 2MB)</small>
                    @error('profile_image')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>


                <div class="row">
                    <!-- Full Name -->
                    <div class="col-md-6 form-group">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" name="name" id="name"
                            class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="col-md-6 form-group">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" name="email" id="email"
                            class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email', $user->email) }}" required>
                        @error('email')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="col-md-6 form-group">
                        <label for="password" class="form-label">New Password</label>
                        <input type="password" name="password" id="password"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="Enter new password">
                        @error('password')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="form-control" placeholder="Confirm new password">
                    </div>
                    <!-- Phone -->

                    <div class="col-md-12 form-group">
                        <label class="form-label">Phone Number</label>
                        <input type="text" name="phone" class="form-control" value="{{ $user->phone }}">
                    </div>

                </div>


                <div class="form-group">
                    <label for="address" class="form-label">Address</label>

                    <div class="input-group mb-2">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input type="text" id="address_search" class="form-control"
                            placeholder="Search an address...">
                        <button type="button" class="btn btn-outline-secondary"
                            id="searchAddressBtn">Search</button>
                    </div>

                    <div id="map" style="height: 300px; border-radius: 8px;" class="mb-2"></div>

                    <button type="button" class="btn btn-sm btn-outline-primary mb-3" id="locateMeBtn">
                        <i class="fas fa-location-crosshairs me-1"></i> Use My Location
                    </button>

                    <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror" rows="2"
                        readonly placeholder="Click on the map or search to set your address">{{ old('address', $user->address) }}</textarea>

                    <input type="hidden" name="latitude" id="latitude"
                        value="{{ old('latitude', $user->latitude) }}">
                    <input type="hidden" name="longitude" id="longitude"
                        value="{{ old('longitude', $user->longitude) }}">

                    @error('address')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <button type="submit" class="btn-save">
                            <i class="fas fa-save me-2"></i> Save Changes
                        </button>
                    </div>
                    <div class="col-md-6">
                        <a href="/" class="btn btn-secondary w-100"
                            style="padding: 0.75rem 2rem; border-radius: 8px; font-weight: 600;">
                            <i class="fas fa-arrow-left me-2"></i> Back to Home
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const imageSection = document.querySelector('.profile-image-section');
                    const currentImg = imageSection.querySelector('img');
                    const placeholder = imageSection.querySelector('.profile-image-placeholder');

                    if (currentImg) {
                        currentImg.src = e.target.result;
                    } else if (placeholder) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'profile-image';
                        img.alt = 'Profile Image Preview';
                        imageSection.insertBefore(img, placeholder.nextSibling);
                        placeholder.remove();
                    }
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
    <script>
        const DEFAULT_LAT = {{ $user->latitude ?? 11.5564 }};
        const DEFAULT_LNG = {{ $user->longitude ?? 104.9282 }};
        const HAS_SAVED_LOCATION = {{ $user->latitude && $user->longitude ? 'true' : 'false' }};

        const map = L.map('map').setView([DEFAULT_LAT, DEFAULT_LNG], HAS_SAVED_LOCATION ? 16 : 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        const marker = L.marker([DEFAULT_LAT, DEFAULT_LNG], {
            draggable: true,
            title: 'Drag me to your address'
        }).addTo(map);

        setHiddenLatLng(DEFAULT_LAT, DEFAULT_LNG);

        // Only reverse geocode if there's no saved address yet
        @if (!$user->address)
            reverseGeocode(DEFAULT_LAT, DEFAULT_LNG);
        @endif

        map.on('click', function(e) {
            applyLatLng(e.latlng.lat, e.latlng.lng);
        });

        marker.on('dragend', function() {
            const pos = marker.getLatLng();
            applyLatLng(pos.lat, pos.lng);
        });

        function applyLatLng(lat, lng) {
            marker.setLatLng([lat, lng]);
            map.panTo([lat, lng]);
            setHiddenLatLng(lat, lng);
            reverseGeocode(lat, lng);
        }

        function setHiddenLatLng(lat, lng) {
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;
        }

        async function reverseGeocode(lat, lng) {
            try {
                const res = await fetch(
                `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`);
                const data = await res.json();
                document.getElementById('address').value = data.display_name || `${lat}, ${lng}`;
            } catch (e) {
                document.getElementById('address').value = `${lat}, ${lng}`;
            }
        }

        // Address search
        const searchInput = document.getElementById('address_search');
        const searchBtn = document.getElementById('searchAddressBtn');

        async function searchAddress() {
            const query = searchInput.value.trim();
            if (!query) return;

            try {
                const res = await fetch(
                    `https://nominatim.openstreetmap.org/search?format=json&limit=1&q=${encodeURIComponent(query)}`);
                const data = await res.json();
                if (!data.length) {
                    alert('Address not found. Try a more specific search.');
                    return;
                }
                map.setZoom(16);
                applyLatLng(parseFloat(data[0].lat), parseFloat(data[0].lon));
            } catch (e) {
                alert('Unable to search address right now.');
            }
        }

        searchBtn.addEventListener('click', searchAddress);
        searchInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                searchAddress();
            }
        });

        // Use my location
        document.getElementById('locateMeBtn').addEventListener('click', function() {
            if (!navigator.geolocation) {
                alert('Geolocation is not supported by your browser.');
                return;
            }
            const btn = this;
            const origHTML = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Locating...';

            navigator.geolocation.getCurrentPosition(
                function(pos) {
                    btn.disabled = false;
                    btn.innerHTML = origHTML;
                    map.setZoom(16);
                    applyLatLng(pos.coords.latitude, pos.coords.longitude);
                },
                function() {
                    btn.disabled = false;
                    btn.innerHTML = origHTML;
                    alert(
                        'Unable to get your location. Please allow location access or pick a spot on the map.');
                }, {
                    enableHighAccuracy: true,
                    timeout: 10000,
                    maximumAge: 0
                }
            );
        });
    </script>
</body>

</html>
