<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function history()
    {
        $orders = Order::with('items.product')
                    ->where('user_id', Auth::id())
                    ->latest()
                    ->get();

        $data = [
            'title' => 'Riwayat Pesanan',
            'orders' => $orders,
            'categories' => \App\Models\Category::all(),
        ];

        return view('frontend.orders.history', $data);
    }
}
