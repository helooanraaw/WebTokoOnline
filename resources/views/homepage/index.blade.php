@extends('layout.template')

@section('content')
<!-- Hero Section (Apple Style) -->
@if(!$selectedCategory)
<div class="hero-section text-center mb-5 text-white position-relative" style="background: #000000; padding: 4rem 1rem 0; overflow: hidden; min-height: 550px;">
    <div class="container py-4">
        <h3 class="text-uppercase tracking-wide text-muted font-weight-bold mb-2" style="font-size: 0.9rem; letter-spacing: 2px; color: #86868b !important;">Terbaru</h3>
        <h1 class="display-4 font-weight-bold text-white mb-2" style="letter-spacing: -1px; line-height: 1.1;">iPhone 15 Pro Max</h1>
        <p class="h5 font-weight-normal text-muted mb-4" style="color: #86868b !important;">Titanium. Sangat kuat. Sangat ringan. Sangat Pro.</p>
        <div class="d-flex justify-content-center gap-3 mb-4">
            <a href="{{ route('product.show', 'iphone-15-pro-max') }}" class="btn btn-custom px-4 py-2 font-weight-600 rounded-pill shadow-sm">Beli Sekarang</a>
            <a href="#pro-section" class="btn btn-link text-primary font-weight-600 ml-3">Selengkapnya <i class="fas fa-chevron-right ml-1" style="font-size: 0.8rem;"></i></a>
        </div>
        <div class="mt-4 d-flex justify-content-center">
            <img src="{{ asset('storage/products/iphone_15_pro_max.jpg') }}" class="img-fluid" style="max-height: 380px; object-fit: contain; transform: translateY(20px); transition: transform 0.5s ease;" alt="iPhone 15 Pro Max">
        </div>
    </div>
</div>
@endif

