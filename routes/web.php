<?php

// ========================================
// FILE: routes/web.php
// FUNGSI: Mendefinisikan semua URL route aplikasi
// ========================================

use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MidtransNotificationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// ================================================
// HALAMAN PUBLIK (Tanpa Login)
// ================================================

// Homepage - Menampilkan Banner & Produk Unggulan
Route::get('/', [HomeController::class, 'index'])->name('home');

// Katalog Produk (Search, Filter, Kategori)
Route::get('/products', [CatalogController::class, 'index'])->name('catalog.index');
Route::get('/products/{slug}', [CatalogController::class, 'show'])->name('catalog.show');

// Halaman Statis & Informasi
Route::get('/tentang', function () {
    return view('tentang');
})->name('about');

// Route Testing (Bisa dihapus jika sudah produksi)
Route::get('/sapa/{nama}', function ($nama) {
    return "Halo, $nama! Selamat datang di Toko Online kami.";
});

// ================================================
// AUTH ROUTES (Laravel UI)
// ================================================

Auth::routes();

// Batasi 5 request per menit untuk keamanan login
Route::post('/login', [LoginController::class, 'login'])->middleware('throttle:5,1');

// ================================================
// GOOGLE OAUTH ROUTES
// ================================================

Route::controller(GoogleController::class)->group(function () {
    // Redirect ke Google
    Route::get('/auth/google', 'redirect')->name('auth.google');
    // Callback dari Google
    Route::get('/auth/google/callback', 'callback')->name('auth.google.callback');
});

// ============================================================
// MIDTRANS WEBHOOK
// Route ini HARUS public (tanpa auth middleware)
// Karena diakses oleh SERVER Midtrans, bukan browser user
// ============================================================
Route::post('midtrans/notification', [MidtransNotificationController::class, 'handle'])
    ->name('midtrans.notification');

// ================================================
// HALAMAN CUSTOMER (Harus Login)
// ================================================

Route::middleware('auth')->group(function () {

    // Home setelah login (biasanya redirect ke sini)
    Route::get('/home', [HomeController::class, 'index'])->name('home.user');

    // Keranjang Belanja
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/{item}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{item}', [CartController::class, 'remove'])->name('cart.remove');

    // Wishlist (Daftar Keinginan)
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/toggle/{product}', [WishlistController::class, 'toggle'])->name('wishlist.toggle');

    // Checkout & Pembayaran
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

    // Pesanan User
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');

    // Payment Gateway Interaction
    Route::get('/orders/{order}/pay', [PaymentController::class, 'show'])->name('orders.pay');
    Route::get('/orders/{order}/success', [PaymentController::class, 'success'])->name('orders.success');
    Route::get('/orders/{order}/pending', [PaymentController::class, 'pending'])->name('orders.pending');

    // Manajemen Profile & Avatar
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::delete('/profile/google/unlink', [ProfileController::class, 'unlinkGoogle'])->name('profile.google.unlink');
    Route::patch('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar.update');
    Route::delete('/profile/avatar', [ProfileController::class, 'deleteAvatar'])->name('profile.avatar.destroy');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
});

// ================================================
// HALAMAN ADMIN (Login + Middleware Admin)
// ================================================

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Admin Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Manajemen Produk (CRUD)
        Route::resource('products', AdminProductController::class);

        // Manajemen Kategori (CRUD)
        Route::resource('categories', AdminCategoryController::class)->except(['show']);

        // Manajemen Pesanan (Admin Side)
        Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
        Route::patch('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');

        // Manajemen Pengguna
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

        // Laporan Penjualan
        Route::get('/reports/sales', [ReportController::class, 'sales'])->name('reports.sales');
        Route::get('reports/export-sales', [ReportController::class, 'exportSales'])->name('reports.export-sales');
    });
