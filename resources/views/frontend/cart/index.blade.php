@extends('layout.template')

@section('content')
<div class="container py-5">
    <h2 class="font-weight-bold mb-4">Keranjang Belanja</h2>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger border-0 shadow-sm mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-lg overflow-hidden mb-4">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="border-0 pl-4">Produk</th>
                                    <th class="border-0 text-center">Harga</th>
                                    <th class="border-0 text-center">Jumlah</th>
                                    <th class="border-0 text-center">Subtotal</th>
                                    <th class="border-0"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($carts as $item)
                                @php
                                    $price = $item->product->promo_price ?? $item->product->price;
                                    $subtotal = $price * $item->qty;
                                @endphp
                                <tr>
                                    <td class="pl-4 py-4 align-middle">
                                        <div class="d-flex align-items-center">
                                            @if($item->product->image)
                                                <img src="{{ asset('storage/' . $item->product->image) }}" class="rounded shadow-sm mr-3" style="width: 70px; height: 70px; object-fit: cover;">
                                            @else
                                                <div class="bg-light rounded mr-3 d-flex align-items-center justify-content-center text-muted" style="width: 70px; height: 70px;">
                                                    <i class="fas fa-image fa-lg"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <h6 class="font-weight-bold mb-0">{{ $item->product->name }}</h6>
                                                <small class="text-muted">{{ $item->product->category->name }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center py-4 align-middle font-weight-bold">
                                        Rp {{ number_format($price, 0, ',', '.') }}
                                    </td>
                                    <td class="text-center py-4 align-middle" style="width: 150px;">
                                        <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="input-group input-group-sm mx-auto" style="width: 100px;">
                                                <input type="number" name="qty" class="form-control text-center border-0 bg-light" value="{{ $item->qty }}" min="1" onchange="this.form.submit()">
                                            </div>
                                        </form>
                                    </td>
                                    <td class="text-center py-4 align-middle font-weight-bold text-primary">
                                        Rp {{ number_format($subtotal, 0, ',', '.') }}
                                    </td>
                                    <td class="pr-4 py-4 align-middle text-right">
                                        <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger border-0 rounded-circle" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">
                                        <i class="fas fa-shopping-cart fa-3x mb-3 d-block"></i>
                                        Keranjang kamu masih kosong. <br>
                                        <a href="{{ route('homepage') }}" class="btn btn-primary btn-sm mt-3 px-4 shadow-sm">Mulai Belanja</a>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @if(count($carts) > 0)
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-lg p-4">
                <h5 class="font-weight-bold mb-4">Ringkasan Belanja</h5>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Total Harga ({{ count($carts) }} barang)</span>
                    <span class="font-weight-bold">Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>
                <div class="d-flex justify-content-between mb-4">
                    <span class="text-muted">Biaya Pengiriman</span>
                    <span class="text-success font-weight-bold">GRATIS</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between mb-4">
                    <span class="h5 font-weight-bold mb-0">Total Tagihan</span>
                    <span class="h5 font-weight-bold mb-0 text-primary">Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>
                <a href="{{ route('checkout.index') }}" class="btn btn-primary btn-lg btn-block shadow-sm">
                    Lanjut ke Checkout <i class="fas fa-arrow-right ml-2"></i>
                </a>
                <small class="text-muted text-center d-block mt-3">
                    <i class="fas fa-shield-alt mr-1"></i> Transaksi Aman & Terenkripsi
                </small>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
