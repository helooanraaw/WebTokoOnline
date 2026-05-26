@extends('layout.admin')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.category.index') }}" class="text-muted text-decoration-none text-caption">
        <i class="fas fa-arrow-left mr-1"></i> Kembali ke Daftar
    </a>
    <h2 class="font-weight-bold mt-2 text-dark text-heading-lg">Tambah Kategori Baru</h2>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card card-white p-4">
            <form action="{{ route('admin.category.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name" class="font-weight-600 text-dark text-body">Nama Kategori</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" 
                           placeholder="Contoh: iPhone Pro" value="{{ old('name') }}" required>
                    @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                    <small class="text-muted text-caption mt-1 d-block">Slug akan dibuat otomatis berdasarkan nama.</small>
                </div>
                
                <hr style="border-top: 1px solid #d2d2d7;">
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary px-5">
                        <i class="fas fa-save mr-1"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
