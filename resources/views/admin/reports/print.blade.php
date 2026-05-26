<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan - iStore PakPras</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            color: #333;
            background-color: #fff;
            padding: 20px;
        }
        .header-print {
            border-bottom: 3px double #333;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .company-name {
            font-size: 28px;
            font-weight: 700;
            letter-spacing: 0.5px;
            color: #1d1d1f;
        }
        .report-title {
            font-size: 20px;
            font-weight: 600;
            color: #1E293B;
            margin-top: 5px;
        }
        .meta-info {
            font-size: 13px;
            color: #64748B;
        }
        .summary-card {
            border: 1px solid #E2E8F0;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 25px;
            background-color: #F8FAFC;
        }
        .summary-title {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            color: #64748B;
            margin-bottom: 5px;
        }
        .summary-value {
            font-size: 18px;
            font-weight: 700;
            color: #0F172A;
        }
        .table-print {
            font-size: 13px;
        }
        .table-print th {
            background-color: #F1F5F9 !important;
            color: #475569;
            font-weight: 600;
            border-bottom: 2px solid #CBD5E1 !important;
        }
        .table-print td {
            vertical-align: middle !important;
            border-bottom: 1px solid #E2E8F0;
        }
        .status-badge {
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            padding: 2px 8px;
            border-radius: 4px;
            display: inline-block;
        }
        .status-completed { background-color: #DCFCE7; color: #15803D; }
        .status-pending { background-color: #FEF3C7; color: #92400E; }
        .status-processing { background-color: #CFFAFE; color: #0E7490; }
        .status-cancelled { background-color: #FEE2E2; color: #B91C1C; }
        
        @media print {
            body {
                padding: 0;
                margin: 0;
            }
            .no-print {
                display: none !important;
            }
            .summary-card {
                background-color: #F8FAFC !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            .table-print th {
                background-color: #F1F5F9 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            .status-completed {
                background-color: #DCFCE7 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            .status-pending {
                background-color: #FEF3C7 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            .status-processing {
                background-color: #CFFAFE !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            .status-cancelled {
                background-color: #FEE2E2 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
</head>
<body>

    <!-- Header Section -->
    <div class="header-print d-flex justify-content-between align-items-end">
        <div>
            <div class="company-name">iStore PakPras</div>
            <div class="report-title">LAPORAN PENJUALAN</div>
            <div class="meta-info">
                Periode: <strong>{{ \Carbon\Carbon::parse($startDate)->format('d/m/Y') }}</strong> s.d. <strong>{{ \Carbon\Carbon::parse($endDate)->format('d/m/Y') }}</strong>
                @if($status)
                    | Status: <strong class="text-uppercase">{{ $status }}</strong>
                @endif
            </div>
        </div>
        <div class="text-right meta-info">
            <div>Dicetak Oleh: Admin</div>
            <div>Tanggal Cetak: {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}</div>
            <button onclick="window.print()" class="btn btn-sm btn-dark mt-2 no-print">
                <i class="fas fa-print mr-1"></i> Cetak Kembali
            </button>
        </div>
    </div>

    <!-- Summary Widgets Row -->
    <div class="row">
        <div class="col-4">
            <div class="summary-card">
                <div class="summary-title">Omzet Selesai (Completed)</div>
                <div class="summary-value">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
            </div>
        </div>
        <div class="col-4">
            <div class="summary-card">
                <div class="summary-title">Total Nilai Terfilter</div>
                <div class="summary-value">Rp {{ number_format($totalSalesFiltered, 0, ',', '.') }}</div>
            </div>
        </div>
        <div class="col-2">
            <div class="summary-card">
                <div class="summary-title">Total Pesanan</div>
                <div class="summary-value">{{ $totalOrders }}</div>
            </div>
        </div>
        <div class="col-2">
            <div class="summary-card">
                <div class="summary-title">Barang Terjual</div>
                <div class="summary-value">{{ $totalItemsSold }}</div>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <table class="table table-bordered table-print">
        <thead>
            <tr>
                <th style="width: 15%">Invoice</th>
                <th style="width: 15%">Tanggal</th>
                <th style="width: 20%">Pelanggan</th>
                <th style="width: 15%">Metode Bayar</th>
                <th style="width: 10%" class="text-center">Status</th>
                <th style="width: 10%" class="text-center">Barang</th>
                <th style="width: 15%" class="text-right">Total Belanja</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($orders as $order)
                <tr>
                    <td class="font-weight-bold">{{ $order->invoice_number }}</td>
                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                    <td>{{ $order->user ? $order->user->name : 'Guest' }}</td>
                    <td class="text-uppercase">{{ $order->payment_method }}</td>
                    <td class="text-center">
                        <span class="status-badge status-{{ $order->status }}">
                            {{ $order->status }}
                        </span>
                    </td>
                    <td class="text-center">{{ $order->items->sum('qty') }} Pcs</td>
                    <td class="text-right font-weight-bold">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center py-4">Tidak ada data transaksi.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <script>
        // Otomatis membuka dialog cetak bawaan browser setelah halaman termuat sepenuhnya
        window.onload = function() {
            setTimeout(function() {
                window.print();
            }, 500);
        };
    </script>
</body>
</html>
