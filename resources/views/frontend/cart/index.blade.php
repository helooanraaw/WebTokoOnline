@extends('layout.template')

@section('content')
<div class="container py-5">
    <h2 class="font-weight-bold mb-4 text-dark text-display-md" style="letter-spacing: -0.5px;">Bag Belanja Anda</h2>

    @if(session('success'))
        <div class="alert alert-success border-0 mb-4" style="border-radius: var(--radius-links); background-color: var(--color-surface-frost); color: var(--color-text-primary);">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger border-0 mb-4" style="border-radius: var(--radius-links); background-color: #ffeef0; color: #ff3b30;">
            {{ session('error') }}
        </div>
    @endif

    <div class="row">
        <div class="col-lg-8">
            <div class="card card-white mb-4">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 align-middle">
                            <thead style="background-color: var(--color-surface-frost); font-size: 12px; text-transform: uppercase;">
                                <tr>
                                    <th class="border-0 pl-4 py-3 text-muted">Produk</th>
                                    <th class="border-0 text-center py-3 text-muted">Harga</th>
                                    <th class="border-0 text-center py-3 text-muted">Jumlah</th>
                                    <th class="border-0 text-center py-3 text-muted">Subtotal</th>
                                    <th class="border-0 py-3"></th>
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
                                                <div class="rounded p-2 mr-3 d-flex align-items-center justify-content-center" style="width: 70px; height: 70px; background-color: var(--color-surface-frost); border-radius: var(--radius-links) !important;">
                                                    <img src="{{ asset('storage/' . $item->product->image) }}" class="img-fluid" style="max-height: 100%; max-width: 100%; object-fit: contain;">
                                                </div>
                                            @else
                                                <div class="rounded mr-3 d-flex align-items-center justify-content-center text-muted" style="width: 70px; height: 70px; background-color: var(--color-surface-frost); border-radius: var(--radius-links) !important;">
                                                    <i class="fas fa-image fa-lg"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <h6 class="font-weight-bold mb-0 text-dark text-body-lg">{{ $item->product->name }}</h6>
                                                <small class="text-muted text-caption">{{ $item->product->category->name }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center py-4 align-middle font-weight-bold text-dark text-body">
                                        Rp {{ number_format($price, 0, ',', '.') }}
                                    </td>
                                    <td class="text-center py-4 align-middle" style="width: 150px;">
                                        <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="input-group input-group-sm mx-auto" style="width: 80px;">
                                                <input type="number" name="qty" class="form-control text-center border-0 bg-light font-weight-600" style="border-radius: var(--radius-links) !important; height: 32px;" value="{{ $item->qty }}" min="1" onchange="this.form.submit()">
                                            </div>
                                        </form>
                                    </td>
                                    <td class="text-center py-4 align-middle font-weight-bold text-dark text-body">
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
                                        <i class="fas fa-shopping-bag fa-3x mb-3 d-block text-muted" style="opacity: 0.5;"></i>
                                        Keranjang belanja kamu masih kosong. <br>
                                        <a href="{{ route('homepage') }}" class="btn-primary-filled btn-sm mt-3 px-4">Mulai Belanja</a>
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
            <div class="card card-frost p-4" style="border-radius: var(--radius-cards);">
                <h5 class="font-weight-bold mb-4 text-dark text-heading-lg">Ringkasan Belanja</h5>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted text-body">Total Harga ({{ count($carts) }} barang)</span>
                    <span class="font-weight-bold text-dark text-body">Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>
                <div class="d-flex justify-content-between mb-4">
                    <span class="text-muted text-body">Biaya Pengiriman</span>
                    <span class="text-success font-weight-bold text-body">GRATIS</span>
                </div>
                <hr class="my-3" style="border-top: 1px solid #d2d2d7;">
                <div class="d-flex justify-content-between mb-4">
                    <span class="font-weight-bold mb-0 text-dark text-body-lg">Total Tagihan</span>
                    <span class="font-weight-bold mb-0 text-dark text-body-lg">Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>
                <a href="{{ route('checkout.index') }}" class="btn-primary-filled btn-block font-weight-600 py-2.5 text-body text-center">
                    Lanjut ke Checkout
                </a>
                <small class="text-muted text-center d-block mt-3 text-caption">
                    <i class="fas fa-shield-alt mr-1"></i> Transaksi Aman & Terenkripsi
                </small>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
