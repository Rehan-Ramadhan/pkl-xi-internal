@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <div class="card border-4 border-dark shadow-lg p-5" style="background-color: #fffdec;">
                    <div class="mb-4">
                        <div class="display-1 text-success mb-3">
                            <i class="bi bi-check-circle-fill"></i>
                        </div>
                        <h1 class="fw-bold text-dark border-bottom border-4 border-dark d-inline-block px-3 mb-4"
                            style="transform: rotate(-2deg); background: #ffea00;">
                            BOOM! PAYMENT SUCCESS!
                        </h1>
                    </div>

                    <div class="fs-5 mb-4 text-dark fw-bold">
                        <p>Terima kasih, **{{ auth()->user()->name }}**!</p>
                        <p>Pesanan kamu dengan nomor <span class="text-primary">#{{ $order->order_number }}</span> sedang
                            kami proses.</p>
                    </div>

                    <div class="row justify-content-center mb-5">
                        <div class="col-md-6 border border-3 border-dark p-3 bg-white"
                            style="box-shadow: 8px 8px 0px #000;">
                            <p class="mb-1 fw-bold text-muted">Total Pembayaran:</p>
                            <h3 class="fw-bold text-dark">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</h3>
                            <span class="badge bg-success border border-2 border-dark text-white px-3 py-2">
                                STATUS: PAID ({{ strtoupper($order->status) }})
                            </span>
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                        <a href="{{ route('orders.index') }}"
                            class="btn btn-primary btn-lg border border-3 border-dark fw-bold px-4 py-3"
                            style="box-shadow: 5px 5px 0px #000;">
                            LIHAT RIWAYAT PESANAN
                        </a>
                        <a href="{{ route('catalog.index') }}"
                            class="btn btn-outline-dark btn-lg border border-3 border-dark fw-bold px-4 py-3">
                            LANJUT BELANJA
                        </a>
                    </div>
                </div>

                <p class="mt-4 text-muted fw-bold italic">
                    *Halaman ini otomatis diperbarui setelah verifikasi pembayaran Midtrans.
                </p>
            </div>
        </div>
    </div>

    <style>
        /* Tambahan style khusus biar makin berasa komik */
        .card {
            border-radius: 0;
        }

        h1 {
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .btn {
            transition: all 0.2s;
            border-radius: 0;
        }

        .btn:hover {
            transform: translate(-2px, -2px);
            box-shadow: 8px 8px 0px #000 !important;
        }
    </style>
@endsection
