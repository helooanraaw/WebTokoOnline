@extends('layout.admin')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.product.index') }}" class="text-muted text-decoration-none">
        <i class="fas fa-arrow-left mr-1"></i> Kembali ke Daftar
    </a>
    <h2 class="font-weight-bold mt-2">Edit Produk: {{ $product->name }}</h2>
</div>

<form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <!-- Main Info -->
        <div class="col-md-8">
            <div class="card border-0 shadow-sm p-4 mb-4">
                <div class="form-group">
                    <label class="font-weight-bold">Nama Produk</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                           placeholder="Masukkan nama produk" value="{{ old('name', $product->name) }}" required>
                    @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label class="font-weight-bold">Deskripsi Produk</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" 
                              rows="5" placeholder="Tuliskan detail produk..." required>{{ old('description', $product->description) }}</textarea>
                    @error('description') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-weight-bold">Harga Normal</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" 
                                       placeholder="0" value="{{ old('price', $product->price) }}" required>
                            </div>
                            @error('price') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-weight-bold">Harga Promo (Opsional)</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="number" name="promo_price" class="form-control @error('promo_price') is-invalid @enderror" 
                                       placeholder="Kosongkan jika tidak ada promo" value="{{ old('promo_price', $product->promo_price) }}">
                            </div>
                            @error('promo_price') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Info -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4 mb-4">
                <div class="form-group">
                    <label class="font-weight-bold">Kategori</label>
                    <select name="category_id" class="form-control @error('category_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label class="font-weight-bold">Stok</label>
                    <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror" 
                           placeholder="0" value="{{ old('stock', $product->stock) }}" required>
                    @error('stock') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" name="is_new" class="custom-control-input" id="is_new" {{ old('is_new', $product->is_new) ? 'checked' : '' }}>
                        <label class="custom-control-label font-weight-bold" for="is_new">Produk Terbaru</label>
                    </div>
                </div>

                <div class="form-group mb-0">
                    <label class="font-weight-bold">Gambar Produk</label>
                    <div class="custom-file">
                        <input type="file" name="image" class="custom-file-input @error('image') is-invalid @enderror" id="image" accept="image/*">
                        <label class="custom-file-label" for="image">Ganti file...</label>
                    </div>
                    @error('image') <span class="text-danger small">{{ $message }}</span> @enderror
                    
                    <div id="image-preview" class="mt-3 text-center">
                        <label class="d-block text-muted small mb-2">Preview Gambar Saat Ini:</label>
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded shadow-sm" style="max-height: 200px;">
                        @else
                            <div class="bg-light rounded py-4 text-muted">
                                <i class="fas fa-image fa-2x"></i>
                                <p class="small mb-0 mt-1">Belum ada gambar</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-info btn-block btn-lg shadow-sm">
                <i class="fas fa-edit mr-1"></i> Update Produk
            </button>
        </div>
    </div>
</form>

<script>
    // Preview Gambar Baru
    document.getElementById('image').onchange = function (evt) {
        const [file] = this.files;
        if (file) {
            const previewImg = document.querySelector('#image-preview img');
            const previewDiv = document.querySelector('#image-preview');
            
            if (!previewImg) {
                previewDiv.innerHTML = '<label class="d-block text-muted small mb-2">Preview Gambar Baru:</label><img src="" class="img-fluid rounded shadow-sm" style="max-height: 200px;">';
                document.querySelector('#image-preview img').src = URL.createObjectURL(file);
            } else {
                previewDiv.querySelector('label').innerText = 'Preview Gambar Baru:';
                previewImg.src = URL.createObjectURL(file);
            }
            this.nextElementSibling.innerText = file.name;
        }
    }
</script>
@endsection
