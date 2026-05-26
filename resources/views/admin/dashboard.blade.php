@extends('layout.admin')

@section('content')
<h2 class="font-weight-bold mb-4">Dashboard Overview</h2>

<div class="row">
    <!-- Stat Card: Products -->
    <div class="col-md-3 mb-4">
        <div class="card card-stats p-3">
            <div class="d-flex align-items-center">
                <div class="stat-icon" style="background-color: #e0f0ff; color: var(--color-action-blue);">
                    <i class="fas fa-box"></i>
                </div>
                <div class="ml-3">
                    <p class="text-muted mb-0" style="font-size: 13px;">Total Produk</p>
                    <h3 class="font-weight-bold mb-0 text-dark">{{ $stats['products_count'] }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Stat Card: Categories -->
    <div class="col-md-3 mb-4">
        <div class="card card-stats p-3">
            <div class="d-flex align-items-center">
                <div class="stat-icon" style="background-color: #e6f9ed; color: var(--color-success-green);">
                    <i class="fas fa-tags"></i>
                </div>
                <div class="ml-3">
                    <p class="text-muted mb-0" style="font-size: 13px;">Kategori</p>
                    <h3 class="font-weight-bold mb-0 text-dark">{{ $stats['categories_count'] }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Stat Card: Orders -->
    <div class="col-md-3 mb-4">
        <div class="card card-stats p-3">
            <div class="d-flex align-items-center">
                <div class="stat-icon" style="background-color: #fdf0e7; color: var(--color-accent-orange);">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="ml-3">
                    <p class="text-muted mb-0" style="font-size: 13px;">Pesanan</p>
                    <h3 class="font-weight-bold mb-0 text-dark">{{ $stats['orders_count'] }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Stat Card: Customers -->
    <div class="col-md-3 mb-4">
        <div class="card card-stats p-3">
            <div class="d-flex align-items-center">
                <div class="stat-icon" style="background-color: #f3efff; color: var(--color-accent-violet);">
                    <i class="fas fa-users"></i>
                </div>
                <div class="ml-3">
                    <p class="text-muted mb-0" style="font-size: 13px;">Pelanggan</p>
                    <h3 class="font-weight-bold mb-0 text-dark">{{ $stats['customers_count'] }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-12">
        <div class="card card-frost p-4">
            <h5 class="font-weight-bold mb-2 text-dark">Selamat Datang, Admin!</h5>
            <p class="text-muted mb-0 text-body">Gunakan menu di samping kiri untuk mengelola katalog produk, kategori, dan memantau transaksi yang masuk.</p>
        </div>
    </div>
</div>
@endsection
