@extends('layout.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="font-weight-bold mb-0 text-dark">Manajemen Kategori</h2>
    <a href="{{ route('admin.category.create') }}" class="btn btn-primary px-4">
        <i class="fas fa-plus mr-1"></i> Tambah Kategori
    </a>
</div>

<div class="card card-white">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th class="border-0 pl-4" style="width: 10%">No</th>
                        <th class="border-0" style="width: 40%">Nama Kategori</th>
                        <th class="border-0" style="width: 30%">Slug</th>
                        <th class="border-0 text-right pr-4" style="width: 20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $index => $category)
                    <tr>
                        <td class="pl-4 align-middle font-weight-600 text-muted">{{ $index + 1 }}</td>
                        <td class="align-middle font-weight-bold text-dark">{{ $category->name }}</td>
                        <td class="align-middle text-muted">{{ $category->slug }}</td>
                        <td class="text-right pr-4 align-middle">
                            <a href="{{ route('admin.category.edit', $category->id) }}" class="btn btn-sm btn-info mr-1" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.category.destroy', $category->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" title="Hapus" onclick="return confirm('Yakin ingin menghapus kategori ini?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-5 text-muted">
                            <i class="fas fa-folder-open fa-3x mb-3 d-block" style="opacity: 0.5;"></i>
                            Belum ada kategori.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
