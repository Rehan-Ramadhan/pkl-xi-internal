@extends('layouts.app')
@section('title', 'Checkout')

@section('content')
    <div class="container py-5">
        <h1 class="mb-4 fw-bold">Checkout</h1>

        <form action="{{ route('checkout.store') }}" method="POST">
            @csrf
            <div class="row g-4">

                {{-- Form Alamat --}}
                <div class="col-lg-8">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="mb-4">Informasi Pengiriman</h5>

                            <div class="mb-3">
                                <label class="form-label">Nama Penerima</label>
                                <input type="text" name="name" value="{{ auth()->user()->name }}" class="form-control"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nomor Telepon</label>
                                <input type="text" name="phone" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Alamat Lengkap</label>
                                <textarea name="address" rows="3" class="form-control" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Ringkasan --}}
                <div class="col-lg-4">
                    <div class="card shadow-sm sticky-top" style="top: 80px;">
                        <div class="card-body">
                            <h5 class="mb-4">Ringkasan Pesanan</h5>

                            @foreach($cart->items as $item)
                                <div class="d-flex justify-content-between mb-2">
                                    <span>{{ $item->product->name }} x {{ $item->quantity }}</span>
                                    <span>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                                </div>
                            @endforeach

                            <hr>

                            <div class="d-flex justify-content-between fw-bold fs-5">
                                <span>Total</span>
                                <span>Rp {{ number_format($cart->items->sum('subtotal'), 0, ',', '.') }}</span>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 mt-4">
                                Buat Pesanan
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
@endsection
