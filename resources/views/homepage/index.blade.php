@extends('layout.template')

@section('content')
<div class="container">
    <!-- Hero Section / Carousel -->
    <div id="carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://images.unsplash.com/photo-1441986300917-64674bd600d8?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" class="d-block w-100" alt="Slide 1">
                <div class="carousel-caption d-none d-md-block" style="background: rgba(0,0,0,0.5); border-radius: 15px;">
                    <h2 class="font-weight-bold">Selamat Datang di PakPras Store</h2>
                    <p>Temukan produk terbaik dengan harga yang bersahabat untuk kantong siswa.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" class="d-block w-100" alt="Slide 2">
                <div class="carousel-caption d-none d-md-block" style="background: rgba(0,0,0,0.5); border-radius: 15px;">
                    <h2 class="font-weight-bold">Promo Spesial Elektronik</h2>
                    <p>Dapatkan diskon hingga 50% untuk gadget pilihan kamu.</p>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon"></span>
        </a>
    </div>

    <!-- Promo Products -->
    @if(count($promo_products) > 0)
    <div class="mb-5">
        <h3 class="section-title">Promo Hari Ini</h3>
        <div class="row mt-4">
            @foreach($promo_products as $product)
            <div class="col-6 col-md-3 mb-4">
                <div class="card card-custom">
                    <a href="{{ route('product.show', $product->slug) }}" class="text-decoration-none">
                        <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/400x300?text='.$product->name }}" class="card-img-top" alt="{{ $product->name }}">
                    </a>
                    <div class="card-body card-body-custom">
                        <span class="badge badge-danger mb-2">PROMO</span>
                        <a href="{{ route('product.show', $product->slug) }}" class="text-decoration-none text-dark">
                            <h5 class="card-title-custom text-truncate">{{ $product->name }}</h5>
                        </a>
                        <p class="mb-3">
                            <span class="price-strike">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            <span class="price-text">Rp {{ number_format($product->promo_price, 0, ',', '.') }}</span>
                        </p>
                        <form action="{{ route('cart.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="qty" value="1">
                            <button type="submit" class="btn btn-custom btn-block">
                                <i class="fas fa-cart-plus mr-1"></i> Beli
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Latest Products -->
    <div class="mb-5">
        <h3 class="section-title">Produk Terbaru</h3>
        <div class="row mt-4">
            @foreach($latest_products as $product)
            <div class="col-6 col-md-3 mb-4">
                <div class="card card-custom">
                    <a href="{{ route('product.show', $product->slug) }}" class="text-decoration-none">
                        <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/400x300?text='.$product->name }}" class="card-img-top" alt="{{ $product->name }}">
                    </a>
                    <div class="card-body card-body-custom">
                        @if($product->is_new)
                        <span class="badge badge-success mb-2">BARU</span>
                        @endif
                        <a href="{{ route('product.show', $product->slug) }}" class="text-decoration-none text-dark">
                            <h5 class="card-title-custom text-truncate">{{ $product->name }}</h5>
                        </a>
                        <p class="mb-3">
                            @if($product->promo_price)
                                <span class="price-strike">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                <span class="price-text">Rp {{ number_format($product->promo_price, 0, ',', '.') }}</span>
                            @else
                                <span class="price-text">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            @endif
                        </p>
                        <form action="{{ route('cart.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="qty" value="1">
                            <button type="submit" class="btn btn-custom btn-block">
                                <i class="fas fa-cart-plus mr-1"></i> Beli
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
