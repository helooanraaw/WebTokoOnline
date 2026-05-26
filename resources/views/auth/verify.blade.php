@extends('layout.template')

@section('content')
<div class="container py-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-frost p-5">
                <div class="text-center mb-4">
                    <i class="fab fa-apple fa-3x text-dark mb-3"></i>
                    <h2 class="font-weight-bold text-dark text-heading-lg">Verifikasi Email Anda</h2>
                    <p class="text-muted text-body mt-1">Sebelum melanjutkan, silakan periksa email Anda untuk tautan verifikasi.</p>
                </div>

                @if (session('resent'))
                    <div class="alert alert-success border-0 mb-4" style="border-radius: var(--radius-links); background-color: var(--color-surface-frost); color: var(--color-text-primary);">
                        Tautan verifikasi baru telah dikirimkan ke alamat email Anda.
                    </div>
                @endif

                <div class="text-muted text-body mb-4">
                    Jika Anda tidak menerima email tersebut, klik tombol di bawah untuk meminta email verifikasi yang baru.
                </div>

                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="btn-primary-filled btn-block py-2.5 font-weight-600 text-body text-center">
                        Kirim Ulang Verifikasi
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
