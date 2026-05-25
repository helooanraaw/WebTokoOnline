<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <title>Admin Dashboard | PakPras Store</title>
    <style>
        :root {
            --primary: #4F46E5;
            --secondary: #10B981;
            --dark-sidebar: #111827;
            --light-bg: #F9FAFB;
        }
        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--light-bg);
            overflow-x: hidden;
        }
        
        /* Sidebar Styles */
        #sidebar-wrapper {
            min-height: 100vh;
            margin-left: -15rem;
            transition: margin .25s ease-out;
            background: var(--dark-sidebar);
            color: white;
        }
        #sidebar-wrapper .sidebar-heading {
            padding: 1.5rem 1.25rem;
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--primary);
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        #sidebar-wrapper .list-group {
            width: 15rem;
        }
        #sidebar-wrapper .list-group-item {
            background: transparent;
            color: #9CA3AF;
            border: none;
            padding: 0.75rem 1.5rem;
            transition: all 0.3s;
        }
        #sidebar-wrapper .list-group-item:hover, 
        #sidebar-wrapper .list-group-item.active {
            color: white;
            background: rgba(79, 70, 229, 0.1);
            border-left: 4px solid var(--primary);
        }
        #sidebar-wrapper .list-group-item i {
            margin-right: 10px;
            width: 20px;
        }

        /* Page Content Styles */
        #page-content-wrapper {
            min-width: 100vw;
        }
        #wrapper.toggled #sidebar-wrapper {
            margin-left: 0;
        }

        @media (min-width: 768px) {
            #sidebar-wrapper {
                margin-left: 0;
            }
            #page-content-wrapper {
                min-width: 0;
                width: 100%;
            }
            #wrapper.toggled #sidebar-wrapper {
                margin-left: -15rem;
            }
        }

        /* Navbar Admin */
        .navbar-admin {
            background: white;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        /* Cards & Components */
        .card-stats {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }
        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }
    </style>
</head>
<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <div class="sidebar-heading">
                <i class="fas fa-shopping-bag mr-2"></i>PakPras Admin
            </div>
            <div class="list-group list-group-flush mt-3">
                <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-chart-line"></i> Dashboard
                </a>
                <a href="{{ route('admin.category.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('admin.category.*') ? 'active' : '' }}">
                    <i class="fas fa-tags"></i> Kategori
                </a>
                <a href="{{ route('admin.product.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('admin.product.*') ? 'active' : '' }}">
                    <i class="fas fa-box"></i> Produk
                </a>
                <a href="{{ route('admin.order.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('admin.order.*') ? 'active' : '' }}">
                    <i class="fas fa-shopping-cart"></i> Pesanan
                </a>
                <a href="{{ route('admin.report.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('admin.report.*') ? 'active' : '' }}">
                    <i class="fas fa-file-invoice-dollar"></i> Laporan Penjualan
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="fas fa-users"></i> Pelanggan
                </a>
                <a href="{{ route('homepage') }}" class="list-group-item list-group-item-action mt-5">
                    <i class="fas fa-external-link-alt"></i> Lihat Toko
                </a>
            </div>
        </div>

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light navbar-admin py-3 px-4">
                <button class="btn btn-light" id="menu-toggle">
                    <i class="fas fa-bars"></i>
                </button>

                <div class="ml-auto d-flex align-items-center">
                    <span class="mr-3 d-none d-md-inline text-muted">Halo, <strong>{{ Auth::user()->name }}</strong></span>
                    <div class="dropdown">
                        <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=4F46E5&color=fff" 
                             class="rounded-circle dropdown-toggle" id="userMenu" data-toggle="dropdown" 
                             style="width: 35px; cursor: pointer;">
                        <div class="dropdown-menu dropdown-menu-right border-0 shadow mt-2">
                            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt mr-2 text-danger"></i>Logout
                            </a>
                        </div>
                    </div>
                </div>
            </nav>

            <div class="container-fluid p-4">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                        <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
                        <i class="fas fa-exclamation-circle mr-2"></i> {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>
</body>
</html>
