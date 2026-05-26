@extends('layout.template')

@section('content')
<!-- Sub-navigation Bar (Apple Style) -->
<div class="bg-white border-bottom sticky-top py-2" style="top: 56px; z-index: 1020; box-shadow: 0 4px 10px rgba(0,0,0,0.01);">
    <div class="container d-flex justify-content-between align-items-center">
        <div>
            <span class="font-weight-600 text-dark h6 mb-0">{{ $product->name }}</span>
        </div>
        <div class="d-flex align-items-center">
            <span class="text-dark font-weight-600 mr-3" style="font-size: 0.95rem;">
                Rp {{ number_format($product->promo_price ?? $product->price, 0, ',', '.') }}
            </span>
            <a href="#buy-section" class="btn btn-custom btn-sm px-3 rounded-pill">Beli</a>
        </div>
    </div>
</div>

<div class="container py-5" id="buy-section">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb bg-transparent p-0" style="font-size: 0.8rem;">
            <li class="breadcrumb-item"><a href="{{ route('homepage') }}" class="text-muted">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('homepage', ['category' => $product->category->slug]) }}" class="text-muted">{{ $product->category->name }}</a></li>
            <li class="breadcrumb-item active text-dark font-weight-500">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="row">
        <!-- Left Column: Product Image Gallery -->
        <div class="col-md-7 mb-4">
            <div class="p-4 rounded-lg d-flex align-items-center justify-content-center" style="background-color: #fafafa; border-radius: 20px; min-height: 480px; position: sticky; top: 120px;">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid" style="max-height: 420px; object-fit: contain;" alt="{{ $product->name }}">
                @else
                    <div class="text-muted text-center">
                        <i class="fas fa-image fa-5x mb-3"></i>
                        <p class="mb-0">Gambar tidak tersedia</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Right Column: Configurator Options -->
        <div class="col-md-5 pl-md-4">
            <div>
                @if($product->is_new)
                    <span class="text-primary text-uppercase tracking-wider font-weight-bold mb-2 d-block" style="font-size: 0.75rem; letter-spacing: 1px;">Baru</span>
                @endif
                <h1 class="font-weight-bold mb-2 text-dark" style="letter-spacing: -0.5px; font-size: 2.2rem; line-height: 1.15;">{{ $product->name }}</h1>
                <p class="text-muted mb-4" style="font-size: 0.95rem;">Model: Resmi Apple Indonesia (Garansi iBox 1 Tahun)</p>

                <!-- Prices -->
                <div class="mb-4">
                    @if($product->promo_price)
                        <div class="text-muted small text-decoration-line-through mb-1">
                            Semula: <span style="text-decoration: line-through;">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        </div>
                        <h2 class="font-weight-bold text-dark mb-0">Rp {{ number_format($product->promo_price, 0, ',', '.') }}</h2>
                        <span class="badge badge-danger px-2.5 py-1 mt-2 rounded-pill font-weight-500" style="font-size: 0.7rem;">Hemat Rp {{ number_format($product->price - $product->promo_price, 0, ',', '.') }}</span>
                    @else
                        <h2 class="font-weight-bold text-dark">Rp {{ number_format($product->price, 0, ',', '.') }}</h2>
                    @endif
                </div>

                <hr class="my-4">

                <!-- Interactive Color Swatches -->
                @if($product->category->slug == 'iphone-pro' || $product->category->slug == 'iphone')
                <div class="mb-4">
                    <h6 class="font-weight-bold text-dark mb-2">Pilih Finish/Warna: <span id="color-label" class="text-muted font-weight-normal">Titanium Alami</span></h6>
                    <div class="d-flex gap-2 align-items-center mt-2">
                        @if($product->category->slug == 'iphone-pro')
                            <button type="button" class="color-swatch-btn active" data-color-name="Titanium Alami" style="background-color: #aba79e;" title="Titanium Alami"></button>
                            <button type="button" class="color-swatch-btn" data-color-name="Titanium Hitam" style="background-color: #2c2c2d;" title="Titanium Hitam"></button>
                            <button type="button" class="color-swatch-btn" data-color-name="Titanium Biru" style="background-color: #353e4c;" title="Titanium Biru"></button>
                            <button type="button" class="color-swatch-btn" data-color-name="Titanium Putih" style="background-color: #e2e3e5;" title="Titanium Putih"></button>
                        @else
                            <button type="button" class="color-swatch-btn active" data-color-name="Biru" style="background-color: #d0e0ec;" title="Biru"></button>
                            <button type="button" class="color-swatch-btn" data-color-name="Merah Jambu" style="background-color: #fce0e3;" title="Merah Jambu"></button>
                            <button type="button" class="color-swatch-btn" data-color-name="Kuning" style="background-color: #fef5d1;" title="Kuning"></button>
                            <button type="button" class="color-swatch-btn" data-color-name="Hijau" style="background-color: #e2ebd9;" title="Hijau"></button>
                            <button type="button" class="color-swatch-btn" data-color-name="Hitam" style="background-color: #222222;" title="Hitam"></button>
                        @endif
                    </div>
                </div>

                <hr class="my-4">

                <!-- Interactive Storage Capacities -->
                <div class="mb-4">
                    <h6 class="font-weight-bold text-dark mb-2">Pilih Kapasitas: <span id="storage-label" class="text-muted font-weight-normal">128GB</span></h6>
                    <div class="row mt-2">
                        <div class="col-4">
                            <div class="storage-box-btn active" data-storage="128GB">
                                <span class="d-block font-weight-bold text-dark h5 mb-1">128GB</span>
                                <span class="text-muted small">Termasuk</span>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="storage-box-btn" data-storage="256GB">
                                <span class="d-block font-weight-bold text-dark h5 mb-1">256GB</span>
                                <span class="text-muted small">+ Rp 3.000k</span>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="storage-box-btn" data-storage="512GB">
                                <span class="d-block font-weight-bold text-dark h5 mb-1">512GB</span>
                                <span class="text-muted small">+ Rp 6.000k</span>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-4">
                @endif

                <!-- Product Specifications / Highlights -->
                <div class="card border-0 p-3 mb-4 rounded-lg bg-light" style="border-radius: 14px !important;">
                    <div class="row text-center">
                        <div class="col-6 border-right">
                            <small class="text-muted d-block mb-1">Status Stok</small>
                            <span class="font-weight-bold text-xs {{ $product->stock > 0 ? 'text-success' : 'text-danger' }}">
                                <i class="fas {{ $product->stock > 0 ? 'fa-check-circle' : 'fa-times-circle' }} mr-1"></i>
                                {{ $product->stock > 0 ? $product->stock . ' Unit Tersedia' : 'Habis' }}
                            </span>
                        </div>
                        <div class="col-6">
                            <small class="text-muted d-block mb-1">Garansi Resmi</small>
                            <span class="font-weight-bold text-xs text-dark">
                                <i class="fas fa-shield-alt mr-1 text-primary"></i> 1 Tahun iBox
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Add to Cart Form -->
                <form action="{{ route('cart.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="d-flex align-items-center mb-4">
                        <div style="width: 80px;" class="mr-3">
                            <select name="qty" class="form-control text-center py-2 shadow-sm rounded-lg" style="height: 48px; border: 1px solid #d2d2d7;">
                                @for($i = 1; $i <= min($product->stock, 5); $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="flex-grow-1">
                            <button type="submit" class="btn btn-pill-dark btn-lg btn-block font-weight-600 shadow-sm" style="height: 48px; font-size: 0.95rem;" {{ $product->stock <= 0 ? 'disabled' : '' }}>
                                <i class="fas fa-shopping-bag mr-2"></i> Tambahkan ke Bag
                            </button>
                        </div>
                    </div>
                </form>

                <hr class="my-4">

                <!-- Product Description -->
                <div class="mt-4">
                    <h6 class="font-weight-bold text-dark mb-2">Deskripsi Produk</h6>
                    <p class="text-muted" style="line-height: 1.8; font-size: 0.9rem;">
                        {!! nl2br(e($product->description)) !!}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    @if(count($related_products) > 0)
    <div class="mt-5 pt-5 border-top">
        <h3 class="font-weight-bold text-dark mb-4 text-center">Rekomendasi Lain Untuk Anda</h3>
        <div class="row mt-4">
            @foreach($related_products as $rel)
            <div class="col-6 col-md-3 mb-4">
                <div class="card card-custom">
                    <div class="img-wrapper" style="height: 180px; padding: 1rem;">
                        <a href="{{ route('product.show', $rel->slug) }}">
                            <img src="{{ $rel->image ? asset('storage/' . $rel->image) : 'https://via.placeholder.com/400x300?text='.$rel->name }}" style="max-height: 150px;" alt="{{ $rel->name }}">
                        </a>
                    </div>
                    <div class="card-body card-body-custom" style="padding: 1.25rem;">
                        <div>
                            <a href="{{ route('product.show', $rel->slug) }}" class="text-decoration-none text-dark">
                                <h6 class="font-weight-bold mb-1 text-truncate">{{ $rel->name }}</h6>
                            </a>
                            <p class="small text-muted mb-2">{{ $rel->category->name }}</p>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="font-weight-600 text-dark" style="font-size: 0.9rem;">Rp {{ number_format($rel->promo_price ?? $rel->price, 0, ',', '.') }}</span>
                            <a href="{{ route('product.show', $rel->slug) }}" class="btn btn-custom btn-sm px-2.5 rounded-pill" style="font-size: 0.75rem;">Lihat</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>

<!-- Styling and Scripting for Interactive Features -->
<style>
    /* Swatches style */
    .color-swatch-btn {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        border: 2px solid transparent;
        padding: 0;
        cursor: pointer;
        transition: all 0.2s ease;
        outline: none;
        box-shadow: inset 0 3px 5px rgba(0,0,0,0.15);
        margin-right: 10px;
    }
    .color-swatch-btn:focus {
        outline: none;
    }
    .color-swatch-btn.active {
        border-color: var(--primary);
        transform: scale(1.15);
        box-shadow: 0 0 10px rgba(0, 113, 227, 0.4);
    }
    
    /* Storage button style */
    .storage-box-btn {
        border: 2px solid #d2d2d7;
        border-radius: 12px;
        padding: 1rem 0.5rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s ease;
        background: #ffffff;
    }
    .storage-box-btn:hover {
        border-color: #86868b;
    }
    .storage-box-btn.active {
        border-color: var(--primary);
        background: rgba(0, 113, 227, 0.02);
        box-shadow: 0 0 10px rgba(0, 113, 227, 0.1);
    }
    
    .gap-2 {
        gap: 0.5rem;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Handle Color Swatches click
        const colorBtns = document.querySelectorAll(".color-swatch-btn");
        const colorLabel = document.getElementById("color-label");
        
        colorBtns.forEach(btn => {
            btn.addEventListener("click", function() {
                colorBtns.forEach(b => b.classList.remove("active"));
                this.classList.add("active");
                colorLabel.innerText = this.getAttribute("data-color-name");
            });
        });

        // Handle Storage Boxes click
        const storageBtns = document.querySelectorAll(".storage-box-btn");
        const storageLabel = document.getElementById("storage-label");
        
        storageBtns.forEach(btn => {
            btn.addEventListener("click", function() {
                storageBtns.forEach(b => b.classList.remove("active"));
                this.classList.add("active");
                storageLabel.innerText = this.getAttribute("data-storage");
            });
        });
    });
</script>
@endsection
