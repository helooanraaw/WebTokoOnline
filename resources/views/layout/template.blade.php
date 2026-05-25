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
            --primary: #4F46E5; /* Indigo */
            --primary-hover: #4338CA;
            --secondary: #10B981; /* Emerald */
            --dark: #1F2937;
            --light: #F3F4F6;
        }
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #F9FAFB;
            color: #374151;
            padding-top: 80px; /* For fixed navbar */
        }
        
        /* Glassmorphism Navbar */
        .navbar-custom {
            background: rgba(255, 255, 255, 0.85) !important;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }
        .navbar-brand {
            font-weight: 700;
            color: var(--primary) !important;
            font-size: 1.5rem;
            letter-spacing: -0.5px;
        }
        .nav-link {
            font-weight: 500;
            color: #4B5563 !important;
            transition: color 0.3s ease;
            margin: 0 5px;
            border-radius: 8px;
        }
        .nav-link:hover, .nav-item.active .nav-link {
            color: var(--primary) !important;
            background-color: rgba(79, 70, 229, 0.05);
        }

        /* Hero Carousel */
        #carousel {
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            margin-bottom: 2rem;
        }
        .carousel-item img {
            object-fit: cover;
            height: 400px;
        }

        /* Section Titles */
        .section-title {
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 1.5rem;
            position: relative;
            display: inline-block;
        }
        .section-title::after {
            content: '';
            position: absolute;
            width: 50%;
            height: 4px;
            background: var(--primary);
            bottom: -8px;
            left: 25%;
            border-radius: 2px;
        }

        /* Product Cards */
        .card-custom {
            border: none;
            border-radius: 16px;
            background: white;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
            height: 100%;
        }
        .card-custom:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .card-custom img {
            height: 200px;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        .card-custom:hover img {
            transform: scale(1.05);
        }
        .card-body-custom {
            padding: 1.5rem;
        }
        .card-title-custom {
            font-weight: 600;
            font-size: 1.1rem;
            color: var(--dark);
            margin-bottom: 0.5rem;
        }
        .price-text {
            color: var(--primary);
            font-weight: 700;
            font-size: 1.2rem;
        }
        .price-strike {
            color: #9CA3AF;
            font-size: 0.9rem;
            text-decoration: line-through;
            margin-right: 8px;
        }

        /* Footer */
        .footer-custom {
            background: var(--dark);
            color: white;
            padding: 3rem 0 1.5rem;
            margin-top: 4rem;
        }
        .footer-custom p {
            color: #9CA3AF;
        }
        
        /* Buttons */
        .btn-custom {
            background-color: var(--primary);
            color: white;
            border-radius: 8px;
            padding: 0.5rem 1.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
        }
        .btn-custom:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
            color: white;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
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