@extends('layout.admin')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.product.index') }}" class="text-muted text-decoration-none">
        <i class="fas fa-arrow-left mr-1"></i> Kembali ke Daftar
    </a>
    <h2 class="font-weight-bold mt-2">Tambah Produk Baru</h2>
</div>

<form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <!-- Main Info -->
        <div class="col-md-8">
            <div class="card border-0 shadow-sm p-4 mb-4">
                <div class="form-group">
                    <label class="font-weight-bold">Nama Produk</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                           placeholder="Masukkan nama produk" value="{{ old('name') }}" required>
                    @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label class="font-weight-bold">Deskripsi Produk</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" 
                              rows="5" placeholder="Tuliskan detail produk..." required>{{ old('description') }}</textarea>
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
                                       placeholder="0" value="{{ old('price') }}" required>
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
                                       placeholder="Kosongkan jika tidak ada promo" value="{{ old('promo_price') }}">
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
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label class="font-weight-bold">Stok</label>
                    <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror" 
                           placeholder="0" value="{{ old('stock') }}" required>
                    @error('stock') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" name="is_new" class="custom-control-input" id="is_new" {{ old('is_new') ? 'checked' : '' }}>
                        <label class="custom-control-label font-weight-bold" for="is_new">Produk Terbaru</label>
                    </div>
                </div>

                <div class="form-group mb-0">
                    <label class="font-weight-bold">Gambar Produk</label>
                    <div class="custom-file">
                        <input type="file" name="image" class="custom-file-input @error('image') is-invalid @enderror" id="image" accept="image/*">
                        <label class="custom-file-label" for="image">Pilih file...</label>
                    </div>
                    @error('image') <span class="text-danger small">{{ $message }}</span> @enderror
                    <div id="image-preview" class="mt-3 text-center d-none">
                        <img src="" class="img-fluid rounded shadow-sm" style="max-height: 200px;">
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-block btn-lg shadow-sm">
                <i class="fas fa-save mr-1"></i> Simpan Produk
            </button>
        </div>
    </div>
</form>

<script>
    // Preview Gambar
    document.getElementById('image').onchange = function (evt) {
        const [file] = this.files;
        if (file) {
            const preview = document.getElementById('image-preview');
            preview.classList.remove('d-none');
            preview.querySelector('img').src = URL.createObjectURL(file);
            this.nextElementSibling.innerText = file.name;
        }
    }
</script>
@endsection
