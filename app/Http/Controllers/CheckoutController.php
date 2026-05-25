<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $carts = Cart::with('product')->where('user_id', $user->id)->get();

        if ($carts->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang belanja kosong.');
        }

        $total = 0;
        foreach ($carts as $item) {
            $price = $item->product->promo_price ?? $item->product->price;
            $total += $price * $item->qty;
        }

        $data = [
            'title' => 'Checkout',
            'user' => $user,
            'carts' => $carts,
            'total' => $total,
            'categories' => \App\Models\Category::all(),
        ];

        return view('frontend.checkout.index', $data);
    }

    public function process(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string',
            'payment_method' => 'required|string',
            'phone' => 'required|string',
        ]);

        $user = Auth::user();
        $carts = Cart::with('product')->where('user_id', $user->id)->get();

        if ($carts->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang belanja kosong.');
        }

        // Hitung Total
        $total = 0;
        foreach ($carts as $item) {
            $price = $item->product->promo_price ?? $item->product->price;
            $total += $price * $item->qty;
            
            // Cek stok lagi sebelum proses
            if ($item->product->stock < $item->qty) {
                return back()->with('error', "Maaf, stok {$item->product->name} tidak mencukupi.");
            }
        }

        try {
            DB::beginTransaction();

            // 1. Buat Data Order
            $order = Order::create([
                'user_id' => $user->id,
                'invoice_number' => 'INV-' . strtoupper(Str::random(10)),
                'total_amount' => $total,
                'status' => 'pending',
                'shipping_address' => $request->shipping_address,
                'payment_method' => $request->payment_method,
            ]);

            // 2. Pindahkan item dari cart ke order_items & Kurangi Stok
            foreach ($carts as $item) {
                $price = $item->product->promo_price ?? $item->product->price;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'product_name' => $item->product->name,
                    'price' => $price,
                    'qty' => $item->qty,
                ]);

                // Kurangi Stok
                $product = Product::find($item->product_id);
                $product->decrement('stock', $item->qty);
            }

            // 3. Kosongkan Keranjang
            Cart::where('user_id', $user->id)->delete();

            DB::commit();

            return redirect()->route('order.history')->with('success', 'Pesanan berhasil dibuat! Silakan tunggu konfirmasi admin.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
