@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        @include('partials.flash-messages')
    </div>

    <div class="container py-5">
        <div class="row justify-content-center align-items-center" style="min-height: 80vh;">
            {{-- Kolom utama lebar agar muat gambar + form --}}
            <div class="col-md-10 col-lg-9">
                
                {{-- Card Utama --}}
                <div class="card border-0 shadow-lg" style="border-radius: 1.25rem; overflow: hidden;">
                    <div class="row g-0">
                        
                        {{-- SISI KIRI: Area Foto/Logo (Sama dengan Login) --}}
                        <div class="col-md-6 d-none d-md-flex align-items-center justify-content-center bg-light border-end">
                            <div class="p-5 text-center">
                                <img src="{{ asset('images/Logo-SiKoMart.png') }}" 
                                     alt="Logo" 
                                     class="img-fluid" 
                                     style="max-height: 300px; object-fit: contain;">
                                <div class="mt-4">
                                    <h3 class="fw-bold text-primary mb-1">SiKoMart</h3>
                                    <div class="mb-3">
                                        <span class="badge rounded-pill bg-primary px-3">Sistem Informasi Komik & Market</span>
                                    </div>
                                    <p class="text-secondary shadow-sm p-3 bg-white rounded-3 small">
                                        <i class="bi bi-book-half text-primary me-2"></i>
                                        <strong>Jelajahi Dunia Imajinasi Bersama Kami!</strong><br>
                                        Mari bergabung untuk menemukan koleksi komik terlengkap, kelola daftar keinginanmu, dan penuhi segala kebutuhanmu dalam satu ketukan.
                                    </p>
                                    <div class="d-flex justify-content-center gap-4 mt-3">
                                        <div class="text-center">
                                            <i class="bi bi-shield-check fs-4 text-success"></i>
                                            <p class="small mb-0">Privasi Aman</p>
                                        </div>
                                        
                                        <div class="text-center">
                                            <i class="bi bi-lightning-charge fs-4 text-warning"></i>
                                            <p class="small mb-0">Akses Cepat</p>
                                        </div>

                                        <div class="text-center">
                                            <i class="bi bi-journal-check fs-4 text-success"></i>
                                            <p class="small mb-0">Update Rutin</p>
                                        </div>

                                        <div class="text-center">
                                            <i class="bi bi-cart-check fs-4 text-warning"></i>
                                            <p class="small mb-0">Belanja Mudah</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- SISI KANAN: Form Register --}}
                        <div class="col-md-6">
                            {{-- Header Gradasi --}}
                            <div class="card-header bg-primary bg-gradient text-white text-center py-4 border-0">
                                <h3 class="fw-bold mb-0">Daftar Akun</h3>
                                <p class="small mb-0 opacity-75">Lengkapi data untuk bergabung</p>
                            </div>

                            <div class="card-body p-4 p-md-5">
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf

                                    {{-- Input Nama --}}
                                    <div class="mb-3">
                                        <label for="name" class="form-label fw-semibold text-secondary">Nama Lengkap</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0"><i class="bi bi-person"></i></span>
                                            <input id="name" type="text" class="form-control bg-light border-start-0 @error('name') is-invalid @enderror" 
                                                   name="name" value="{{ old('name') }}" required placeholder="Nama lengkap Anda" autofocus>
                                            @error('name')
                                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Input Email --}}
                                    <div class="mb-3">
                                        <label for="email" class="form-label fw-semibold text-secondary">Alamat Email</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0"><i class="bi bi-envelope"></i></span>
                                            <input id="email" type="email" class="form-control bg-light border-start-0 @error('email') is-invalid @enderror" 
                                                   name="email" value="{{ old('email') }}" required placeholder="contoh@email.com">
                                            @error('email')
                                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Input Password --}}
                                    <div class="mb-3">
                                        <label for="password" class="form-label fw-semibold text-secondary">Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0"><i class="bi bi-lock"></i></span>
                                            <input id="password" type="password" class="form-control bg-light border-start-0 @error('password') is-invalid @enderror" 
                                                   name="password" required placeholder="minimal 8 karakter">
                                            @error('password')
                                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Input Konfirmasi Password --}}
                                    <div class="mb-4">
                                        <label for="password-confirm" class="form-label fw-semibold text-secondary">Konfirmasi Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0"><i class="bi bi-check-circle"></i></span>
                                            <input id="password-confirm" type="password" class="form-control bg-light border-start-0" 
                                                   name="password_confirmation" required placeholder="ulangi password">
                                        </div>
                                    </div>

                                    <div class="d-grid mb-4">
                                        <button type="submit" class="btn btn-primary btn-lg shadow-sm fw-bold py-2" style="border-radius: 10px;">Daftar Sekarang</button>
                                    </div>

                                    <div class="position-relative mb-4">
                                        <hr class="text-secondary">
                                        <span class="position-absolute top-50 start-50 translate-middle bg-white px-3 text-muted small">Atau</span>
                                    </div>

                                    {{-- Google Sign-up --}}
                                    <div class="d-grid gap-2">
                                        <a href="{{ route('auth.google') }}" class="btn btn-outline-dark py-2 d-flex align-items-center justify-content-center" style="border-radius: 10px;">
                                            <img src="https://www.svgrepo.com/show/475656/google-color.svg" width="20" class="me-2" alt="Google">
                                            Daftar dengan Google
                                        </a>
                                    </div>

                                    <div class="mt-5 text-center">
                                        <p class="text-muted mb-0">Sudah punya akun? 
                                            <a href="{{ route('login') }}" class="text-primary fw-bold text-decoration-none">Masuk Di Sini</a>
                                        </p>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div> {{-- End Row g-0 --}}
                </div> {{-- End Card --}}

                <div class="text-center mt-4 text-muted small">
                    &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                </div>
            </div>
        </div>
    </div>
@endsection