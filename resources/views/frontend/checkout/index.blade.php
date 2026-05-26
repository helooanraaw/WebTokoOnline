@extends('layout.template')

@section('content')
<div class="container py-5">
    <h2 class="font-weight-bold mb-4 text-dark" style="letter-spacing: -0.5px;">Checkout</h2>

    @if(session('error'))
        <div class="alert alert-danger border-0 shadow-sm mb-4" style="border-radius: 12px;">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf
        <div class="row">
            <!-- Pengiriman Column -->
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm p-4 mb-4" style="border-radius: 18px; background: #ffffff;">
                    <h5 class="font-weight-bold mb-4 text-dark"><i class="fas fa-truck mr-2 text-muted"></i> Informasi Pengiriman</h5>
                    
                    <div class="form-group">
                        <label class="font-weight-600 text-dark">Nama Penerima</label>
                        <input type="text" class="form-control bg-light border-0 py-3 rounded-lg" style="height: 45px;" value="{{ $user->name }}" readonly>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-600 text-dark">Nomor Telepon</label>
                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror bg-light border-0 py-3 rounded-lg" style="height: 45px;"
                               value="{{ old('phone', $user->phone) }}" placeholder="08xxxxxxxxxx" required>
                        @error('phone') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label class="font-weight-600 text-dark">Alamat Pengiriman Lengkap</label>
                        <textarea name="shipping_address" class="form-control @error('shipping_address') is-invalid @enderror bg-light border-0 rounded-lg" 
                                  rows="4" placeholder="Masukkan alamat lengkap pengiriman paket Anda..." required>{{ old('shipping_address', $user->address) }}</textarea>
                        @error('shipping_address') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group mb-0">
                        <label class="font-weight-600 text-dark">Metode Pembayaran</label>
                        <select name="payment_method" class="form-control @error('payment_method') is-invalid @enderror bg-light border-0 rounded-lg custom-select" style="height: 45px;" required>
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
                <div class="card border-0 shadow-sm p-4 sticky-top" style="top: 100px; border-radius: 18px; background: #ffffff;">
                    <h5 class="font-weight-bold mb-4 text-dark"><i class="fas fa-shopping-bag mr-2 text-muted"></i> Ringkasan Pesanan</h5>
                    
                    <div class="mb-4">
                        @foreach($carts as $item)
                        @php $price = $item->product->promo_price ?? $item->product->price; @endphp
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-light rounded p-1 mr-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                    @if($item->product->image)
                                        <img src="{{ asset('storage/' . $item->product->image) }}" class="img-fluid" style="max-height: 100%; max-width: 100%; object-fit: contain;">
                                    @else
                                        <div class="w-100 h-100 d-flex align-items-center justify-content-center text-muted">
                                            <i class="fas fa-image fa-sm"></i>
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <p class="mb-0 font-weight-bold text-dark text-truncate" style="max-width: 160px;">{{ $item->product->name }}</p>
                                    <small class="text-muted">{{ $item->qty }} x Rp {{ number_format($price, 0, ',', '.') }}</small>
                                </div>
                            </div>
                            <span class="font-weight-bold text-dark">Rp {{ number_format($price * $item->qty, 0, ',', '.') }}</span>
                        </div>
                        @endforeach
                    </div>

                    <hr class="my-3">
                    
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Subtotal</span>
                        <span class="font-weight-bold text-dark">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-4">
                        <span class="text-muted">Pengiriman</span>
                        <span class="text-success font-weight-bold">GRATIS</span>
                    </div>
                    
                    <hr class="my-2">
                    
                    <div class="d-flex justify-content-between mb-4">
                        <span class="h6 font-weight-bold mb-0 text-dark">Total</span>
                        <span class="h5 font-weight-bold mb-0 text-dark">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>

                    <button type="submit" class="btn btn-pill-dark btn-lg btn-block font-weight-600 shadow-sm py-2.5">
                        Konfirmasi Pesanan
                    </button>
                    
                    <div class="text-center mt-3">
                        <small class="text-muted">
                            <i class="fas fa-lock mr-1"></i> Pembayaran Terproteksi Aman
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
