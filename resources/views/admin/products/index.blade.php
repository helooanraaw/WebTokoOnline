@extends('layout.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="font-weight-bold mb-0 text-dark">Manajemen Produk</h2>
    <a href="{{ route('admin.product.create') }}" class="btn btn-primary px-4">
        <i class="fas fa-plus mr-1"></i> Tambah Produk
    </a>
</div>

<div class="card card-white">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th class="border-0 pl-4" style="width: 10%">Gambar</th>
                        <th class="border-0" style="width: 30%">Nama Produk</th>
                        <th class="border-0" style="width: 15%">Kategori</th>
                        <th class="border-0" style="width: 15%">Harga</th>
                        <th class="border-0" style="width: 10%">Stok</th>
                        <th class="border-0" style="width: 10%">Status</th>
                        <th class="border-0 text-right pr-4" style="width: 10%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                    <tr>
                        <td class="pl-4 align-middle">
                            <div class="d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background-color: var(--color-surface-frost); border-radius: var(--radius-links) !important; padding: 4px;">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" style="max-height: 100%; max-width: 100%; object-fit: contain;">
                                @else
                                    <i class="fab fa-apple fa-lg text-muted" style="opacity: 0.3;"></i>
                                @endif
                            </div>
                        </td>
                        <td class="align-middle">
                            <span class="font-weight-bold text-dark d-block text-body-lg">{{ $product->name }}</span>
                            <small class="text-muted text-caption">{{ $product->slug }}</small>
                        </td>
                        <td class="align-middle">
                            <span class="font-weight-600 px-2.5 py-1 text-caption" style="background-color: var(--color-surface-frost); color: var(--color-text-primary); border-radius: var(--radius-links);">{{ $product->category->name }}</span>
                        </td>
                        <td class="align-middle text-body">
                            @if($product->promo_price)
                                <small class="text-muted d-block text-caption" style="text-decoration: line-through;">Rp {{ number_format($product->price, 0, ',', '.') }}</small>
                                <span class="font-weight-bold" style="color: var(--color-accent-orange);">Rp {{ number_format($product->promo_price, 0, ',', '.') }}</span>
                            @else
                                <span class="text-dark font-weight-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            @endif
                        </td>
                        <td class="align-middle text-body">
                            @if($product->stock <= 5)
                                <span class="text-danger font-weight-bold"><i class="fas fa-exclamation-triangle mr-1"></i>{{ $product->stock }}</span>
                            @else
                                <span class="text-dark">{{ $product->stock }}</span>
                            @endif
                        </td>
                        <td class="align-middle">
                            @if($product->is_new)
                                <span class="px-2 py-0.5 text-caption font-weight-600 mr-1" style="background-color: #e0f0ff; color: var(--color-action-blue); border-radius: var(--radius-links);">BARU</span>
                            @endif
                            @if($product->promo_price)
                                <span class="px-2 py-0.5 text-caption font-weight-600" style="background-color: #fdf0e7; color: var(--color-accent-orange); border-radius: var(--radius-links);">PROMO</span>
                            @endif
                        </td>
                        <td class="text-right pr-4 align-middle">
                            <a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-sm btn-info mr-1" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.product.destroy', $product->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" title="Hapus" onclick="return confirm('Yakin ingin menghapus produk ini?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="fas fa-box-open fa-3x mb-3 d-block" style="opacity: 0.5;"></i>
                            Belum ada produk.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
