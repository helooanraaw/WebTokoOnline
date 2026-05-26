@extends('layout.template')

@section('content')
<!-- Hero Section (Apple Style Light) -->
@if(!$selectedCategory)
<div class="hero-section text-center mb-5 position-relative" style="background-color: var(--color-surface-frost); padding: 4rem 1rem 0; overflow: hidden; min-height: 520px; border-bottom: 1px solid #e2e2e5;">
    <div class="container py-4">
        <h3 class="text-uppercase tracking-wide text-muted font-weight-bold mb-2 text-caption" style="letter-spacing: 2px;">Terbaru</h3>
        <h1 class="text-display-xl mb-2 text-dark">iPhone 15 Pro Max</h1>
        <p class="text-subheading mb-4 text-muted">Titanium. Sangat kuat. Sangat ringan. Sangat Pro.</p>
        <div class="d-flex justify-content-center align-items-center mb-4">
            <a href="{{ route('product.show', 'iphone-15-pro-max') }}" class="btn-primary-filled px-4 py-2 mr-3">Beli Sekarang</a>
            <a href="#pro-section" class="btn-outline-text">Selengkapnya</a>
        </div>
        <div class="mt-4 d-flex justify-content-center">
            <img src="{{ asset('storage/products/iphone_15_pro_max.jpg') }}" class="img-fluid" style="max-height: 320px; object-fit: contain;" alt="iPhone 15 Pro Max">
        </div>
    </div>
</div>
@endif

