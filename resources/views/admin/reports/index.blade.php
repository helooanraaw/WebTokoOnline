@extends('layout.admin')

@section('content')
<div class="container-fluid px-0">
    <!-- Header Page -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
        <div>
            <h1 class="font-weight-bold text-dark mb-1 text-display-md" style="font-size: 28px;">
                <i class="fab fa-apple mr-2" style="color: var(--color-text-primary);"></i>Laporan Penjualan
            </h1>
            <p class="text-muted mb-0 text-body">Analisis kinerja penjualan, omzet, dan ekspor data transaksi toko online Anda.</p>
        </div>
        <div class="mt-3 mt-md-0 d-flex flex-wrap gap-2">
            <a href="{{ route('admin.report.export-csv', request()->all()) }}" class="btn btn-outline-success mr-2">
                <i class="fas fa-file-excel mr-2"></i>Ekspor Excel (CSV)
            </a>
            <a href="{{ route('admin.report.print', request()->all()) }}" target="_blank" class="btn btn-primary">
                <i class="fas fa-print mr-2"></i>Cetak Laporan (PDF)
            </a>
        </div>
    </div>

    <!-- Filter Card -->
    <div class="card card-white mb-4">
        <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
            <h5 class="font-weight-bold text-dark m-0 text-heading-lg"><i class="fas fa-filter text-muted mr-2"></i>Filter Laporan</h5>
        </div>
        <div class="card-body pt-3">
            <form action="{{ route('admin.report.index') }}" method="GET" class="row align-items-end">
                <div class="col-md-4 mb-3">
                    <label for="start_date" class="text-xs font-weight-bold text-uppercase text-muted mb-1 text-caption">Tanggal Mulai</label>
                    <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $startDate }}" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="end_date" class="text-xs font-weight-bold text-uppercase text-muted mb-1 text-caption">Tanggal Selesai</label>
                    <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $endDate }}" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="status" class="text-xs font-weight-bold text-uppercase text-muted mb-1 text-caption">Status Pesanan</label>
                    <select name="status" id="status" class="form-control">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ $status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processing" {{ $status == 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="completed" {{ $status == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ $status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
                <div class="col-md-1 mb-3">
                    <button type="submit" class="btn btn-dark btn-block py-2">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Summary Stats Widgets -->
    <div class="row">
        <!-- Revenue Card (Completed Only) -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-stats border-left-primary h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1 text-caption" style="color: var(--color-action-blue);">Omzet Selesai</div>
                            <div class="h5 mb-0 font-weight-bold text-dark">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
                            <small class="text-success font-weight-600 text-caption"><i class="fas fa-check-circle mr-1"></i>Transaksi Sukses</small>
                        </div>
                        <div class="col-auto">
                            <div class="stat-icon" style="background-color: #e0f0ff; color: var(--color-action-blue);">
                                <i class="fas fa-wallet"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Terfilter Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-stats border-left-success h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1 text-caption" style="color: var(--color-success-green);">Total Nilai Terfilter</div>
                            <div class="h5 mb-0 font-weight-bold text-dark">Rp {{ number_format($totalSalesFiltered, 0, ',', '.') }}</div>
                            <small class="text-muted font-weight-600 text-caption">Semua status dalam filter</small>
                        </div>
                        <div class="col-auto">
                            <div class="stat-icon" style="background-color: #e6f9ed; color: var(--color-success-green);">
                                <i class="fas fa-chart-bar"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Orders Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-stats border-left-info h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1 text-caption" style="color: var(--color-accent-violet);">Jumlah Transaksi</div>
                            <div class="h5 mb-0 font-weight-bold text-dark">{{ $totalOrders }} Pesanan</div>
                            <small class="text-muted font-weight-600 text-caption">Rata-rata: Rp {{ number_format($averageOrderValue, 0, ',', '.') }}</small>
                        </div>
                        <div class="col-auto">
                            <div class="stat-icon" style="background-color: #f3efff; color: var(--color-accent-violet);">
                                <i class="fas fa-shopping-basket"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Items Sold -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-stats border-left-warning h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1 text-caption" style="color: var(--color-accent-orange);">Barang Terjual</div>
                            <div class="h5 mb-0 font-weight-bold text-dark">{{ $totalItemsSold }} Pcs</div>
                            <small class="text-muted font-weight-600 text-caption">Total volume produk terjual</small>
                        </div>
                        <div class="col-auto">
                            <div class="stat-icon" style="background-color: #fdf0e7; color: var(--color-accent-orange);">
                                <i class="fas fa-box-open"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Status Breakdowns Row -->
    <div class="row mb-4">
        <div class="col-md-4 mb-3 mb-md-0">
            <div class="p-3 card-frost d-flex align-items-center" style="border-left: 4px solid var(--color-accent-orange); border-radius: var(--radius-links) !important;">
                <div class="rounded-circle p-2 mr-3 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; background-color: #fdf0e7; color: var(--color-accent-orange);">
                    <i class="fas fa-clock fa-fw"></i>
                </div>
                <div>
                    <span class="text-muted text-caption font-weight-bold text-uppercase d-block" style="font-size: 10px;">Menunggu Pembayaran</span>
                    <strong class="text-dark font-weight-700 text-body">Rp {{ number_format($totalPending, 0, ',', '.') }}</strong>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3 mb-md-0">
            <div class="p-3 card-frost d-flex align-items-center" style="border-left: 4px solid var(--color-action-blue); border-radius: var(--radius-links) !important;">
                <div class="rounded-circle p-2 mr-3 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; background-color: #e0f0ff; color: var(--color-action-blue);">
                    <i class="fas fa-sync fa-fw"></i>
                </div>
                <div>
                    <span class="text-muted text-caption font-weight-bold text-uppercase d-block" style="font-size: 10px;">Sedang Diproses</span>
                    <strong class="text-dark font-weight-700 text-body">Rp {{ number_format($totalProcessing, 0, ',', '.') }}</strong>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-3 card-frost d-flex align-items-center" style="border-left: 4px solid #ff3b30; border-radius: var(--radius-links) !important;">
                <div class="rounded-circle p-2 mr-3 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; background-color: #ffeef0; color: #ff3b30;">
                    <i class="fas fa-times fa-fw"></i>
                </div>
                <div>
                    <span class="text-muted text-caption font-weight-bold text-uppercase d-block" style="font-size: 10px;">Pesanan Dibatalkan</span>
                    <strong class="text-dark font-weight-700 text-body">Rp {{ number_format($totalCancelled, 0, ',', '.') }}</strong>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Table Card -->
    <div class="card card-white">
        <div class="card-header bg-white border-bottom pt-4 pb-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="font-weight-bold text-dark m-0 text-heading-lg"><i class="fas fa-list text-muted mr-2"></i>Daftar Transaksi</h5>
                <span class="px-3 py-1 font-weight-600 text-caption" style="background-color: var(--color-surface-frost); color: var(--color-text-secondary); border-radius: 980px;">Menampilkan {{ $orders->count() }} Data</span>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="pl-4">No. Invoice</th>
                            <th>Tanggal / Waktu</th>
                            <th>Nama Pelanggan</th>
                            <th>Pembayaran</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Jumlah Barang</th>
                            <th class="text-right pr-4">Total Belanja</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                            <tr>
                                <td class="pl-4 font-weight-bold align-middle">
                                    <a href="{{ route('admin.order.show', $order->id) }}" class="font-weight-bold text-decoration-none" style="color: var(--color-link-blue);">
                                        {{ $order->invoice_number }}
                                    </a>
                                </td>
                                <td class="text-muted text-body align-middle">
                                    {{ $order->created_at->format('d M Y') }}
                                    <span class="text-caption d-block text-muted">{{ $order->created_at->format('H:i') }}</span>
                                </td>
                                <td class="align-middle">
                                    <div class="d-flex align-items-center">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($order->user ? $order->user->name : 'Guest') }}&background=0071e3&color=fff" 
                                             class="rounded-circle mr-2" style="width: 28px; height: 28px;">
                                        <span class="font-weight-600 text-dark">{{ $order->user ? $order->user->name : 'Guest' }}</span>
                                    </div>
                                </td>
                                <td class="font-weight-600 text-uppercase text-caption text-muted align-middle">
                                    <span class="px-2 py-0.5" style="background-color: var(--color-surface-frost); border-radius: 4px;">
                                        {{ $order->payment_method }}
                                    </span>
                                </td>
                                <td class="text-center align-middle">
                                    <span class="font-weight-600 px-3 py-1" style="font-size: 11px; border-radius: 980px; display: inline-block;
                                        @if($order->status == 'completed') background-color: #e6f9ed; color: var(--color-success-green);
                                        @elseif($order->status == 'pending') background-color: #fdf0e7; color: var(--color-accent-orange);
                                        @elseif($order->status == 'processing') background-color: #e0f0ff; color: var(--color-action-blue);
                                        @elseif($order->status == 'cancelled') background-color: #ffeef0; color: #ff3b30;
                                        @endif">
                                        {{ strtoupper($order->status) }}
                                    </span>
                                </td>
                                <td class="text-center font-weight-600 text-dark align-middle">
                                    {{ $order->items->sum('qty') }} Pcs
                                </td>
                                <td class="text-right pr-4 font-weight-bold text-dark align-middle text-body-lg">
                                    Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <i class="fas fa-search fa-3x mb-3 text-muted" style="opacity: 0.3;"></i>
                                    <h6 class="text-muted font-weight-600 text-body-lg">Tidak ada transaksi ditemukan pada periode filter ini.</h6>
                                    <p class="text-caption text-muted mb-0">Silakan ubah rentang tanggal atau status filter Anda.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    .hover-scale {
        transition: all 0.2s ease-in-out;
    }
    .hover-scale:hover {
        transform: scale(1.01);
    }
    .border-left-primary {
        border-left: 4px solid var(--color-action-blue) !important;
    }
    .border-left-success {
        border-left: 4px solid var(--color-success-green) !important;
    }
    .border-left-info {
        border-left: 4px solid var(--color-accent-violet) !important;
    }
    .border-left-warning {
        border-left: 4px solid var(--color-accent-orange) !important;
    }
</style>
@endsection
