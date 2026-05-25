<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class HomepageController extends Controller
{
    public function index()
    {
        // Ambil kategori untuk menu/filter
        $categories = Category::all();

        // Ambil produk promo (yang punya harga promo)
        $promo_products = Product::whereNotNull('promo_price')
                                ->limit(4)
                                ->get();

        // Ambil produk terbaru
        $latest_products = Product::where('is_new', true)
                                ->latest()
                                ->limit(8)
                                ->get();

        $data = [
            'title' => 'Toko Online Pak Pras',
            'categories' => $categories,
            'promo_products' => $promo_products,
            'latest_products' => $latest_products,
        ];

        return view('homepage.index', $data);
    }
}
