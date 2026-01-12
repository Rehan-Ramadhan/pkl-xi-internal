{{-- ================================================
FUNGSI: Footer Website SiKoMart
================================================ --}}
<footer class="bg-dark text-light pt-5 pb-4 mt-5">
    <div class="container">
        <div class="row g-4">
            {{-- Brand & Description --}}
            <div class="col-lg-4 col-md-6">
                <div class="d-flex align-items-center mb-3">
                    <img src="{{ asset('images/Logo-SiKoMart.png') }}" 
                         alt="Logo SiKoMart" 
                         width="45" 
                         class="me-2"
                         style="filter: drop-shadow(2px 2px 0px #fff);">
                    <h4 class="text-white fw-bold mb-0" style="letter-spacing: 1px;">SiKoMart</h4>
                </div>
                <p class="text-secondary pe-lg-4">
                    Markas besar para kolektor komik! Temukan Manhwa, Manga, dan Manhua original terlengkap dengan pelayanan secepat kilat.
                </p>
                {{-- Social Media dengan Hover Effect --}}
                <div class="d-flex gap-3 mt-4">
                    <a href="#" class="text-secondary transition-all hover-primary fs-5"><i class="bi bi-facebook"></i></a>
                    <a href="https://www.instagram.com/swimgoodchild/" target="_blank" class="text-secondary transition-all hover-primary fs-5"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="text-secondary transition-all hover-primary fs-5"><i class="bi bi-twitter-x"></i></a>
                    <a href="#" class="text-secondary transition-all hover-primary fs-5"><i class="bi bi-youtube"></i></a>
                </div>
            </div>

            {{-- Quick Links --}}
            <div class="col-lg-2 col-md-6">
                <h6 class="text-white fw-bold mb-3">Jelajahi</h6>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="{{ route('catalog.index') }}" class="text-secondary text-decoration-none hover-link">Katalog Komik</a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="text-secondary text-decoration-none hover-link">Rilisan Terbaru</a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="text-secondary text-decoration-none hover-link">Tentang SiKoMart</a>
                    </li>
                </ul>
            </div>

            {{-- Help --}}
            <div class="col-lg-2 col-md-6">
                <h6 class="text-white fw-bold mb-3">Bantuan</h6>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="#" class="text-secondary text-decoration-none hover-link">Cara Order</a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="text-secondary text-decoration-none hover-link">Pengiriman</a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="text-secondary text-decoration-none hover-link">FAQ & Support</a>
                    </li>
                </ul>
            </div>

            {{-- Contact --}}
            <div class="col-lg-4 col-md-6">
                <h6 class="text-white fw-bold mb-3">Hubungi Markas</h6>
                <ul class="list-unstyled text-secondary">
                    <li class="d-flex mb-3">
                        <i class="bi bi-geo-alt-fill text-primary me-3"></i>
                        <span>Jl. Jalan No. 123, Kota Bandung, Jawa Barat</span>
                    </li>
                    <li class="d-flex mb-3">
                        <i class="bi bi-whatsapp text-success me-3"></i>
                        <span>+62 123-456-7890</span>
                    </li>
                    <li class="d-flex mb-3">
                        <i class="bi bi-envelope-fill text-warning me-3"></i>
                        <span>admin@sikomart.com</span>
                    </li>
                </ul>
            </div>
        </div>

        <hr class="my-4 border-secondary opacity-25">

        <div class="row align-items-center">
            {{-- Copyright --}}
            <div class="col-md-6 text-center text-md-start">
                <p class="text-secondary mb-0 small">
                    &copy; {{ date('Y') }} <span class="text-white fw-semibold">SiKoMart</span>. Dibuat dengan <i class="bi bi-heart-fill text-danger"></i> untuk Pembaca.
                </p>
            </div>
            {{-- Payments --}}
            <div class="col-md-6 text-center text-md-end mt-3 mt-md-0">
                <div class="d-flex justify-content-center justify-content-md-end gap-3 align-items-center">
                    <span class="small text-secondary me-2 d-none d-sm-inline">Pembayaran Aman:</span>
                    <i class="bi bi-credit-card-2-back fs-4 text-light" title="Transfer Bank"></i>
                    <i class="bi bi-qr-code-scan fs-4 text-light" title="QRIS"></i>
                    <i class="bi bi-wallet2 fs-4 text-light" title="E-Wallet"></i>
                    <i class="bi bi-truck fs-4 text-light" title="Bayar di Tempat (COD)"></i>
                </div>
            </div>
        </div>
    </div>
</footer>
