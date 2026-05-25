<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // Default filter ke bulan ini jika tidak ditentukan
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->input('end_date', Carbon::now()->endOfMonth()->format('Y-m-d'));
        $status = $request->input('status');

        $query = Order::with(['user', 'items'])
            ->whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate);

        if ($status) {
            $query->where('status', $status);
        }

        $orders = $query->latest()->get();

        // Hitung statistik
        $totalOrders = $orders->count();
        $totalRevenue = $orders->where('status', 'completed')->sum('total_amount');
        $totalPending = $orders->where('status', 'pending')->sum('total_amount');
        $totalProcessing = $orders->where('status', 'processing')->sum('total_amount');
        $totalCancelled = $orders->where('status', 'cancelled')->sum('total_amount');
        
        $totalSalesFiltered = $orders->sum('total_amount');
        $averageOrderValue = $totalOrders > 0 ? $totalSalesFiltered / $totalOrders : 0;
        
        $totalItemsSold = $orders->sum(function ($order) {
            return $order->items->sum('qty');
        });

        return view('admin.reports.index', compact(
            'orders',
            'startDate',
            'endDate',
            'status',
            'totalOrders',
            'totalRevenue',
            'totalPending',
            'totalProcessing',
            'totalCancelled',
            'totalSalesFiltered',
            'averageOrderValue',
            'totalItemsSold'
        ));
    }

    public function exportCsv(Request $request)
    {
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->input('end_date', Carbon::now()->endOfMonth()->format('Y-m-d'));
        $status = $request->input('status');

        $query = Order::with(['user', 'items'])
            ->whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate);

        if ($status) {
            $query->where('status', $status);
        }

        $orders = $query->latest()->get();

        $filename = "Laporan_Penjualan_{$startDate}_ke_{$endDate}.csv";

        $headers = [
            "Content-type"        => "text/csv; charset=UTF-8",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = [
            'Invoice', 
            'Tanggal', 
            'Pelanggan', 
            'Metode Pembayaran', 
            'Status', 
            'Jumlah Barang', 
            'Total Belanja (Rp)'
        ];

        $callback = function() use($orders, $columns) {
            $file = fopen('php://output', 'w');
            
            // Tambahkan BOM UTF-8 agar file terbuka dengan benar di Excel (support karakter UTF-8)
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            fputcsv($file, $columns, ';');

            foreach ($orders as $order) {
                $totalQty = $order->items->sum('qty');
                
                fputcsv($file, [
                    $order->invoice_number,
                    $order->created_at->format('d-m-Y H:i'),
                    $order->user ? $order->user->name : 'Guest',
                    strtoupper($order->payment_method),
                    ucfirst($order->status),
                    $totalQty,
                    $order->total_amount
                ], ';');
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function printReport(Request $request)
    {
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->input('end_date', Carbon::now()->endOfMonth()->format('Y-m-d'));
        $status = $request->input('status');

        $query = Order::with(['user', 'items'])
            ->whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate);

        if ($status) {
            $query->where('status', $status);
        }

        $orders = $query->latest()->get();

        // Hitung statistik ringkas untuk dicetak
        $totalOrders = $orders->count();
        $totalRevenue = $orders->where('status', 'completed')->sum('total_amount');
        $totalSalesFiltered = $orders->sum('total_amount');
        
        $totalItemsSold = $orders->sum(function ($order) {
            return $order->items->sum('qty');
        });

        return view('admin.reports.print', compact(
            'orders',
            'startDate',
            'endDate',
            'status',
            'totalOrders',
            'totalRevenue',
            'totalSalesFiltered',
            'totalItemsSold'
        ));
    }
}
