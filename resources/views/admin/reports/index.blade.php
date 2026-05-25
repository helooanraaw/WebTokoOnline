@extends('layout.admin')

@section('content')
<div class="container-fluid px-0">
    <!-- Header Page -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
        <div>
            <h1 class="h3 font-weight-bold text-gray-800 mb-1">
                <i class="fas fa-file-invoice-dollar text-primary mr-2"></i>Laporan Penjualan
            </h1>
            <p class="text-muted mb-0">Analisis kinerja penjualan, omzet, dan ekspor data transaksi toko online Anda.</p>
        </div>
        <div class="mt-3 mt-md-0 d-flex flex-wrap gap-2">
            <a href="{{ route('admin.report.export-csv', request()->all()) }}" class="btn btn-outline-success btn-icon-split mr-2 shadow-sm hover-scale transition-all">
                <span class="icon text-green-500">
                    <i class="fas fa-file-excel mr-2"></i>
                </span>
                <span class="text font-weight-600">Ekspor Excel (CSV)</span>
            </a>
            <a href="{{ route('admin.report.print', request()->all()) }}" target="_blank" class="btn btn-primary btn-icon-split shadow-sm hover-scale transition-all">
                <span class="icon text-white-50">
                    <i class="fas fa-print mr-2"></i>
                </span>
                <span class="text font-weight-600">Cetak Laporan (PDF)</span>
            </a>
        </div>
    </div>

    <!-- Filter Card -->
    <div class="card border-0 shadow-sm mb-4 rounded-lg overflow-hidden">
        <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
            <h5 class="font-weight-bold text-dark m-0"><i class="fas fa-filter text-muted mr-2"></i>Filter Laporan</h5>
        </div>
        <div class="card-body pt-3">
            <form action="{{ route('admin.report.index') }}" method="GET" class="row align-items-end">
                <div class="col-md-4 mb-3">
                    <label for="start_date" class="text-xs font-weight-bold text-uppercase text-muted mb-1">Tanggal Mulai</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-light border-right-0"><i class="fas fa-calendar-alt text-muted"></i></span>
                        </div>
                        <input type="date" name="start_date" id="start_date" class="form-control border-left-0 font-weight-500" value="{{ $startDate }}" required>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="end_date" class="text-xs font-weight-bold text-uppercase text-muted mb-1">Tanggal Selesai</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-light border-right-0"><i class="fas fa-calendar-alt text-muted"></i></span>
                        </div>
                        <input type="date" name="end_date" id="end_date" class="form-control border-left-0 font-weight-500" value="{{ $endDate }}" required>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="status" class="text-xs font-weight-bold text-uppercase text-muted mb-1">Status Pesanan</label>
                    <select name="status" id="status" class="form-control font-weight-500 custom-select">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ $status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processing" {{ $status == 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="completed" {{ $status == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ $status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
                <div class="col-md-1 mb-3">
                    <button type="submit" class="btn btn-dark btn-block shadow-sm py-2 hover-darken transition-all">
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
            <div class="card card-stats border-0 border-left-primary shadow-sm h-100 py-2 rounded-lg position-relative overflow-hidden transition-all hover-translate-y">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Omzet Selesai</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
                            <small class="text-success font-weight-600"><i class="fas fa-check-circle mr-1"></i>Transaksi Sukses</small>
                        </div>
                        <div class="col-auto">
                            <div class="stat-icon bg-primary text-white shadow-sm">
                                <i class="fas fa-wallet"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Terfilter Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-stats border-0 border-left-success shadow-sm h-100 py-2 rounded-lg position-relative overflow-hidden transition-all hover-translate-y">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Nilai Terfilter</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp {{ number_format($totalSalesFiltered, 0, ',', '.') }}</div>
                            <small class="text-muted font-weight-600">Semua status dalam filter</small>
                        </div>
                        <div class="col-auto">
                            <div class="stat-icon bg-success text-white shadow-sm">
                                <i class="fas fa-chart-bar"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Orders Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-stats border-0 border-left-info shadow-sm h-100 py-2 rounded-lg position-relative overflow-hidden transition-all hover-translate-y">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Jumlah Transaksi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalOrders }} Pesanan</div>
                            <small class="text-muted font-weight-600">Rata-rata: Rp {{ number_format($averageOrderValue, 0, ',', '.') }}</small>
                        </div>
                        <div class="col-auto">
                            <div class="stat-icon bg-info text-white shadow-sm">
                                <i class="fas fa-shopping-basket"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Items Sold -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-stats border-0 border-left-warning shadow-sm h-100 py-2 rounded-lg position-relative overflow-hidden transition-all hover-translate-y">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Barang Terjual</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalItemsSold }} Pcs</div>
                            <small class="text-muted font-weight-600">Total volume produk terjual</small>
                        </div>
                        <div class="col-auto">
                            <div class="stat-icon bg-warning text-white shadow-sm">
                                <i class="fas fa-box-open"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Status Breakdowns Alert/Row -->
    <div class="row mb-4">
        <div class="col-md-4 mb-3 mb-md-0">
            <div class="p-3 bg-white shadow-sm rounded-lg d-flex align-items-center border-left border-warning">
                <div class="rounded-circle bg-warning-light p-2 mr-3 text-warning">
                    <i class="fas fa-clock fa-fw"></i>
                </div>
                <div>
                    <span class="text-muted text-xs font-weight-bold text-uppercase d-block">Menunggu Pembayaran</span>
                    <strong class="text-dark font-weight-700">Rp {{ number_format($totalPending, 0, ',', '.') }}</strong>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3 mb-md-0">
            <div class="p-3 bg-white shadow-sm rounded-lg d-flex align-items-center border-left border-info">
                <div class="rounded-circle bg-info-light p-2 mr-3 text-info">
                    <i class="fas fa-sync fa-fw"></i>
                </div>
                <div>
                    <span class="text-muted text-xs font-weight-bold text-uppercase d-block">Sedang Diproses</span>
                    <strong class="text-dark font-weight-700">Rp {{ number_format($totalProcessing, 0, ',', '.') }}</strong>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-3 bg-white shadow-sm rounded-lg d-flex align-items-center border-left border-danger">
                <div class="rounded-circle bg-danger-light p-2 mr-3 text-danger">
                    <i class="fas fa-times fa-fw"></i>
                </div>
                <div>
                    <span class="text-muted text-xs font-weight-bold text-uppercase d-block">Pesanan Dibatalkan</span>
                    <strong class="text-dark font-weight-700">Rp {{ number_format($totalCancelled, 0, ',', '.') }}</strong>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Table Card -->
    <div class="card border-0 shadow-sm rounded-lg overflow-hidden">
        <div class="card-header bg-white border-bottom pt-4 pb-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="font-weight-bold text-dark m-0"><i class="fas fa-list text-muted mr-2"></i>Daftar Transaksi</h5>
                <span class="badge badge-light border text-muted px-3 py-2 rounded-pill font-weight-600">Menampilkan {{ $orders->count() }} Data</span>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-muted font-weight-600 text-xs text-uppercase">
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
                            <tr class="transition-all hover-bg-light">
                                <td class="pl-4 font-weight-bold">
                                    <a href="{{ route('admin.order.show', $order->id) }}" class="text-primary text-decoration-none">
                                        {{ $order->invoice_number }}
                                    </a>
                                </td>
                                <td class="text-muted font-weight-500">
                                    {{ $order->created_at->format('d M Y') }}
                                    <span class="text-xs d-block text-gray-400">{{ $order->created_at->format('H:i') }}</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($order->user ? $order->user->name : 'Guest') }}&background=E0E7FF&color=4F46E5" 
                                             class="rounded-circle mr-2" style="width: 28px; height: 28px;">
                                        <span class="font-weight-600 text-gray-800">{{ $order->user ? $order->user->name : 'Guest' }}</span>
                                    </div>
                                </td>
                                <td class="font-weight-600 text-uppercase text-xs text-muted">
                                    <span class="px-2 py-1 bg-light border rounded">
                                        {{ $order->payment_method }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    @if ($order->status == 'completed')
                                        <span class="badge badge-pill badge-success font-weight-600 px-3 py-2 shadow-xs"><i class="fas fa-check-circle mr-1"></i>Selesai</span>
                                    @elseif ($order->status == 'pending')
                                        <span class="badge badge-pill badge-warning font-weight-600 px-3 py-2 shadow-xs"><i class="fas fa-clock mr-1"></i>Pending</span>
                                    @elseif ($order->status == 'processing')
                                        <span class="badge badge-pill badge-info font-weight-600 px-3 py-2 shadow-xs"><i class="fas fa-sync mr-1"></i>Diproses</span>
                                    @elseif ($order->status == 'cancelled')
                                        <span class="badge badge-pill badge-danger font-weight-600 px-3 py-2 shadow-xs"><i class="fas fa-times-circle mr-1"></i>Batal</span>
                                    @endif
                                </td>
                                <td class="text-center font-weight-600 text-dark">
                                    {{ $order->items->sum('qty') }} Pcs
                                </td>
                                <td class="text-right pr-4 font-weight-bold text-gray-900">
                                    Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <img src="https://illustrations.popsy.co/gray/active-search.svg" style="width: 150px;" class="mb-3 opacity-60">
                                    <h6 class="text-muted font-weight-600">Tidak ada transaksi ditemukan pada periode filter ini.</h6>
                                    <p class="text-xs text-muted mb-0">Silakan ubah rentang tanggal atau status filter Anda.</p>
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
    /* Premium Hover & Animation Effects */
    .hover-scale {
        transition: all 0.2s ease-in-out;
    }
    .hover-scale:hover {
        transform: scale(1.03);
    }
    .transition-all {
        transition: all 0.3s ease;
    }
    .hover-translate-y:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05) !important;
    }
    .hover-bg-light:hover {
        background-color: #F8FAFC;
    }
    .border-left-primary {
        border-left: 4px solid #4F46E5 !important;
    }
    .border-left-success {
        border-left: 4px solid #10B981 !important;
    }
    .border-left-info {
        border-left: 4px solid #06B6D4 !important;
    }
    .border-left-warning {
        border-left: 4px solid #F59E0B !important;
    }
    .bg-primary-light { background-color: rgba(79, 70, 229, 0.1); }
    .bg-success-light { background-color: rgba(16, 185, 129, 0.1); }
    .bg-warning-light { background-color: rgba(245, 158, 11, 0.1); }
    .bg-info-light { background-color: rgba(6, 182, 212, 0.1); }
    .bg-danger-light { background-color: rgba(239, 68, 68, 0.1); }
    .font-weight-500 { font-weight: 500; }
    .font-weight-600 { font-weight: 600; }
    .text-gray-800 { color: #1E293B; }
    .text-gray-900 { color: #0F172A; }
    .shadow-xs { box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05); }
    .rounded-lg { border-radius: 0.5rem !important; }
</style>
@endsection
