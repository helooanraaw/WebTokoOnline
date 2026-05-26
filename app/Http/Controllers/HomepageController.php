<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class HomepageController extends Controller
{
    public function index(Request $request)
    {
        // Ambil kategori untuk menu/filter
        $categories = Category::all();
        $selectedCategorySlug = $request->query('category');

        $selectedCategory = null;
        $filtered_products = collect();

        if ($selectedCategorySlug) {
            $selectedCategory = Category::where('slug', $selectedCategorySlug)->firstOrFail();
            $filtered_products = Product::where('category_id', $selectedCategory->id)->latest()->get();
        }

        // Ambil produk berdasarkan kategori masing-masing
        $iphoneProCat = Category::where('slug', 'iphone-pro')->first();
        $iphoneCat = Category::where('slug', 'iphone')->first();
        $accessoriesCat = Category::where('slug', 'aksesoris')->first();

        $iphone_pro_products = $iphoneProCat ? Product::where('category_id', $iphoneProCat->id)->get() : collect();
        $iphone_products = $iphoneCat ? Product::where('category_id', $iphoneCat->id)->get() : collect();
        $accessory_products = $accessoriesCat ? Product::where('category_id', $accessoriesCat->id)->get() : collect();

        // Ambil produk promo (yang punya harga promo)
        $promo_products = Product::whereNotNull('promo_price')
                                ->limit(4)
                                ->get();

        $data = [
            'title' => 'PakPras Store - Apple Authorized Reseller',
            'categories' => $categories,
            'selectedCategory' => $selectedCategory,
            'filtered_products' => $filtered_products,
            'iphone_pro_products' => $iphone_pro_products,
            'iphone_products' => $iphone_products,
            'accessory_products' => $accessory_products,
            'promo_products' => $promo_products,
        ];

        return view('homepage.index', $data);
    }
}
