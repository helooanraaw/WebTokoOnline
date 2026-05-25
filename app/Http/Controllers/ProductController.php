<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($slug)
    {
        $product = Product::with('category')->where('slug', $slug)->firstOrFail();
        
        // Ambil produk terkait (satu kategori, tapi bukan produk yang sedang dilihat)
        $related_products = Product::where('category_id', $product->category_id)
                                    ->where('id', '!=', $product->id)
                                    ->limit(4)
                                    ->get();

        $data = [
            'title' => $product->name,
            'product' => $product,
            'related_products' => $related_products,
            'categories' => Category::all(),
        ];

        return view('frontend.products.show', $data);
    }
}
