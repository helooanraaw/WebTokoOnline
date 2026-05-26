<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <title>{{ $title ?? 'Toko Online' }}</title>
    <style>
        :root {
            --primary: #0071e3; /* Apple Blue */
            --primary-hover: #0077ed;
            --secondary: #86868b; /* Apple text gray */
            --dark: #1d1d1f; /* Apple menu dark gray */
            --light: #f5f5f7; /* Apple store background */
            --white: #ffffff;
        }
        body {
            font-family: 'Outfit', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background-color: var(--light);
            color: var(--dark);
            padding-top: 56px; /* For fixed navbar */
            letter-spacing: -0.01em;
        }
        
        /* Apple Premium Glassmorphism Navbar */
        .navbar-custom {
            background: rgba(22, 22, 23, 0.8) !important;
            backdrop-filter: saturate(180%) blur(20px);
            -webkit-backdrop-filter: saturate(180%) blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: none;
            transition: all 0.3s ease;
            height: 56px;
        }
        .navbar-brand {
            font-weight: 600;
            color: #f5f5f7 !important;
            font-size: 1.15rem;
            letter-spacing: -0.5px;
            transition: opacity 0.2s ease;
        }
        .navbar-brand:hover {
            opacity: 0.8;
        }
        .nav-link {
            font-weight: 400;
            color: #cccccc !important;
            font-size: 0.85rem;
            transition: color 0.2s ease;
            margin: 0 10px;
            border-radius: 0;
            padding: 4px 0;
        }
        .nav-link:hover, .nav-item.active .nav-link {
            color: #ffffff !important;
            background-color: transparent !important;
        }

        /* Section Titles */
        .section-title {
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 2rem;
            letter-spacing: -0.02em;
            font-size: 2rem;
        }

        /* Apple Style Product Cards */
        .card-custom {
            border: none;
            border-radius: 18px;
            background: var(--white);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
            transition: all 0.4s cubic-bezier(0.25, 1, 0.5, 1);
            overflow: hidden;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        .card-custom:hover {
            transform: scale(1.02);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
        }
        .card-custom .img-wrapper {
            background-color: #fafafa;
            padding: 2rem 1.5rem 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 250px;
        }
        .card-custom img {
            max-height: 220px;
            max-width: 100%;
            width: auto;
            object-fit: contain;
            transition: transform 0.4s cubic-bezier(0.25, 1, 0.5, 1);
        }
        .card-custom:hover img {
            transform: scale(1.03);
        }
        .card-body-custom {
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
            justify-content: space-between;
        }
        .card-title-custom {
            font-weight: 600;
            font-size: 1.25rem;
            color: var(--dark);
            margin-bottom: 0.4rem;
            letter-spacing: -0.015em;
        }
        .price-text {
            color: var(--dark);
            font-weight: 600;
            font-size: 1.15rem;
        }
        .price-strike {
            color: var(--secondary);
            font-size: 0.9rem;
            text-decoration: line-through;
            margin-right: 8px;
        }

        /* Footer */
        .footer-custom {
            background: #f5f5f7;
            color: #86868b;
            padding: 3rem 0 2rem;
            margin-top: 5rem;
            font-size: 0.75rem;
            border-top: 1px solid #d2d2d7;
        }
        .footer-custom a {
            color: #515154;
            text-decoration: none;
            transition: color 0.2s ease;
        }
        .footer-custom a:hover {
            color: var(--primary);
            text-decoration: underline;
        }
        .footer-custom hr {
            border-top: 1px solid #d2d2d7;
            margin: 1.5rem 0;
        }
        
        /* Buttons - Pill shaped Apple buttons */
        .btn-custom {
            background-color: var(--primary);
            color: #ffffff;
            border-radius: 99px;
            padding: 0.4rem 1.2rem;
            font-weight: 500;
            font-size: 0.85rem;
            transition: all 0.2s ease;
            border: none;
        }
        .btn-custom:hover {
            background-color: var(--primary-hover);
            color: #ffffff;
            box-shadow: none;
        }
        .btn-pill-dark {
            background-color: #1d1d1f;
            color: #ffffff;
            border-radius: 99px;
            padding: 0.5rem 1.5rem;
            font-weight: 500;
            transition: all 0.2s ease;
            border: none;
        }
        .btn-pill-dark:hover {
            background-color: #333336;
        }
    </style>
</head>
<body>
    @include('layout.menu')

    @yield('content')

    @include('layout.footer')

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>