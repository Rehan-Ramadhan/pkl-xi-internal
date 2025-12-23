<?php

// ========================================
// FILE: routes/web.php
// FUNGSI: Mendefinisikan semua URL route aplikasi
// ========================================

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// ========================================
// CONTROLLERS
// ========================================

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;

use App\Http\Controllers\Auth\GoogleController;

// ================================================
// HALAMAN PUBLIK (Tanpa Login)
// ================================================

// Homepage
Route::get('/', [HomeController::class, 'index'])->name('home');

// Katalog Produk
Route::get('/products', [CatalogController::class, 'index'])->name('catalog.index');
Route::get('/products/{slug}', [CatalogController::class, 'show'])->name('catalog.show');

// Halaman statis
Route::get('/tentang', function () {
    return view('tentang');
});

Route::get('/sapa/{nama}', function ($nama) {
    return "Halo, $nama! Selamat datang di Toko Online kami.";
});

Route::get('/kategori/{nama}', function ($nama = 'Semua') {
    return "Menampilkan kategori: $nama";
});

Route::get('/produk/{id}', function ($id) {
    return "Detail produk #$id";
})->name('produk.detail');

// ================================================
// AUTH ROUTES (Laravel UI)
// ================================================

Auth::routes();

// ================================================
// GOOGLE OAUTH ROUTES
// ================================================

Route::controller(GoogleController::class)->group(function () {

    // Redirect ke Google
    Route::get('/auth/google', 'redirect')->name('auth.google');

    // Callback dari Google
    Route::get('/auth/google/callback', 'callback')->name('auth.google.callback');
});

// ================================================
// HALAMAN CUSTOMER (Harus Login)
// ================================================

Route::middleware('auth')->group(function () {

    // Home setelah login
    Route::get('/home', [HomeController::class, 'index'])->name('home.user');

    // Keranjang
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/{item}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{item}', [CartController::class, 'remove'])->name('cart.remove');

    // Wishlist
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/toggle/{product}', [WishlistController::class, 'toggle'])->name('wishlist.toggle');

    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

    // Pesanan
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::delete('/profile/google/unlnink', [ProfileController::class, 'unlinkGoogle'])->name('profile.google.unlink');
    Route::patch('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar.update');

    // Tambahan profile
    Route::delete('/profile/avatar', [ProfileController::class, 'deleteAvatar'])->name('profile.avatar.destroy');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
});

// ================================================
// HALAMAN ADMIN (Login + Admin)
// ================================================

        Route::middleware(['auth', 'admin'])
            ->prefix('admin')
            ->name('admin.')
            ->group(function () {

        // Admin Dashboard
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        // nama route: admin.dashboard
        // url: /admin/dashboard

        // Produk
        Route::resource('products', AdminProductController::class);

        // Kategori
        Route::resource('categories', AdminCategoryController::class);

        // Pesanan
        Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
        Route::patch('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Kategori
    Route::resource('categories', CategoryController::class)->except(['show']); // Kategori biasanya tidak butuh show detail page

    // Produk
    Route::resource('products', ProductController::class);

    // Route tambahan untuk AJAX Image Handling (jika diperlukan)
    // ...
});

