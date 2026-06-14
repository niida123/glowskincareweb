<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderViewController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\OrderItemController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\InvoiceController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home.page');
Route::get('/categories', [HomeController::class, 'categories'])->name('categories');
Route::get('/products', [HomeController::class, 'products'])->name('products');
Route::get('/products/{id}', [HomeController::class, 'showProduct'])->name('products.show');

// User Orders
Route::middleware('auth')->group(function () {
    Route::get('/my-orders', [OrderViewController::class, 'myOrders'])->name('my-orders');
    Route::get('/my-orders', [OrderViewController::class, 'myOrders'])->name('orders.index');
    Route::get('/orders/{order}', [OrderViewController::class, 'show'])->name('orders.show');
    Route::put('/orders/{order}/cancel', [OrderViewController::class, 'cancel'])->name('orders.cancel');
    Route::get('/order-item-details', [OrderViewController::class, 'itemDetails'])->name('order-item.details');
    Route::post('/paypal/create-order', [PayPalController::class, 'createOrder'])->name('paypal.create-order');
    Route::post('/paypal/capture-order/{paypalOrderId}', [PayPalController::class, 'captureOrder'])->name('paypal.capture-order');
    // Invoice (HTML/print) for owner
    Route::get('/orders/{order}/invoice', [InvoiceController::class, 'show'])->name('orders.invoice');
    // Create a signed share link
    Route::post('/orders/{order}/invoice/share', [InvoiceController::class, 'createShareLink'])->name('orders.invoice.share');
});

// User Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// Shopping Cart & Checkout
Route::get('/cart', [CartController::class, 'view'])->name('cart.view');
Route::get('/cart', [CartController::class, 'view'])->name('cart.index');
Route::match(['get', 'post'], '/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

// Wishlist
Route::middleware('auth')->group(function () {
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::match(['get', 'post'], '/wishlist/toggle', [WishlistController::class, 'toggle'])->name('wishlist.toggle');
    Route::post('/wishlist/remove', [WishlistController::class, 'remove'])->name('wishlist.remove');
});

Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/checkout/success/{order}', [CheckoutController::class, 'success'])->name('orders.success');
});

// Static Pages
Route::view('/shipping', 'pages.shipping')->name('shipping');
Route::view('/shipping', 'pages.shipping')->name('pages.shipping');

Route::middleware(['auth','admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    
    // Products AJAX CRUD
    Route::get('/admin/products', [ProductController::class, 'index'])->name('admin.products.index');
    Route::get('/admin/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::get('/admin/products/list', [ProductController::class, 'list'])->name('admin.products.list');
    Route::post('/admin/products', [ProductController::class, 'store'])->name('admin.products.store');
    Route::put('/admin/products/{product}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/admin/products/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
    Route::get('/admin/categories/list', [CategoryController::class, 'categories'])->name('admin.categories.list');

    // Users & Roles (Super Admin only)
    Route::middleware('superadmin')->group(function () {
        Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
        Route::put('/admin/users/{user}/role', [UserController::class, 'updateRole'])->name('admin.users.updateRole');
        Route::post('/admin/users', [UserController::class, 'store'])->name('admin.users.store');
        Route::put('/admin/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
        Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    });

    // Categories AJAX CRUD
    Route::get('/admin/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('/admin/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
    Route::get('/admin/categories/list-all', [CategoryController::class, 'list'])->name('admin.categories.listAll');
    Route::post('/admin/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::put('/admin/categories/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/admin/categories/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');

    // Orders AJAX CRUD
    Route::get('/admin/orders', [OrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/admin/orders/list', [OrderController::class, 'list'])->name('admin.orders.list');
    Route::get('/admin/orders/{order}', [OrderController::class, 'show'])->name('admin.orders.show');
    Route::post('/admin/orders', [OrderController::class, 'store'])->name('admin.orders.store');
    Route::put('/admin/orders/{order}', [OrderController::class, 'update'])->name('admin.orders.update');
    Route::delete('/admin/orders/{order}', [OrderController::class, 'destroy'])->name('admin.orders.destroy');

    // Order Items AJAX CRUD
    Route::post('/admin/order-items', [OrderItemController::class, 'store'])->name('admin.order-items.store');
    Route::put('/admin/order-items/{item}', [OrderItemController::class, 'update'])->name('admin.order-items.update');
    Route::delete('/admin/order-items/{item}', [OrderItemController::class, 'destroy'])->name('admin.order-items.destroy');

    // Settings - Google Maps
    Route::get('/admin/settings/google-maps', [SettingsController::class, 'maps'])->name('admin.settings.maps');
    Route::post('/admin/settings/google-maps', [SettingsController::class, 'saveMaps'])->name('admin.settings.maps.save');
});

// Public signed route to view shared invoice (no auth, signature required)
Route::middleware('signed')->group(function () {
    Route::get('/invoice/shared/{order}', [InvoiceController::class, 'publicShow'])->name('invoice.public');
});
