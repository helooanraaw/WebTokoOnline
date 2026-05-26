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
            /* Colors */
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
            --color-accent-teal: #00a1b3;
            --color-accent-deep-green: #03873a;

            /* Typography Families */
            --font-sf-pro-text: 'SF Pro Text', ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Outfit", sans-serif;
            --font-sf-pro-display: 'SF Pro Display', ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Outfit", sans-serif;

            /* Radii */
            --radius-tags: 36px;
            --radius-cards: 28px;
            --radius-links: 10px;
            --radius-buttons: 980px;

            /* Layout */
            --section-gap: 89px;
            --card-padding: 28px;
            --element-gap: 10px;
        }

        body {
            font-family: var(--font-sf-pro-text);
            background-color: var(--color-canvas-white);
            color: var(--color-text-primary);
            padding-top: 48px; /* navbar height */
            letter-spacing: -0.01em;
            -webkit-font-smoothing: antialiased;
        }

        /* Typography Scale classes */
        .text-caption {
            font-size: 12px;
            line-height: 1.47;
            letter-spacing: -0.003px;
        }
        .text-body {
            font-size: 14px;
            line-height: 1.43;
            letter-spacing: -0.01px;
        }
        .text-body-lg {
            font-size: 17px;
            line-height: 1.24;
            letter-spacing: -0.016px;
        }
        .text-subheading {
            font-size: 20px;
            line-height: 1.18;
            letter-spacing: -0.019px;
        }
        .text-heading-lg {
            font-size: 24px;
            line-height: 1.17;
            letter-spacing: 0.009px;
        }
        .text-display-md {
            font-family: var(--font-sf-pro-display);
            font-size: 39px;
            line-height: 1.07;
            letter-spacing: -0.005px;
            font-weight: 600;
        }
        .text-display-lg {
            font-family: var(--font-sf-pro-display);
            font-size: 44px;
            line-height: 1.00;
            letter-spacing: -0.022px;
            font-weight: 600;
        }
        .text-display-xl {
            font-family: var(--font-sf-pro-display);
            font-size: 64px;
            line-height: 1.06;
            letter-spacing: -0.009px;
            font-weight: 600;
        }

        /* Apple España Components */
        
        /* Primary Filled Button */
        .btn-primary-filled {
            background-color: var(--color-action-blue);
            color: var(--color-canvas-white) !important;
            border-radius: var(--radius-buttons);
            padding: 8px 15px;
            font-family: var(--font-sf-pro-text);
            font-size: 14px;
            font-weight: 600;
            border: none;
            display: inline-block;
            text-align: center;
            transition: opacity 0.2s ease;
            cursor: pointer;
            text-decoration: none;
        }
        .btn-primary-filled:hover {
            opacity: 0.9;
            text-decoration: none;
        }
        
        /* Outline Text Button */
        .btn-outline-text {
            background-color: transparent;
            color: var(--color-text-primary) !important;
            border: 1px solid var(--color-text-primary);
            border-radius: 28px;
            padding: 8px 16px;
            font-family: var(--font-sf-pro-text);
            font-size: 14px;
            font-weight: 600;
            display: inline-block;
            transition: background-color 0.2s ease;
            cursor: pointer;
            text-decoration: none;
        }
        .btn-outline-text:hover {
            background-color: var(--color-surface-frost);
            text-decoration: none;
        }

        /* Ghost Button */
        .btn-ghost-custom {
            background-color: var(--color-interactive-grey);
            color: var(--color-text-secondary) !important;
            border-radius: var(--radius-tags);
            padding: 8px 16px;
            font-family: var(--font-sf-pro-text);
            font-size: 14px;
            font-weight: 600;
            border: none;
            display: inline-block;
            transition: opacity 0.2s ease;
            cursor: pointer;
            text-decoration: none;
        }
        .btn-ghost-custom:hover {
            opacity: 0.8;
            text-decoration: none;
        }

        /* Informational Card White */
        .card-white {
            background-color: var(--color-canvas-white) !important;
            border-radius: var(--radius-cards) !important;
            border: none !important;
            box-shadow: none !important;
        }

        /* Informational Card Frost */
        .card-frost {
            background-color: var(--color-surface-frost) !important;
            border-radius: var(--radius-cards) !important;
            border: none !important;
            box-shadow: none !important;
        }

        /* Feature Badge */
        .badge-feature {
            background-color: var(--color-surface-frost);
            color: var(--color-text-primary);
            font-size: 12px;
            font-weight: 600;
            padding: 4px 8px;
            border-radius: 4px;
            display: inline-block;
        }

        /* Apple España Crisp White Navbar */
        .navbar-custom {
            background: rgba(255, 255, 255, 0.8) !important;
            backdrop-filter: saturate(180%) blur(20px);
            -webkit-backdrop-filter: saturate(180%) blur(20px);
            border-bottom: 1px solid #d2d2d7;
            box-shadow: none;
            transition: all 0.3s ease;
            height: 48px; /* Classic Apple compact navbar */
        }
        .navbar-brand {
            font-weight: 600;
            color: var(--color-text-primary) !important;
            font-size: 14px;
            letter-spacing: -0.2px;
            transition: opacity 0.2s ease;
        }
        .navbar-brand:hover {
            opacity: 0.8;
        }
        .nav-link {
            font-weight: 400;
            color: var(--color-text-secondary) !important;
            font-size: 12px;
            transition: color 0.2s ease;
            margin: 0 12px;
            padding: 4px 0;
        }
        .nav-link:hover, .nav-item.active .nav-link {
            color: var(--color-text-primary) !important;
            background-color: transparent !important;
        }

        /* Card Custom overrides */
        .card-custom {
            border: none;
            border-radius: var(--radius-cards);
            background: var(--color-canvas-white);
            box-shadow: none;
            transition: transform 0.3s cubic-bezier(0.25, 1, 0.5, 1);
            overflow: hidden;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        .card-custom:hover {
            transform: scale(1.01);
        }
        .card-custom .img-wrapper {
            background-color: var(--color-surface-frost);
            padding: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 240px;
            border-radius: var(--radius-cards);
        }
        .card-custom img {
            max-height: 200px;
            max-width: 100%;
            width: auto;
            object-fit: contain;
            transition: transform 0.3s ease;
        }
        .card-body-custom {
            padding: 20px 8px 8px; /* Comfortable layout gap */
            display: flex;
            flex-direction: column;
            flex-grow: 1;
            justify-content: space-between;
        }
        .card-title-custom {
            font-weight: 600;
            font-size: 17px;
            color: var(--color-text-primary);
            margin-bottom: 4px;
            letter-spacing: -0.015em;
        }
        .price-text {
            color: var(--color-text-primary);
            font-weight: 600;
            font-size: 14px;
        }
        .price-strike {
            color: var(--color-text-secondary);
            font-size: 12px;
            text-decoration: line-through;
            margin-right: 8px;
        }

        /* Section gaps from DESIGN.md */
        .section-gap {
            margin-bottom: var(--section-gap);
        }

        /* Override Bootstrap Form Control */
        .form-control {
            background-color: var(--color-surface-frost) !important;
            color: var(--color-text-primary) !important;
            border: 1px solid transparent !important;
            border-radius: var(--radius-links) !important;
            font-family: var(--font-sf-pro-text) !important;
            font-size: 14px !important;
            height: auto !important;
            padding: 10px 16px !important;
            transition: all 0.2s ease-in-out !important;
            box-shadow: none !important;
        }
        .form-control:focus {
            background-color: var(--color-canvas-white) !important;
            border-color: var(--color-action-blue) !important;
        }
        .form-control[readonly], .form-control[disabled] {
            background-color: var(--color-interactive-grey) !important;
            opacity: 0.8;
            color: var(--color-text-secondary) !important;
        }
        select.form-control {
            height: auto !important;
            appearance: none;
            -webkit-appearance: none;
            background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3E%3Cpath fill='none' stroke='%23707070' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3E%3C/svg%3E") !important;
            background-repeat: no-repeat !important;
            background-position: right 16px center !important;
            background-size: 12px 12px !important;
            padding-right: 40px !important;
        }
        
        /* Override default card styles */
        .card {
            border: none !important;
            box-shadow: none !important;
            border-radius: var(--radius-cards) !important;
        }

        /* Footer styling */
        .footer-custom {
            background: var(--color-surface-frost);
            color: var(--color-text-muted);
            padding: 40px 0 24px;
            margin-top: var(--section-gap);
            font-size: 12px;
            border-top: 1px solid #d2d2d7;
            line-height: 1.5;
        }
        .footer-custom a {
            color: var(--color-text-muted);
            text-decoration: none;
            transition: color 0.2s ease;
        }
        .footer-custom a:hover {
            color: var(--color-link-blue);
            text-decoration: underline;
        }
        .footer-custom hr {
            border-top: 1px solid #d2d2d7;
            margin: 20px 0;
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