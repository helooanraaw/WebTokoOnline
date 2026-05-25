<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'products_count' => Product::count(),
            'categories_count' => Category::count(),
            'orders_count' => Order::count(),
            'customers_count' => User::where('role', 'customer')->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
