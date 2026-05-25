@extends('layout.template')

@section('content')
<div class="container py-5">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb bg-transparent p-0">
            <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Home</a></li>
            <li class="breadcrumb-item active">{{ $product->category->name }}</li>
        </ol>
    </nav>

    <div class="row">
        <!-- Product Image -->
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm rounded-lg overflow-hidden">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid w-100" style="object-fit: cover; min-height: 400px;">
                @else
                    <div class="bg-light d-flex align-items-center justify-content-center text-muted" style="min-height: 400px;">
                        <i class="fas fa-image fa-5x"></i>
                    </div>
                @endif
            </div>
        </div>

        <!-- Product Info -->
        <div class="col-md-6">
            <div class="pl-md-4">
                @if($product->is_new)
                    <span class="badge badge-success px-3 py-2 mb-3">PRODUK TERBARU</span>
                @endif
                
                <h1 class="font-weight-bold mb-2">{{ $product->name }}</h1>
                <p class="text-muted mb-4">Kategori: <span class="font-weight-bold">{{ $product->category->name }}</span></p>

                <div class="mb-4">
                    @if($product->promo_price)
                        <h4 class="text-muted mb-0" style="text-decoration: line-through;">Rp {{ number_format($product->price, 0, ',', '.') }}</h4>
                        <h2 class="text-primary font-weight-bold">Rp {{ number_format($product->promo_price, 0, ',', '.') }}</h2>
                    @else
                        <h2 class="text-primary font-weight-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</h2>
                    @endif
                </div>

                <div class="card border-0 bg-light p-4 mb-4 rounded-lg">
                    <h6 class="font-weight-bold mb-2">Informasi Produk</h6>
                    <div class="row">
                        <div class="col-6">
                            <small class="text-muted d-block">Ketersediaan Stok</small>
                            <span class="font-weight-bold {{ $product->stock > 0 ? 'text-success' : 'text-danger' }}">
                                {{ $product->stock > 0 ? $product->stock . ' Unit Ready' : 'Stok Habis' }}
                            </span>
                        </div>
                        <div class="col-6">
                            <small class="text-muted d-block">Kondisi</small>
                            <span class="font-weight-bold">Baru / Original</span>
                        </div>
                    </div>
                </div>

                <form action="{{ route('cart.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="row align-items-center no-gutters mb-4">
                        <div class="col-4 col-md-3">
                            <input type="number" name="qty" class="form-control text-center py-4 border-0 shadow-sm" value="1" min="1" max="{{ $product->stock }}">
                        </div>
                        <div class="col-8 col-md-9 pl-3">
                            <button type="submit" class="btn btn-primary btn-lg btn-block shadow-sm py-3 font-weight-bold" {{ $product->stock <= 0 ? 'disabled' : '' }}>
                                <i class="fas fa-cart-plus mr-2"></i> TAMBAH KE KERANJANG
                            </button>
                        </div>
                    </div>
                </form>

                <hr>

                <div class="mt-4">
                    <h5 class="font-weight-bold mb-3">Deskripsi Produk</h5>
                    <p class="text-muted" style="line-height: 1.8;">
                        {!! nl2br(e($product->description)) !!}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    @if(count($related_products) > 0)
    <div class="mt-5 pt-5">
        <h3 class="section-title">Produk Terkait</h3>
        <div class="row mt-4">
            @foreach($related_products as $rel)
            <div class="col-6 col-md-3 mb-4">
                <div class="card card-custom">
                    <a href="{{ route('product.show', $rel->slug) }}" class="text-decoration-none">
                        <img src="{{ $rel->image ? asset('storage/' . $rel->image) : 'https://via.placeholder.com/400x300?text='.$rel->name }}" class="card-img-top" alt="{{ $rel->name }}">
                        <div class="card-body card-body-custom">
                            <h5 class="card-title-custom text-truncate">{{ $rel->name }}</h5>
                            <p class="price-text mb-0">Rp {{ number_format($rel->promo_price ?? $rel->price, 0, ',', '.') }}</p>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