<div class="container">
    @if($selectedCategory)
        <!-- Filtered View Header -->
        <div class="mb-5 text-center mt-5 pt-3">
            <h1 class="display-4 font-weight-bold">{{ $selectedCategory->name }}</h1>
            <p class="text-muted">Temukan model {{ $selectedCategory->name }} terbaik yang cocok untuk Anda.</p>
            <a href="{{ route('homepage') }}" class="btn btn-link text-primary font-weight-500"><i class="fas fa-arrow-left mr-2"></i> Kembali ke Beranda</a>
        </div>

        <!-- Filtered Products Grid -->
        <div class="row">
            @forelse($filtered_products as $product)
            <div class="col-6 col-md-4 mb-4">
                <div class="card card-custom">
                    <div class="img-wrapper">
                        <a href="{{ route('product.show', $product->slug) }}">
                            <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/400x300?text='.$product->name }}" alt="{{ $product->name }}">
                        </a>
                    </div>
                    <div class="card-body card-body-custom">
                        <div>
                            @if($product->is_new)
                            <span class="badge badge-primary px-2.5 py-1 mb-2 font-weight-500 rounded-pill" style="font-size: 0.7rem; background-color: var(--primary);">Baru</span>
                            @endif
                            <a href="{{ route('product.show', $product->slug) }}" class="text-decoration-none text-dark">
                                <h5 class="card-title-custom mb-1">{{ $product->name }}</h5>
                            </a>
                            <p class="small text-muted text-truncate mb-3">{{ $product->description }}</p>
                        </div>
                        <div>
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
                                <button type="submit" class="btn btn-custom btn-block font-weight-500">
                                    <i class="fas fa-shopping-cart mr-1"></i> Beli
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted">Tidak ada produk ditemukan di kategori ini.</p>
            </div>
            @endforelse
        </div>

    @else
        <!-- Standard Homepage: Apple Store Sections -->

        <!-- Promo Banner (Interactive) -->
        <div class="promo-bar bg-white rounded-lg p-4 shadow-sm border mb-5 d-flex flex-column flex-md-row justify-content-between align-items-center" style="border-radius: 18px !important;">
            <div class="d-flex align-items-center mb-3 mb-md-0">
                <div class="bg-primary text-white rounded-circle p-3 mr-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background-color: rgba(0, 113, 227, 0.1) !important;">
                    <i class="fas fa-percent text-primary"></i>
                </div>
                <div>
                    <h5 class="font-weight-bold text-dark mb-0">Promo Spesial Hari Ini</h5>
                    <p class="text-muted small mb-0">Nikmati potongan langsung hingga Rp 2.000.000 untuk model iPhone pilihan Anda.</p>
                </div>
            </div>
            <a href="#promo-section" class="btn btn-pill-dark btn-sm">Lihat Promo</a>
        </div>

        <!-- Section: iPhone Pro Series -->
        <div class="mb-5" id="pro-section">
            <h2 class="section-title text-center font-weight-bold">iPhone Pro Series</h2>
            <div class="row">
                @foreach($iphone_pro_products as $product)
                <div class="col-6 col-md-4 mb-4">
                    <div class="card card-custom">
                        <div class="img-wrapper">
                            <a href="{{ route('product.show', $product->slug) }}">
                                <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/400x300?text='.$product->name }}" alt="{{ $product->name }}">
                            </a>
                        </div>
                        <div class="card-body card-body-custom">
                            <div>
                                @if($product->is_new)
                                <span class="badge badge-primary px-2.5 py-1 mb-2 font-weight-500 rounded-pill" style="font-size: 0.7rem; background-color: var(--primary);">Baru</span>
                                @endif
                                <a href="{{ route('product.show', $product->slug) }}" class="text-decoration-none text-dark">
                                    <h5 class="card-title-custom mb-1">{{ $product->name }}</h5>
                                </a>
                                <p class="small text-muted text-truncate mb-3">{{ $product->description }}</p>
                            </div>
                            <div>
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
                                    <button type="submit" class="btn btn-custom btn-block font-weight-500">
                                        <i class="fas fa-shopping-cart mr-1"></i> Beli
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Section: iPhone Standard Series -->
        <div class="mb-5">
            <h2 class="section-title text-center font-weight-bold">iPhone Series</h2>
            <div class="row">
                @foreach($iphone_products as $product)
                <div class="col-6 col-md-4 mb-4">
                    <div class="card card-custom">
                        <div class="img-wrapper">
                            <a href="{{ route('product.show', $product->slug) }}">
                                <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/400x300?text='.$product->name }}" alt="{{ $product->name }}">
                            </a>
                        </div>
                        <div class="card-body card-body-custom">
                            <div>
                                @if($product->is_new)
                                <span class="badge badge-primary px-2.5 py-1 mb-2 font-weight-500 rounded-pill" style="font-size: 0.7rem; background-color: var(--primary);">Baru</span>
                                @endif
                                <a href="{{ route('product.show', $product->slug) }}" class="text-decoration-none text-dark">
                                    <h5 class="card-title-custom mb-1">{{ $product->name }}</h5>
                                </a>
                                <p class="small text-muted text-truncate mb-3">{{ $product->description }}</p>
                            </div>
                            <div>
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
                                    <button type="submit" class="btn btn-custom btn-block font-weight-500">
                                        <i class="fas fa-shopping-cart mr-1"></i> Beli
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Section: Promo Hari Ini -->
        @if(count($promo_products) > 0)
        <div class="mb-5" id="promo-section">
            <h2 class="section-title text-center font-weight-bold">Penawaran Spesial</h2>
            <div class="row">
                @foreach($promo_products as $product)
                <div class="col-6 col-md-3 mb-4">
                    <div class="card card-custom">
                        <div class="img-wrapper text-center">
                            <a href="{{ route('product.show', $product->slug) }}">
                                <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/400x300?text='.$product->name }}" alt="{{ $product->name }}">
                            </a>
                        </div>
                        <div class="card-body card-body-custom">
                            <div>
                                <span class="badge badge-danger px-2.5 py-1 mb-2 font-weight-500 rounded-pill" style="font-size: 0.7rem;">Hemat</span>
                                <a href="{{ route('product.show', $product->slug) }}" class="text-decoration-none text-dark">
                                    <h5 class="card-title-custom mb-1">{{ $product->name }}</h5>
                                </a>
                                <p class="small text-muted text-truncate mb-3">{{ $product->description }}</p>
                            </div>
                            <div>
                                <p class="mb-3">
                                    <span class="price-strike">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                    <span class="price-text" style="color: #e30000;">Rp {{ number_format($product->promo_price, 0, ',', '.') }}</span>
                                </p>
                                <form action="{{ route('cart.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="qty" value="1">
                                    <button type="submit" class="btn btn-custom btn-block font-weight-500">
                                        <i class="fas fa-shopping-cart mr-1"></i> Beli
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Section: Accessories -->
        <div class="mb-5">
            <h2 class="section-title text-center font-weight-bold">Aksesoris Apple Resmi</h2>
            <div class="row">
                @foreach($accessory_products as $product)
                <div class="col-6 col-md-4 mb-4">
                    <div class="card card-custom">
                        <div class="img-wrapper">
                            <a href="{{ route('product.show', $product->slug) }}">
                                <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/400x300?text='.$product->name }}" alt="{{ $product->name }}">
                            </a>
                        </div>
                        <div class="card-body card-body-custom">
                            <div>
                                @if($product->is_new)
                                <span class="badge badge-primary px-2.5 py-1 mb-2 font-weight-500 rounded-pill" style="font-size: 0.7rem; background-color: var(--primary);">Baru</span>
                                @endif
                                <a href="{{ route('product.show', $product->slug) }}" class="text-decoration-none text-dark">
                                    <h5 class="card-title-custom mb-1">{{ $product->name }}</h5>
                                </a>
                                <p class="small text-muted text-truncate mb-3">{{ $product->description }}</p>
                            </div>
                            <div>
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
                                    <button type="submit" class="btn btn-custom btn-block font-weight-500">
                                        <i class="fas fa-shopping-cart mr-1"></i> Beli
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection
