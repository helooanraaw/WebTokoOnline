@extends('layout.admin')

@section('content')
<h2 class="font-weight-bold mb-4">Dashboard Overview</h2>

<div class="row">
    <!-- Stat Card: Products -->
    <div class="col-md-3 mb-4">
        <div class="card card-stats p-3">
            <div class="d-flex align-items-center">
                <div class="stat-icon bg-primary text-white">
                    <i class="fas fa-box"></i>
                </div>
                <div class="ml-3">
                    <p class="text-muted mb-0">Total Produk</p>
                    <h3 class="font-weight-bold mb-0">{{ $stats['products_count'] }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Stat Card: Categories -->
    <div class="col-md-3 mb-4">
        <div class="card card-stats p-3">
            <div class="d-flex align-items-center">
                <div class="stat-icon bg-info text-white">
                    <i class="fas fa-tags"></i>
                </div>
                <div class="ml-3">
                    <p class="text-muted mb-0">Kategori</p>
                    <h3 class="font-weight-bold mb-0">{{ $stats['categories_count'] }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Stat Card: Orders -->
    <div class="col-md-3 mb-4">
        <div class="card card-stats p-3">
            <div class="d-flex align-items-center">
                <div class="stat-icon bg-success text-white">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="ml-3">
                    <p class="text-muted mb-0">Pesanan</p>
                    <h3 class="font-weight-bold mb-0">{{ $stats['orders_count'] }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Stat Card: Customers -->
    <div class="col-md-3 mb-4">
        <div class="card card-stats p-3">
            <div class="d-flex align-items-center">
                <div class="stat-icon bg-warning text-white">
                    <i class="fas fa-users"></i>
                </div>
                <div class="ml-3">
                    <p class="text-muted mb-0">Pelanggan</p>
                    <h3 class="font-weight-bold mb-0">{{ $stats['customers_count'] }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-12">
        <div class="card border-0 shadow-sm p-4">
            <h5 class="font-weight-bold mb-3">Selamat Datang, Admin!</h5>
            <p class="text-muted">Gunakan menu di samping kiri untuk mengelola katalog produk, kategori, dan memantau transaksi yang masuk.</p>
        </div>
    </div>
</div>
@endsection
