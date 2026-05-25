<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $carts = Cart::with('product')->where('user_id', Auth::id())->get();
        $total = 0;
        foreach ($carts as $item) {
            $price = $item->product->promo_price ?? $item->product->price;
            $total += $price * $item->qty;
        }

        $data = [
            'title' => 'Keranjang Belanja',
            'carts' => $carts,
            'total' => $total,
            'categories' => \App\Models\Category::all(), // Untuk navbar
        ];

        return view('frontend.cart.index', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($request->product_id);

        // Cek stok
        if ($product->stock < $request->qty) {
            return back()->with('error', 'Stok tidak mencukupi.');
        }

        // Cek apakah produk sudah ada di keranjang
        $cart = Cart::where('user_id', Auth::id())
                    ->where('product_id', $request->product_id)
                    ->first();

        if ($cart) {
            // Update qty
            $new_qty = $cart->qty + $request->qty;
            if ($product->stock < $new_qty) {
                return back()->with('error', 'Total di keranjang melebihi stok tersedia.');
            }
            $cart->update(['qty' => $new_qty]);
        } else {
            // Create baru
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'qty' => $request->qty
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function update(Request $request, $id)
    {
        $cart = Cart::where('user_id', Auth::id())->findOrFail($id);
        $product = Product::findOrFail($cart->product_id);

        $request->validate([
            'qty' => 'required|integer|min:1'
        ]);

        if ($product->stock < $request->qty) {
            return back()->with('error', 'Stok tidak mencukupi untuk jumlah tersebut.');
        }

        $cart->update(['qty' => $request->qty]);

        return back()->with('success', 'Keranjang berhasil diupdate!');
    }

    public function destroy($id)
    {
        $cart = Cart::where('user_id', Auth::id())->findOrFail($id);
        $cart->delete();

        return back()->with('success', 'Produk dihapus dari keranjang.');
    }
}