<div class="container">
    @if($selectedCategory)
        <!-- Filtered View Header -->
        <div class="mb-5 text-center mt-5 pt-3">
            <h1 class="text-display-lg font-weight-bold">{{ $selectedCategory->name }}</h1>
            <p class="text-body-lg text-muted">Temukan model {{ $selectedCategory->name }} terbaik yang cocok untuk Anda.</p>
            <a href="{{ route('homepage') }}" class="btn-outline-text mt-3"><i class="fas fa-arrow-left mr-2"></i> Kembali ke Beranda</a>
        </div>

        <!-- Filtered Products Grid -->
        <div class="row">
            @forelse($filtered_products as $product)
            <div class="col-6 col-md-4 mb-4">
                <div class="card card-custom card-white">
                    <div class="img-wrapper">
                        <a href="{{ route('product.show', $product->slug) }}" class="w-100 h-100 d-flex align-items-center justify-content-center text-decoration-none">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                            @else
                                <i class="fab fa-apple fa-4x" style="opacity: 0.15; color: var(--color-text-primary);"></i>
                            @endif
                        </a>
                    </div>
                    <div class="card-body card-body-custom">
                        <div>
                            @if($product->is_new)
                            <span class="badge-feature mb-2">Baru</span>
                            @endif
                            <a href="{{ route('product.show', $product->slug) }}" class="text-decoration-none text-dark">
                                <h5 class="card-title-custom mb-1">{{ $product->name }}</h5>
                            </a>
                            <p class="text-caption text-muted text-truncate mb-3">{{ $product->description }}</p>
                        </div>
                        <div>
                            <p class="mb-3">
                                @if($product->promo_price)
                                    <span class="price-strike">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                    <span class="price-text" style="color: var(--color-accent-orange);">Rp {{ number_format($product->promo_price, 0, ',', '.') }}</span>
                                @else
                                    <span class="price-text">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                @endif
                            </p>
                            <form action="{{ route('cart.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="qty" value="1">
                                <button type="submit" class="btn-primary-filled btn-block text-body font-weight-500">
                                    Beli
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <p class="text-body text-muted">Tidak ada produk ditemukan di kategori ini.</p>
            </div>
            @endforelse
        </div>

    @else
        <!-- Standard Homepage: Apple Store Sections -->

        <!-- Promo Banner (Interactive) -->
        <div class="promo-bar card-frost p-4 mb-5 d-flex flex-column flex-md-row justify-content-between align-items-center">
            <div class="d-flex align-items-center mb-3 mb-md-0">
                <div class="rounded-circle p-3 mr-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background-color: var(--color-interactive-grey);">
                    <i class="fas fa-percent text-dark"></i>
                </div>
                <div>
                    <h5 class="text-body-lg font-weight-bold text-dark mb-0">Promo Spesial Hari Ini</h5>
                    <p class="text-caption text-muted mb-0">Nikmati potongan langsung hingga Rp 2.000.000 untuk model iPhone pilihan Anda.</p>
                </div>
            </div>
            <a href="#promo-section" class="btn-outline-text btn-sm">Lihat Promo</a>
        </div>

        <!-- Section: iPhone Pro Series -->
        <div class="section-gap" id="pro-section">
            <h2 class="text-display-md text-center font-weight-bold mb-4">iPhone Pro Series</h2>
            <div class="row">
                @foreach($iphone_pro_products as $product)
                <div class="col-6 col-md-4 mb-4">
                    <div class="card card-custom card-white">
                        <div class="img-wrapper">
                            <a href="{{ route('product.show', $product->slug) }}" class="w-100 h-100 d-flex align-items-center justify-content-center text-decoration-none">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                                @else
                                    <i class="fab fa-apple fa-4x" style="opacity: 0.15; color: var(--color-text-primary);"></i>
                                @endif
                            </a>
                        </div>
                        <div class="card-body card-body-custom">
                            <div>
                                @if($product->is_new)
                                <span class="badge-feature mb-2">Baru</span>
                                @endif
                                <a href="{{ route('product.show', $product->slug) }}" class="text-decoration-none text-dark">
                                    <h5 class="card-title-custom mb-1">{{ $product->name }}</h5>
                                </a>
                                <p class="text-caption text-muted text-truncate mb-3">{{ $product->description }}</p>
                            </div>
                            <div>
                                <p class="mb-3">
                                    @if($product->promo_price)
                                        <span class="price-strike">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                        <span class="price-text" style="color: var(--color-accent-orange);">Rp {{ number_format($product->promo_price, 0, ',', '.') }}</span>
                                    @else
                                        <span class="price-text">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                    @endif
                                </p>
                                <form action="{{ route('cart.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="qty" value="1">
                                    <button type="submit" class="btn-primary-filled btn-block text-body font-weight-500">
                                        Beli
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
        <div class="section-gap">
            <h2 class="text-display-md text-center font-weight-bold mb-4">iPhone Series</h2>
            <div class="row">
                @foreach($iphone_products as $product)
                <div class="col-6 col-md-4 mb-4">
                    <div class="card card-custom card-white">
                        <div class="img-wrapper">
                            <a href="{{ route('product.show', $product->slug) }}" class="w-100 h-100 d-flex align-items-center justify-content-center text-decoration-none">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                                @else
                                    <i class="fab fa-apple fa-4x" style="opacity: 0.15; color: var(--color-text-primary);"></i>
                                @endif
                            </a>
                        </div>
                        <div class="card-body card-body-custom">
                            <div>
                                @if($product->is_new)
                                <span class="badge-feature mb-2">Baru</span>
                                @endif
                                <a href="{{ route('product.show', $product->slug) }}" class="text-decoration-none text-dark">
                                    <h5 class="card-title-custom mb-1">{{ $product->name }}</h5>
                                </a>
                                <p class="text-caption text-muted text-truncate mb-3">{{ $product->description }}</p>
                            </div>
                            <div>
                                <p class="mb-3">
                                    @if($product->promo_price)
                                        <span class="price-strike">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                        <span class="price-text" style="color: var(--color-accent-orange);">Rp {{ number_format($product->promo_price, 0, ',', '.') }}</span>
                                    @else
                                        <span class="price-text">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                    @endif
                                </p>
                                <form action="{{ route('cart.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="qty" value="1">
                                    <button type="submit" class="btn-primary-filled btn-block text-body font-weight-500">
                                        Beli
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
        <div class="section-gap" id="promo-section">
            <h2 class="text-display-md text-center font-weight-bold mb-4">Penawaran Spesial</h2>
            <div class="row">
                @foreach($promo_products as $product)
                <div class="col-6 col-md-3 mb-4">
                    <div class="card card-custom card-white">
                        <div class="img-wrapper text-center">
                            <a href="{{ route('product.show', $product->slug) }}" class="w-100 h-100 d-flex align-items-center justify-content-center text-decoration-none">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                                @else
                                    <i class="fab fa-apple fa-4x" style="opacity: 0.15; color: var(--color-text-primary);"></i>
                                @endif
                            </a>
                        </div>
                        <div class="card-body card-body-custom">
                            <div>
                                <span class="badge-feature mb-2" style="background-color: #ffd60a; color: #000000;">Hemat</span>
                                <a href="{{ route('product.show', $product->slug) }}" class="text-decoration-none text-dark">
                                    <h5 class="card-title-custom mb-1">{{ $product->name }}</h5>
                                </a>
                                <p class="text-caption text-muted text-truncate mb-3">{{ $product->description }}</p>
                            </div>
                            <div>
                                <p class="mb-3">
                                    <span class="price-strike">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                    <span class="price-text" style="color: var(--color-accent-orange);">Rp {{ number_format($product->promo_price, 0, ',', '.') }}</span>
                                </p>
                                <form action="{{ route('cart.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="qty" value="1">
                                    <button type="submit" class="btn-primary-filled btn-block text-body font-weight-500">
                                        Beli
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
        <div class="section-gap">
            <h2 class="text-display-md text-center font-weight-bold mb-4">Aksesoris Apple Resmi</h2>
            <div class="row">
                @foreach($accessory_products as $product)
                <div class="col-6 col-md-4 mb-4">
                    <div class="card card-custom card-white">
                        <div class="img-wrapper">
                            <a href="{{ route('product.show', $product->slug) }}" class="w-100 h-100 d-flex align-items-center justify-content-center text-decoration-none">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                                @else
                                    <i class="fab fa-apple fa-4x" style="opacity: 0.15; color: var(--color-text-primary);"></i>
                                @endif
                            </a>
                        </div>
                        <div class="card-body card-body-custom">
                            <div>
                                @if($product->is_new)
                                <span class="badge-feature mb-2">Baru</span>
                                @endif
                                <a href="{{ route('product.show', $product->slug) }}" class="text-decoration-none text-dark">
                                    <h5 class="card-title-custom mb-1">{{ $product->name }}</h5>
                                </a>
                                <p class="text-caption text-muted text-truncate mb-3">{{ $product->description }}</p>
                            </div>
                            <div>
                                <p class="mb-3">
                                    @if($product->promo_price)
                                        <span class="price-strike">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                        <span class="price-text" style="color: var(--color-accent-orange);">Rp {{ number_format($product->promo_price, 0, ',', '.') }}</span>
                                    @else
                                        <span class="price-text">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                    @endif
                                </p>
                                <form action="{{ route('cart.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="qty" value="1">
                                    <button type="submit" class="btn-primary-filled btn-block text-body font-weight-500">
                                        Beli
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
