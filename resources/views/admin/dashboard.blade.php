@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="row g-4 mb-4">
        {{-- 1. Stats Cards Grid --}}

        {{-- Revenue Card --}}
        <div class="col-sm-6 col-xl-3">
            <div class="card shadow-sm border-start h-10">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted text-uppercase fw-semibold mb-1" style="font-size: 0.8rem">Total Pendapatan
                            </p>
                            <h4 class="fw-bold mb-0 text-success">
                                Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}
                            </h4>
                        </div>
                        <div class="bg-success bg-opacity-10 p-3 rounded">
                            <i class="bi bi-wallet2 text-white fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Pending Action Card --}}
        <div class="col-sm-6 col-xl-3">
            <div class="card shadow-sm border-start h-10">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted text-uppercase fw-semibold mb-1" style="font-size: 0.8rem">Perlu Diproses
                            </p>
                            <h4 class="fw-bold mb-0 text-warning">
                                {{ $stats['pending_orders'] }}
                            </h4>
                        </div>
                        <div class="bg-warning bg-opacity-10 p-3 rounded">
                            <i class="bi bi-box-seam text-white fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Low Stock Card --}}
        <div class="col-sm-6 col-xl-3">
            <div class="card shadow-sm border-start h-10">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted text-uppercase fw-semibold mb-1" style="font-size: 0.8rem">Stok Menipis</p>
                            <h4 class="fw-bold mb-0 text-danger">
                                {{ $stats['low_stock'] }}
                            </h4>
                        </div>
                        <div class="bg-danger bg-opacity-10 p-3 rounded">
                            <i class="bi bi-exclamation-triangle text-white fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total Products --}}
        <div class="col-sm-6 col-xl-3">
            <div class="card shadow-sm border-start h-10">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted text-uppercase fw-semibold mb-1" style="font-size: 0.8rem">Total Produk</p>
                            <h4 class="fw-bold mb-0 text-primary">
                                {{ $stats['total_products'] }}
                            </h4>
                        </div>
                        <div class="bg-primary bg-opacity-10 p-3 rounded">
                            <i class="bi bi-tags text-white fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        {{-- 2. Revenue Chart --}}
        <div class="col-lg-8">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title mb-0">Grafik Penjualan (7 Hari)</h5>
                </div>
                <div class="card-body">
                    <canvas id="revenueChart" height="100"></canvas>
                </div>
            </div>
        </div>

        {{-- 3. Recent Orders --}}
        <div class="col-lg-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title mb-0">Pesanan Terbaru</h5>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @foreach($recentOrders as $order)
                            <div class="list-group-item d-flex justify-content-between align-items-center px-4 py-3">
                                <div>
                                    <div class="fw-bold text-primary">#{{ $order->order_number }}</div>
                                    <small class="text-muted">{{ $order->user->name }}</small>
                                </div>
                                <div class="text-end">
                                    <div class="fw-bold">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</div>
                                    <span
                                        class="badge rounded-pill
                                                                                        {{ $order->payment_status == 'paid' ? 'bg-success bg-opacity-10 text' : 'bg-secondary bg-opacity-10 text' }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="card-footer bg-white text-center py-3">
                    <a href="{{ route('admin.orders.index') }}" class="text-decoration-none fw-bold">
                        Lihat Semua Pesanan &rarr;
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- 4. Top Selling Products --}}
    <div class="card shadow-sm mt-4">
        <div class="card-header bg-white py-3">
            <h5 class="card-title mb-0">Produk Terlaris</h5>
        </div>
        <div class="card-body">
            <div class="row g-4">
                @foreach($topProducts as $product)
                    <div class="col-6 col-md-2 text-center">
                        <div class="card h-100 hover-shadow transition">
                            <img src="{{ $product->image_url }}" class="card-img-top rounded mb-2"
                                style="max-height: 100px; object-fit: cover;">
                            <h6 class="card-title text-truncate" style="font-size: 0.9rem">{{ $product->name }}</h6>
                            <small class="text-muted">{{ $product->sold }} terjual</small>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Script Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // 1. Ambil data dari Controller
            const revenueData = {!! json_encode($revenueChart) !!};

            // 2. Map data untuk label (tanggal) dan data (nominal)
            const labels = revenueData.map(item => item.date);
            const data = revenueData.map(item => item.total);

            const canvas = document.getElementById('revenueChart');
            if (!canvas) return; // Pastikan canvas ada

            const ctx = canvas.getContext('2d');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Pendapatan (Rp)',
                        data: data,
                        borderColor: '#0d6efd', // Warna Biru
                        backgroundColor: 'rgba(13, 110, 253, 0.1)',
                        borderWidth: 3,
                        tension: 0.3,
                        fill: true,
                        pointRadius: 5,
                        pointBackgroundColor: '#0d6efd'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function (value) {
                                    return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
                                }
                            }
                        }
                    },
                    plugins: {
                        legend: { display: false }
                    }
                }
            });
        });
    </script>
@endsection