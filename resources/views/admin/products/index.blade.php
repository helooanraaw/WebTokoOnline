@extends('layout.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="font-weight-bold mb-0">Manajemen Produk</h2>
    <a href="{{ route('admin.product.create') }}" class="btn btn-primary px-4 shadow-sm">
        <i class="fas fa-plus mr-1"></i> Tambah Produk
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="border-0 pl-4">Gambar</th>
                        <th class="border-0">Nama Produk</th>
                        <th class="border-0">Kategori</th>
                        <th class="border-0">Harga</th>
                        <th class="border-0">Stok</th>
                        <th class="border-0">Status</th>
                        <th class="border-0 text-right pr-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                    <tr>
                        <td class="pl-4 align-middle">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" class="rounded shadow-sm" style="width: 60px; height: 60px; object-fit: cover;">
                            @else
                                <div class="bg-light rounded d-flex align-items-center justify-content-center text-muted" style="width: 60px; height: 60px;">
                                    <i class="fas fa-image"></i>
                                </div>
                            @endif
                        </td>
                        <td class="align-middle">
                            <span class="font-weight-bold text-dark d-block">{{ $product->name }}</span>
                            <small class="text-muted">{{ $product->slug }}</small>
                        </td>
                        <td class="align-middle">
                            <span class="badge badge-light px-3 py-2">{{ $product->category->name }}</span>
                        </td>
                        <td class="align-middle">
                            @if($product->promo_price)
                                <small class="text-muted d-block" style="text-decoration: line-through;">Rp {{ number_format($product->price, 0, ',', '.') }}</small>
                                <span class="text-primary font-weight-bold">Rp {{ number_format($product->promo_price, 0, ',', '.') }}</span>
                            @else
                                <span class="text-dark font-weight-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            @endif
                        </td>
                        <td class="align-middle">
                            @if($product->stock <= 5)
                                <span class="text-danger font-weight-bold"><i class="fas fa-exclamation-triangle mr-1"></i>{{ $product->stock }}</span>
                            @else
                                <span class="text-dark">{{ $product->stock }}</span>
                            @endif
                        </td>
                        <td class="align-middle">
                            @if($product->is_new)
                                <span class="badge badge-success px-2 py-1">BARU</span>
                            @endif
                            @if($product->promo_price)
                                <span class="badge badge-danger px-2 py-1">PROMO</span>
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
                            <i class="fas fa-box-open fa-3x mb-3 d-block"></i>
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
