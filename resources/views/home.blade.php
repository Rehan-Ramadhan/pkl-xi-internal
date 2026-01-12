{{-- ================================================
FUNGSI: Halaman utama website
================================================ --}}

@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
{{-- Hero Section --}}
<section class="bg-primary text-white py-4 hero-comic-panel m-0">
    <div class="container py-lg-4">
        <div class="row align-items-center">
            <div class="col-lg-6 text-center text-lg-start">
                <span class="badge bg-warning text-dark mb-3 comic-badge px-3 py-2">
                    #1 TOKO KOMIK TERPERCAYA
                </span>
                <h1 class="display-4 fw-bold mb-3 comic-title">
                    Markas Komik <br> Terlengkap & Original
                </h1>
                <p class="lead mb-4 fw-medium" style="opacity: 0.9; font-size: 1rem;">
                    Lengkapi koleksi <span class="text-warning fw-bold">Manhwa, Manga</span>. 
                    Aman, cepat, dan pastinya berkelas di SiKoMart.
                </p>
                <a href="{{ route('catalog.index') }}" class="btn btn-light btn-lg btn-comic px-5">
                    <i class="bi bi-bag-fill me-2"></i>Mulai Belanja
                </a>
            </div>

            <div class="col-lg-6 d-none d-lg-block">
                <div class="promo-stack">
                    {{-- Gambar belakang --}}
                    <a href="{{ route('catalog.index', ['on_sale' => 1]) }}">
                        <img src="{{ asset('images/promo2.jpg') }}" class="img-fluid img-back bg-white p-1">
                    </a>
                    {{-- Gambar depan --}}
                    <a href="{{ route('catalog.index', ['on_sale' => 1]) }}">
                        <img src="{{ asset('images/promo.png') }}" class="img-fluid img-front bg-white p-1">
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

    {{-- Kategori Populer--}}
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-4 fw-bold">Kategori Populer</h2>
            <div class="row g-4">
                @foreach($categories as $category)
                    <div class="col-6 col-md-4 col-lg-2">
                        <a href="{{ route('catalog.index', ['category' => $category->slug]) }}" class="text-decoration-none">
                            <div class="card border-0 shadow-sm text-center h-100 clickable-card">
                                <div class="card-body p-3">
                                    <div class="mb-3">
                                        <img src="{{ $category->image_url }}" alt="{{ $category->name }}"
                                            class="rounded-circle shadow-sm" width="80" height="80"
                                            style="object-fit: cover; border: 3px solid #f8f9fa;">
                                    </div>
                                    <h6 class="card-title mb-1 text-dark fw-bold">{{ $category->name }}</h6>
                                    <small class="text-muted d-block">{{ $category->products_count }} produk</small>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Produk Unggulan --}}
    <section class="py-5 bg-light">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0">Produk Unggulan</h2>
                <a href="{{ route('catalog.index') }}" class="btn btn-outline-primary">
                    Lihat Semua <i class="bi bi-arrow-right"></i>
                </a>
            </div>
            <div class="row g-4">
                @foreach($featuredProducts as $product)
                    <div class="col-6 col-md-4 col-lg-3">
                        @include('partials.product-card', ['product' => $product])
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Promo Banner --}}
    <section class="py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card bg-warning text-dark border-0" style="min-height: 200px;">
                        <div class="card-body d-flex flex-column justify-content-center">
                            <h3>Flash Sale!</h3>
                            <p>Diskon hingga 50% untuk produk pilihan</p>
                            <a href="#" class="btn btn-dark" style="width: fit-content;">
                                Lihat Promo
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card bg-info text-white border-0" style="min-height: 200px;">
                        <div class="card-body d-flex flex-column justify-content-center">
                            <h3>Member Baru?</h3>
                            <p>Dapatkan voucher Rp 50.000 untuk pembelian pertama</p>
                            <a href="{{ route('register') }}" class="btn btn-light" style="width: fit-content;">
                                Daftar Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Produk Terbaru --}}
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-4">Produk Terbaru</h2>
            <div class="row g-4">
                @foreach($latestProducts as $product)
                    <div class="col-6 col-md-4 col-lg-3">
                        @include('partials.product-card', ['product' => $product])
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
