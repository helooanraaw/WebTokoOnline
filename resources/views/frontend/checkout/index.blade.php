@extends('layout.template')

@section('content')
<div class="container py-5">
    <h2 class="font-weight-bold mb-4 text-dark text-display-md" style="letter-spacing: -0.5px;">Checkout</h2>

    @if(session('error'))
        <div class="alert alert-danger border-0 mb-4" style="border-radius: var(--radius-links); background-color: #ffeef0; color: #ff3b30;">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf
        <div class="row">
            <!-- Pengiriman Column -->
            <div class="col-lg-7">
                <div class="card card-white p-4 mb-4">
                    <h5 class="font-weight-bold mb-4 text-dark text-heading-lg"><i class="fas fa-truck mr-2 text-muted"></i> Informasi Pengiriman</h5>
                    
                    <div class="form-group">
                        <label class="font-weight-600 text-dark text-body">Nama Penerima</label>
                        <input type="text" class="form-control" value="{{ $user->name }}" readonly>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-600 text-dark text-body">Nomor Telepon</label>
                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                               value="{{ old('phone', $user->phone) }}" placeholder="08xxxxxxxxxx" required>
                        @error('phone') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label class="font-weight-600 text-dark text-body">Alamat Pengiriman Lengkap</label>
                        <textarea name="shipping_address" class="form-control @error('shipping_address') is-invalid @enderror" 
                                  rows="4" placeholder="Masukkan alamat lengkap pengiriman paket Anda..." required>{{ old('shipping_address', $user->address) }}</textarea>
                        @error('shipping_address') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group mb-0">
                        <label class="font-weight-600 text-dark text-body">Metode Pembayaran</label>
                        <select name="payment_method" class="form-control @error('payment_method') is-invalid @enderror" required>
                            <option value="">-- Pilih Cara Pembayaran --</option>
                            <option value="Transfer Bank">Transfer Bank (Verifikasi Manual)</option>
                            <option value="COD">Bayar di Tempat (COD / Cash on Delivery)</option>
                        </select>
                        @error('payment_method') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <!-- Ringkasan Column -->
            <div class="col-lg-5">
                <div class="card card-frost p-4 sticky-top" style="top: 100px;">
                    <h5 class="font-weight-bold mb-4 text-dark text-heading-lg"><i class="fas fa-shopping-bag mr-2 text-muted"></i> Ringkasan Pesanan</h5>
                    
                    <div class="mb-4">
                        @foreach($carts as $item)
                        @php $price = $item->product->promo_price ?? $item->product->price; @endphp
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex align-items-center">
                                <div class="rounded p-1 mr-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background-color: var(--color-canvas-white); border-radius: var(--radius-links) !important;">
                                    @if($item->product->image)
                                        <img src="{{ asset('storage/' . $item->product->image) }}" class="img-fluid" style="max-height: 100%; max-width: 100%; object-fit: contain;">
                                    @else
                                        <div class="w-100 h-100 d-flex align-items-center justify-content-center text-muted">
                                            <i class="fab fa-apple fa-lg"></i>
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <p class="mb-0 font-weight-bold text-dark text-truncate text-body" style="max-width: 160px;">{{ $item->product->name }}</p>
                                    <small class="text-muted text-caption">{{ $item->qty }} x Rp {{ number_format($price, 0, ',', '.') }}</small>
                                </div>
                            </div>
                            <span class="font-weight-bold text-dark text-body">Rp {{ number_format($price * $item->qty, 0, ',', '.') }}</span>
                        </div>
                        @endforeach
                    </div>

                    <hr class="my-3" style="border-top: 1px solid #d2d2d7;">
                    
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted text-body">Subtotal</span>
                        <span class="font-weight-bold text-dark text-body">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-4">
                        <span class="text-muted text-body">Pengiriman</span>
                        <span class="text-success font-weight-bold text-body">GRATIS</span>
                    </div>
                    
                    <hr class="my-2" style="border-top: 1px solid #d2d2d7;">
                    
                    <div class="d-flex justify-content-between mb-4">
                        <span class="font-weight-bold mb-0 text-dark text-body-lg">Total</span>
                        <span class="font-weight-bold mb-0 text-dark text-body-lg">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>

                    <button type="submit" class="btn-primary-filled btn-block py-2.5 font-weight-600 text-body text-center">
                        Konfirmasi Pesanan
                    </button>
                    
                    <div class="text-center mt-3">
                        <small class="text-muted text-caption">
                            <i class="fas fa-lock mr-1"></i> Pembayaran Terproteksi Aman
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
