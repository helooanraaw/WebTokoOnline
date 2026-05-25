<nav class="navbar navbar-expand-lg navbar-light fixed-top navbar-custom">
    <div class="container">
        <a class="navbar-brand" href="{{ route('homepage') }}">
            <i class="fas fa-shopping-bag mr-2"></i>PakPras Store
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('homepage') }}">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="catDropdown" role="button" data-toggle="dropdown">
                        Kategori
                    </a>
                    <div class="dropdown-menu border-0 shadow-sm">
                        @foreach($categories as $cat)
                        <a class="dropdown-item" href="#">{{ $cat->name }}</a>
                        @endforeach
                    </div>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link position-relative" href="{{ route('cart.index') }}">
                        <i class="fas fa-shopping-cart fa-lg"></i>
                        @auth
                            @php $cartCount = Auth::user()->carts()->count(); @endphp
                            @if($cartCount > 0)
                                <span class="badge badge-pill badge-danger position-absolute" style="top: 0; right: 0;">{{ $cartCount }}</span>
                            @endif
                        @endauth
                    </a>
                </li>
                @guest
                    <li class="nav-item ml-lg-3">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-custom ml-lg-2" href="{{ route('register') }}">Daftar</a>
                    </li>
                @else
                    <li class="nav-item dropdown ml-lg-3">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown">
                            <i class="fas fa-user-circle mr-1"></i> {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right border-0 shadow-sm">
                            @if(Auth::user()->role == 'admin')
                            <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-tachometer-alt mr-2 text-primary"></i>Dashboard Admin
                            </a>
                            <div class="dropdown-divider"></div>
                            @endif
                            <a class="dropdown-item" href="{{ route('order.history') }}">
                                <i class="fas fa-list mr-2 text-primary"></i>Pesanan Saya
                            </a>
                            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt mr-2 text-danger"></i>Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
