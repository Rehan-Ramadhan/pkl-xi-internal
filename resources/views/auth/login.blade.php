@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        @include('partials.flash-messages')
    </div>

    <div class="container py-5">
        <div class="row justify-content-center align-items-center" style="min-height: 80vh;">
            {{-- Kita lebarkan kolom utama agar muat untuk gambar + form --}}
            <div class="col-md-10 col-lg-9">
                
                {{-- Card Utama dengan Row di dalamnya --}}
                <div class="card border-0 shadow-lg" style="border-radius: 1.25rem; overflow: hidden;">
                    <div class="row g-0">
                        
                        {{-- SISI KIRI: Area Foto/Logo --}}
                        {{-- d-none d-md-flex artinya gambar hilang di HP, muncul di layar Tablet/PC --}}
                        <div class="col-md-6 d-none d-md-flex align-items-center justify-content-center bg-light border-end">
                            <div class="p-5 text-center">
                                <img src="{{ asset('images/Logo-SiKoMart.png') }}" {{-- Ganti dengan path foto kamu --}}
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

                        {{-- SISI KANAN: Form Login --}}
                        <div class="col-md-6">
                            {{-- Header Gradasi --}}
                            <div class="card-header bg-primary bg-gradient text-white text-center py-4 border-0">
                                <h3 class="fw-bold mb-0">Selamat Datang</h3>
                                <p class="small mb-0 opacity-75">Silakan masuk ke akun Anda</p>
                            </div>

                            <div class="card-body p-4 p-md-5">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <div class="mb-4">
                                        <label for="email" class="form-label fw-semibold text-secondary">Alamat Email</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0"><i class="bi bi-envelope"></i></span>
                                            <input id="email" type="email" class="form-control bg-light border-start-0 @error('email') is-invalid @enderror" 
                                                   name="email" value="{{ old('email') }}" required placeholder="contoh@email.com" autofocus>
                                            @error('email')
                                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="d-flex justify-content-between">
                                            <label for="password" class="form-label fw-semibold text-secondary">Password</label>
                                            @if (Route::has('password.request'))
                                                <a class="text-decoration-none small" href="{{ route('password.request') }}">Lupa Password?</a>
                                            @endif
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0"><i class="bi bi-lock"></i></span>
                                            <input id="password" type="password" class="form-control bg-light border-start-0 @error('password') is-invalid @enderror" 
                                                   name="password" required placeholder="masukkan password anda">
                                            @error('password')
                                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-4 form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label text-muted small" for="remember">Ingat saya di perangkat ini</label>
                                    </div>

                                    <div class="d-grid mb-4">
                                        <button type="submit" class="btn btn-primary btn-lg shadow-sm fw-bold py-2" style="border-radius: 10px;">Masuk Sekarang</button>
                                    </div>

                                    <div class="position-relative mb-4">
                                        <hr class="text-secondary">
                                        <span class="position-absolute top-50 start-50 translate-middle bg-white px-3 text-muted small">Atau</span>
                                    </div>

                                    <div class="d-grid gap-2">
                                        <a href="{{ route('auth.google') }}" class="btn btn-outline-dark py-2 d-flex align-items-center justify-content-center" style="border-radius: 10px;">
                                            <img src="https://www.svgrepo.com/show/475656/google-color.svg" width="20" class="me-2" alt="Google">
                                            Lanjutkan dengan Google
                                        </a>
                                    </div>

                                    <div class="mt-5 text-center">
                                        <p class="text-muted mb-0">Belum punya akun? 
                                            <a href="{{ route('register') }}" class="text-primary fw-bold text-decoration-none">Daftar Sekarang</a>
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
