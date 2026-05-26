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
            /* Apple España style variables */
            --color-canvas-white: #ffffff;
            --color-surface-frost: #f5f5f7;
            --color-interactive-grey: #e2e2e5;
            --color-text-primary: #1d1d1f;
            --color-text-secondary: #707070;
            --color-text-muted: #474747;
            --color-action-blue: #0071e3;
            --color-link-blue: #0066cc;
            --color-success-green: #03aa49;
            --color-accent-violet: #8668ff;
            --color-accent-orange: #ed6300;

            /* Radii */
            --radius-tags: 36px;
            --radius-cards: 28px;
            --radius-links: 10px;
            --radius-buttons: 980px;
        }

        body {
            font-family: 'Outfit', ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background-color: var(--color-canvas-white);
            color: var(--color-text-primary);
            overflow-x: hidden;
            letter-spacing: -0.01em;
        }
        
        /* Sidebar Styles */
        #sidebar-wrapper {
            min-height: 100vh;
            margin-left: -15rem;
            transition: margin .25s ease-out;
            background: var(--color-surface-frost);
            color: var(--color-text-primary);
            border-right: 1px solid #d2d2d7;
        }
        #sidebar-wrapper .sidebar-heading {
            padding: 1.5rem 1.25rem;
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--color-text-primary);
            border-bottom: 1px solid #d2d2d7;
        }
        #sidebar-wrapper .list-group {
            width: 15rem;
        }
        #sidebar-wrapper .list-group-item {
            background: transparent;
            color: var(--color-text-secondary);
            border: none;
            padding: 0.75rem 1.5rem;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s;
        }
        #sidebar-wrapper .list-group-item:hover, 
        #sidebar-wrapper .list-group-item.active {
            color: var(--color-text-primary);
            background: var(--color-interactive-grey);
            border-left: 4px solid var(--color-action-blue);
            font-weight: 600;
        }
        #sidebar-wrapper .list-group-item i {
            margin-right: 10px;
            width: 20px;
        }

        /* Page Content Styles */
        #page-content-wrapper {
            min-width: 100vw;
            background-color: var(--color-canvas-white);
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
            background: var(--color-canvas-white);
            border-bottom: 1px solid #d2d2d7;
            box-shadow: none;
        }

        /* Cards & Components */
        .card-stats {
            background-color: var(--color-surface-frost);
            border: none;
            border-radius: var(--radius-cards);
            transition: transform 0.3s cubic-bezier(0.25, 1, 0.5, 1);
        }
        .card-stats:hover {
            transform: scale(1.01);
        }
        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            background-color: var(--color-interactive-grey);
            color: var(--color-text-primary);
        }

        /* Override standard Bootstrap styles for Admin */
        .btn-primary {
            background-color: var(--color-action-blue) !important;
            color: var(--color-canvas-white) !important;
            border-radius: var(--radius-buttons) !important;
            border: none !important;
            font-weight: 600 !important;
            padding: 8px 18px !important;
        }
        .btn-primary:hover {
            opacity: 0.9 !important;
        }
        .btn-info {
            background-color: var(--color-interactive-grey) !important;
            color: var(--color-text-primary) !important;
            border-radius: var(--radius-buttons) !important;
            border: none !important;
            font-weight: 600 !important;
            padding: 6px 14px !important;
        }
        .btn-info:hover {
            opacity: 0.8 !important;
            color: var(--color-text-primary) !important;
        }
        .btn-danger {
            background-color: #ffeef0 !important;
            color: #ff3b30 !important;
            border-radius: var(--radius-buttons) !important;
            border: none !important;
            font-weight: 600 !important;
            padding: 6px 14px !important;
        }
        .btn-danger:hover {
            background-color: #ffdcd2 !important;
        }
        .btn-success {
            background-color: #e6f9ed !important;
            color: var(--color-success-green) !important;
            border-radius: var(--radius-buttons) !important;
            border: none !important;
            font-weight: 600 !important;
            padding: 8px 18px !important;
        }
        .btn-success:hover {
            opacity: 0.9 !important;
        }
        .btn-outline-success {
            background-color: transparent !important;
            color: var(--color-success-green) !important;
            border: 1px solid var(--color-success-green) !important;
            border-radius: var(--radius-buttons) !important;
            font-weight: 600 !important;
            padding: 8px 18px !important;
        }
        .btn-outline-success:hover {
            background-color: #e6f9ed !important;
        }
        .btn-dark {
            background-color: var(--color-text-primary) !important;
            color: var(--color-canvas-white) !important;
            border-radius: var(--radius-buttons) !important;
            border: none !important;
            font-weight: 600 !important;
        }
        .btn-dark:hover {
            opacity: 0.9 !important;
        }

        .form-control {
            background-color: var(--color-surface-frost) !important;
            color: var(--color-text-primary) !important;
            border: 1px solid transparent !important;
            border-radius: var(--radius-links) !important;
            font-size: 14px !important;
            padding: 10px 16px !important;
            height: auto !important;
            box-shadow: none !important;
        }
        .form-control:focus {
            background-color: var(--color-canvas-white) !important;
            border-color: var(--color-action-blue) !important;
        }

        .card {
            border: none !important;
            box-shadow: none !important;
            border-radius: var(--radius-cards) !important;
        }
        
        .table {
            border-collapse: separate;
            border-spacing: 0;
        }
        .table thead th {
            background-color: var(--color-surface-frost) !important;
            border-bottom: 1px solid #d2d2d7 !important;
            font-weight: 600 !important;
            color: var(--color-text-secondary) !important;
            text-transform: uppercase !important;
            font-size: 11px !important;
            letter-spacing: 0.5px !important;
            padding: 12px 16px !important;
        }
        .table td {
            border-bottom: 1px solid #e2e2e5 !important;
            font-size: 14px !important;
            color: var(--color-text-primary) !important;
            padding: 14px 16px !important;
        }
    </style>
</head>
<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <div class="sidebar-heading">
                <i class="fab fa-apple mr-2"></i>iStore Admin
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
                        <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=0071e3&color=fff" 
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
