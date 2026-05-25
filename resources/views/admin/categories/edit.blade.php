@extends('layout.admin')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.category.index') }}" class="text-muted text-decoration-none">
        <i class="fas fa-arrow-left mr-1"></i> Kembali ke Daftar
    </a>
    <h2 class="font-weight-bold mt-2">Edit Kategori</h2>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm p-4">
            <form action="{{ route('admin.category.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name" class="font-weight-bold">Nama Kategori</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" 
                           value="{{ old('name', $category->name) }}" required>
                    @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                
                <hr>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-info px-5">
                        <i class="fas fa-edit mr-1"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
