@extends('layout.template')

@section('content')
<div class="container py-5 mt-4">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card card-frost p-5">
                <div class="text-center mb-4">
                    <i class="fab fa-apple fa-3x text-dark mb-3"></i>
                    <h2 class="font-weight-bold text-dark text-heading-lg">Buat Akun iStore</h2>
                    <p class="text-muted text-body mt-1">Daftar sekarang untuk mulai berbelanja iPhone impian Anda.</p>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="name" class="font-weight-600 text-dark text-body">Nama Lengkap</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Nama Anda">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="email" class="font-weight-600 text-dark text-body">Alamat Email</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="name@example.com">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="password" class="font-weight-600 text-dark text-body">Kata Sandi</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Minimal 8 karakter">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <label for="password-confirm" class="font-weight-600 text-dark text-body">Konfirmasi Kata Sandi</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi kata sandi">
                    </div>

                    <button type="submit" class="btn-primary-filled btn-block py-2.5 font-weight-600 text-body text-center mb-3">
                        Daftar
                    </button>
                    
                    <div class="text-center">
                        <span class="text-muted text-caption">Sudah memiliki akun? <a href="{{ route('login') }}" style="color: var(--color-link-blue); text-decoration: none;">Masuk di sini</a></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
