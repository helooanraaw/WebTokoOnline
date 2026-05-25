@extends('layout.template')

@section('content')
<div class="container py-5">
    <h2 class="font-weight-bold mb-4">Checkout</h2>

    @if(session('error'))
        <div class="alert alert-danger border-0 shadow-sm mb-4">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf
        <div class="row">
            <!-- Informasi Pengiriman -->
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm rounded-lg p-4 mb-4">
                    <h5 class="font-weight-bold mb-4">Informasi Pengiriman</h5>
                    
                    <div class="form-group">
                        <label class="font-weight-bold">Nama Lengkap</label>
                        <input type="text" class="form-control bg-light border-0" value="{{ $user->name }}" readonly>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Nomor Telepon</label>
                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" 
                               value="{{ old('phone', $user->phone) }}" placeholder="08xxxxx" required>
                        @error('phone') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Alamat Lengkap</label>
                        <textarea name="shipping_address" class="form-control @error('shipping_address') is-invalid @enderror" 
                                  rows="4" placeholder="Alamat pengiriman lengkap..." required>{{ old('shipping_address', $user->address) }}</textarea>
                        @error('shipping_address') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group mb-0">
                        <label class="font-weight-bold">Metode Pembayaran</label>
                        <select name="payment_method" class="form-control @error('payment_method') is-invalid @enderror" required>
                            <option value="">-- Pilih Pembayaran --</option>
                            <option value="Transfer Bank">Transfer Bank (Manual)</option>
                            <option value="COD">Bayar di Tempat (COD)</option>
                        </select>
                        @error('payment_method') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <!-- Ringkasan Pesanan -->
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm rounded-lg p-4 sticky-top" style="top: 100px;">
                    <h5 class="font-weight-bold mb-4">Ringkasan Pesanan</h5>
                    
                    <div class="mb-4">
                        @foreach($carts as $item)
                        @php $price = $item->product->promo_price ?? $item->product->price; @endphp
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-light rounded mr-2" style="width: 50px; height: 50px; overflow: hidden;">
                                    @if($item->product->image)
                                        <img src="{{ asset('storage/' . $item->product->image) }}" class="img-fluid" style="object-fit: cover; height: 100%;">
                                    @else
                                        <div class="w-100 h-100 d-flex align-items-center justify-content-center text-muted">
                                            <i class="fas fa-image fa-sm"></i>
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <p class="mb-0 font-weight-bold text-truncate" style="max-width: 150px;">{{ $item->product->name }}</p>
                                    <small class="text-muted">{{ $item->qty }} x Rp {{ number_format($price, 0, ',', '.') }}</small>
                                </div>
                            </div>
                            <span class="font-weight-bold">Rp {{ number_format($price * $item->qty, 0, ',', '.') }}</span>
                        </div>
                        @endforeach
                    </div>

                    <hr>
                    
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Subtotal</span>
                        <span class="font-weight-bold">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-4">
                        <span class="text-muted">Ongkos Kirim</span>
                        <span class="text-success font-weight-bold">GRATIS</span>
                    </div>
                    
                    <div class="d-flex justify-content-between mb-4">
                        <span class="h5 font-weight-bold mb-0">Total</span>
                        <span class="h5 font-weight-bold mb-0 text-primary">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg btn-block shadow-sm py-3 font-weight-bold">
                        BUAT PESANAN SEKARANG
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
