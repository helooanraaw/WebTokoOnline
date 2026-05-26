<nav class="navbar navbar-expand-lg navbar-light fixed-top navbar-custom">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('homepage') }}">
            <i class="fab fa-apple mr-2" style="font-size: 1.35rem; vertical-align: middle; color: var(--color-text-primary);"></i> iStore PakPras
        </a>
        <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('homepage') }}">Home</a>
                </li>
                @foreach($categories as $cat)
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('homepage', ['category' => $cat->slug]) }}">{{ $cat->name }}</a>
                </li>
                @endforeach
            </ul>
            <ul class="navbar-nav ml-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link position-relative mr-2" href="{{ route('cart.index') }}">
                        <i class="fas fa-shopping-bag fa-lg" style="color: var(--color-text-secondary);"></i>
                        @auth
                            @php $cartCount = Auth::user()->carts()->count(); @endphp
                            @if($cartCount > 0)
                                <span class="badge badge-pill badge-primary position-absolute" style="top: -2px; right: -5px; font-size: 0.65rem; background-color: var(--color-action-blue);">{{ $cartCount }}</span>
                            @endif
                        @endauth
                    </a>
                </li>
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item ml-lg-2">
                        <a class="btn-primary-filled" style="padding: 6px 12px; font-size: 12px;" href="{{ route('register') }}">Daftar</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown">
                            <i class="fas fa-user-circle mr-1"></i> {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right border-0 shadow-sm mt-2">
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
