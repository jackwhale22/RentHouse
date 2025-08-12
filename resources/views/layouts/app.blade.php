<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Kos Finder')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #3b82f6;
            --primary-light: #60a5fa;
            --primary-dark: #1e40af;
            --secondary-color: #10b981;
            --secondary-light: #34d399;
            --accent-color: #f59e0b;
            --accent-light: #fbbf24;
            --success-color: #059669;
            --info-color: #0ea5e9;
            --warning-color: #d97706;
            --danger-color: #dc2626;
            --dark-color: #1f2937;
            --light-color: #f8fafc;
            --white: #ffffff;
            
            /* Glass morphism variables */
            --glass-bg: rgba(255, 255, 255, 0.08);
            --glass-bg-light: rgba(255, 255, 255, 0.12);
            --glass-bg-dark: rgba(255, 255, 255, 0.05);
            --glass-border: rgba(255, 255, 255, 0.18);
            --glass-shadow: 0 8px 32px rgba(31, 38, 135, 0.37);
            --glass-shadow-hover: 0 20px 60px rgba(31, 38, 135, 0.5);
            
            /* Gradients */
            --gradient-primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --gradient-secondary: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --gradient-accent: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
            --gradient-success: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            --gradient-info: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --gradient-background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #4facfe 100%);
            
            /* Sidebar variables */
            --sidebar-width: 280px;
            --sidebar-collapsed-width: 80px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', sans-serif;
            font-weight: 400;
            line-height: 1.6;
            color: var(--dark-color);
            background: var(--gradient-background);
            min-height: 100vh;
            position: relative;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 20% 80%, rgba(120, 119, 198, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 119, 198, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(120, 219, 255, 0.1) 0%, transparent 50%);
            z-index: -1;
            pointer-events: none;
        }

        /* Glassmorphism Navbar (for guests) */
        .glass-navbar {
            background: var(--glass-bg);
            backdrop-filter: blur(25px);
            border: none;
            border-bottom: 1px solid var(--glass-border);
            box-shadow: var(--glass-shadow);
            padding: 1rem 0;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1050;
            transition: all 0.3s ease;
        }

        .glass-navbar.scrolled {
            background: var(--glass-bg-light);
            box-shadow: var(--glass-shadow-hover);
        }

        .navbar-brand {
            font-family: 'Poppins', sans-serif;
            font-weight: 800;
            font-size: 1.5rem;
            color: var(--white) !important;
            text-decoration: none;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
        }

        .navbar-brand:hover {
            color: var(--white) !important;
            transform: scale(1.05);
        }

        .navbar-brand i {
            background: var(--gradient-secondary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-size: 1.4rem;
            margin-right: 0.5rem;
        }

        .navbar-toggler {
            border: none;
            padding: 0.5rem;
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .navbar-toggler:focus {
            box-shadow: none;
            outline: 2px solid rgba(255, 255, 255, 0.3);
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 0.8%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='m4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            font-size: 0.95rem;
            padding: 0.75rem 1rem;
            border-radius: 50px;
            margin: 0 0.25rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .navbar-nav .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.6s ease;
        }

        .navbar-nav .nav-link:hover::before {
            left: 100%;
        }

        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            color: var(--white) !important;
            background: var(--glass-bg-light);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .navbar-nav .nav-link.active {
            background: var(--gradient-primary);
            font-weight: 600;
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--glass-bg);
            backdrop-filter: blur(25px);
            border-right: 1px solid var(--glass-border);
            box-shadow: var(--glass-shadow);
            z-index: 1050;
            transition: all 0.3s ease;
            transform: translateX(0);
        }

        .sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
        }

        .sidebar-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--glass-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .sidebar-brand {
            font-family: 'Poppins', sans-serif;
            font-weight: 800;
            font-size: 1.5rem;
            color: var(--white);
            text-decoration: none;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
        }

        .sidebar-brand:hover {
            color: var(--white);
        }

        .sidebar-brand i {
            background: var(--gradient-secondary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-size: 1.4rem;
            margin-right: 0.5rem;
            min-width: 1.4rem;
        }

        .sidebar-brand .brand-text {
            transition: all 0.3s ease;
        }

        .sidebar.collapsed .brand-text {
            opacity: 0;
            width: 0;
            overflow: hidden;
        }

        .sidebar-toggle {
            background: transparent;
            border: none;
            color: var(--white);
            font-size: 1.2rem;
            padding: 0.5rem;
            border-radius: 10px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .sidebar-toggle:hover {
            background: var(--glass-bg-light);
            transform: scale(1.1);
        }

        .sidebar-nav {
            list-style: none;
            padding: 0;
            margin: 0;
            padding-top: 1rem;
        }

        .sidebar-nav .nav-item {
            margin: 0.25rem 0;
        }

        .sidebar-nav .nav-link {
            display: flex;
            align-items: center;
            padding: 1rem 1.5rem;
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            border-radius: 0 25px 25px 0;
            margin-right: 1rem;
            position: relative;
            overflow: hidden;
        }

        .sidebar-nav .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transition: left 0.6s ease;
        }

        .sidebar-nav .nav-link:hover::before {
            left: 100%;
        }

        .sidebar-nav .nav-link i {
            font-size: 1.1rem;
            margin-right: 1rem;
            min-width: 1.1rem;
            text-align: center;
        }

        .sidebar-nav .nav-link .nav-text {
            transition: all 0.3s ease;
        }

        .sidebar.collapsed .nav-text {
            opacity: 0;
            width: 0;
            overflow: hidden;
        }

        .sidebar-nav .nav-link:hover {
            background: var(--glass-bg-light);
            color: var(--white);
            transform: translateX(5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .sidebar-nav .nav-link.active {
            background: var(--gradient-primary);
            color: var(--white);
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        .sidebar-user {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 1rem 1.5rem;
            border-top: 1px solid var(--glass-border);
            background: var(--glass-bg-dark);
        }

        .user-info {
            display: flex;
            align-items: center;
            color: var(--white);
            margin-bottom: 1rem;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--gradient-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            font-size: 1.2rem;
            color: var(--white);
            min-width: 40px;
        }

        .user-details {
            transition: all 0.3s ease;
        }

        .sidebar.collapsed .user-details {
            opacity: 0;
            width: 0;
            overflow: hidden;
        }

        .user-name {
            font-weight: 600;
            font-size: 0.9rem;
            margin: 0;
        }

        .user-role {
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.7);
            margin: 0;
        }

        .sidebar-logout {
            width: 100%;
            background: transparent;
            border: 1px solid var(--glass-border);
            color: rgba(255, 255, 255, 0.9);
            padding: 0.75rem;
            border-radius: 10px;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .sidebar-logout:hover {
            background: var(--glass-bg-light);
            color: var(--white);
            border-color: rgba(255, 255, 255, 0.3);
        }

        /* Content area when sidebar is active */
        .sidebar-active {
            margin-left: var(--sidebar-width);
            transition: all 0.3s ease;
        }

        .sidebar-active.collapsed {
            margin-left: var(--sidebar-collapsed-width);
        }

        /* Main Content */
        .main-content {
            padding-top: 90px;
            min-height: 100vh;
            transition: all 0.3s ease;
        }

        .main-content.with-sidebar {
            padding-top: 2rem;
        }

        /* Mobile Sidebar */
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1040;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .sidebar-overlay.show {
            opacity: 1;
            visibility: visible;
        }

        /* Mobile responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .sidebar-active {
                margin-left: 0;
            }

            .sidebar-active.collapsed {
                margin-left: 0;
            }

            .mobile-toggle {
                position: fixed;
                top: 20px;
                left: 20px;
                z-index: 1060;
                background: var(--glass-bg);
                backdrop-filter: blur(25px);
                border: 1px solid var(--glass-border);
                color: var(--white);
                padding: 0.75rem;
                border-radius: 10px;
                font-size: 1.1rem;
                box-shadow: var(--glass-shadow);
            }

            .main-content.with-sidebar {
                padding-top: 90px;
            }

            .navbar-nav {
                background: var(--glass-bg-light);
                backdrop-filter: blur(25px);
                border-radius: 15px;
                padding: 1rem;
                margin-top: 1rem;
            }

            .navbar-nav .nav-link {
                margin: 0.25rem 0;
                text-align: center;
            }
        }

        /* Dropdown Styles */
        .dropdown-menu {
            background: var(--glass-bg);
            backdrop-filter: blur(25px);
            border: 1px solid var(--glass-border);
            border-radius: 15px;
            box-shadow: var(--glass-shadow);
            padding: 0.5rem;
            margin-top: 0.5rem;
        }

        .dropdown-item {
            color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 0.75rem 1rem;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
            background: transparent;
        }

        .dropdown-item:hover,
        .dropdown-item:focus {
            background: var(--glass-bg-light);
            color: var(--white);
            transform: translateX(5px);
        }

        .dropdown-divider {
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            margin: 0.5rem 0;
        }

        /* Alert Styles */
        .alert {
            background: var(--glass-bg);
            backdrop-filter: blur(25px);
            border: 1px solid var(--glass-border);
            border-radius: 15px;
            color: var(--white);
            font-weight: 500;
        }

        .alert-success {
            background: rgba(17, 153, 142, 0.2);
            border-color: rgba(17, 153, 142, 0.3);
        }

        .alert-danger {
            background: rgba(220, 38, 38, 0.2);
            border-color: rgba(220, 38, 38, 0.3);
        }

        .btn-close {
            filter: brightness(0) invert(1);
            opacity: 0.8;
        }

        .btn-close:hover {
            opacity: 1;
        }

        /* Card Improvements */
        .card {
            background: var(--glass-bg);
            backdrop-filter: blur(25px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            box-shadow: var(--glass-shadow);
            transition: all 0.3s ease;
            color: var(--white);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: var(--glass-shadow-hover);
            background: var(--glass-bg-light);
        }

        .card-header {
            background: transparent;
            border-bottom: 1px solid var(--glass-border);
            color: var(--white);
            font-weight: 600;
        }

        .card-body {
            color: rgba(255, 255, 255, 0.9);
        }

        /* Button Styles */
        .btn-primary {
            background: var(--gradient-primary);
            border: none;
            border-radius: 50px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            color: var(--white);
        }

        .btn-primary:hover {
            background: var(--gradient-primary);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
            color: var(--white);
        }

        .btn-outline-primary {
            border: 2px solid rgba(255, 255, 255, 0.3);
            color: var(--white);
            background: transparent;
            border-radius: 50px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-outline-primary:hover {
            background: var(--glass-bg-light);
            border-color: rgba(255, 255, 255, 0.5);
            color: var(--white);
            transform: translateY(-2px);
        }

        /* Form Controls */
        .form-control {
            background: var(--glass-bg);
            backdrop-filter: blur(15px);
            border: 1px solid var(--glass-border);
            border-radius: 15px;
            color: var(--white);
            padding: 0.75rem 1rem;
        }

        .form-control:focus {
            background: var(--glass-bg-light);
            border-color: rgba(255, 255, 255, 0.5);
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.2);
            color: var(--white);
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        .form-label {
            color: var(--white);
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        /* Typography */
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            color: var(--white);
        }

        /* Scrollbar Styling */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--gradient-primary);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--gradient-secondary);
        }

        /* Loading Animation */
        @keyframes shimmer {
            0% {
                background-position: -468px 0;
            }
            100% {
                background-position: 468px 0;
            }
        }

        .loading {
            animation: shimmer 1.5s ease-in-out infinite;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            background-size: 468px 100%;
        }

        /* Accessibility */
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }

        /* Focus states */
        .navbar-nav .nav-link:focus,
        .sidebar-nav .nav-link:focus,
        .dropdown-item:focus,
        .btn:focus {
            outline: 2px solid rgba(255, 255, 255, 0.5);
            outline-offset: 2px;
        }

        /* Text Selection */
        ::selection {
            background: rgba(255, 255, 255, 0.2);
            color: var(--white);
        }
    </style>
    
    @stack('styles')
</head>
<body class="@auth sidebar-active @endauth">

    @guest
        <!-- Glassmorphism Navigation for guests -->
        <nav class="navbar navbar-expand-lg glass-navbar">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <i class="fas fa-home"></i>Kos Finder
                </a>
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt me-2"></i>Masuk
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">
                                <i class="fas fa-user-plus me-2"></i>Daftar
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    @else
        <!-- Sidebar for authenticated users -->
        <div class="sidebar-overlay" id="sidebarOverlay"></div>
        
        <!-- Mobile toggle button -->
        <button class="mobile-toggle d-lg-none" id="mobileToggle">
            <i class="fas fa-bars"></i>
        </button>

        <div class="sidebar" id="sidebar">
            <!-- Sidebar Header -->
            <div class="sidebar-header">
                <a href="{{ route('home') }}" class="sidebar-brand">
                    <i class="fas fa-home"></i>
                    <span class="brand-text">Kos Finder</span>
                </a>
                <button class="sidebar-toggle d-none d-lg-block" id="sidebarToggle">
                    <i class="fas fa-chevron-left"></i>
                </button>
            </div>

            <!-- Sidebar Navigation -->
            <ul class="sidebar-nav">
                @if(auth()->user()->isAdmin())
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-tachometer-alt"></i>
                            <span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.users') ? 'active' : '' }}" href="{{ route('admin.users') }}">
                            <i class="fas fa-users"></i>
                            <span class="nav-text">Pengguna</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.verify-kos') ? 'active' : '' }}" href="{{ route('admin.verify-kos') }}">
                            <i class="fas fa-check-circle"></i>
                            <span class="nav-text">Verifikasi Kos</span>
                        </a>
                    </li>
                @elseif(auth()->user()->isPemilik())
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('pemilik.dashboard') ? 'active' : '' }}" href="{{ route('pemilik.dashboard') }}">
                            <i class="fas fa-tachometer-alt"></i>
                            <span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('pemilik.my-kos') ? 'active' : '' }}" href="{{ route('pemilik.my-kos') }}">
                            <i class="fas fa-building"></i>
                            <span class="nav-text">Kos Saya</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('pemilik.kos.create') ? 'active' : '' }}" href="{{ route('pemilik.kos.create') }}">
                            <i class="fas fa-plus-circle"></i>
                            <span class="nav-text">Tambah Kos</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('pemilik.messages') ? 'active' : '' }}" href="{{ route('pemilik.messages') }}">
                            <i class="fas fa-envelope"></i>
                            <span class="nav-text">Kelola Pesan</span>
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                            <i class="fas fa-tachometer-alt"></i>
                            <span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('search') ? 'active' : '' }}" href="{{ route('search') }}">
                            <i class="fas fa-search"></i>
                            <span class="nav-text">Cari Kos</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('my-transaksi') ? 'active' : '' }}" href="{{ route('my-transaksi') }}">
                            <i class="fas fa-receipt"></i>
                            <span class="nav-text">Transaksi Saya</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('my-messages') ? 'active' : '' }}" href="{{ route('my-messages') }}">
                            <i class="fas fa-comments"></i>
                            <span class="nav-text">Pesan Saya</span>
                        </a>
                    </li>
                @endif
                
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('profile') ? 'active' : '' }}" href="{{ route('profile') }}">
                        <i class="fas fa-user-edit"></i>
                        <span class="nav-text">Profil</span>
                    </a>
                </li>
            </ul>

            <!-- Sidebar User -->
            <div class="sidebar-user">
                <div class="user-info">
                    <div class="user-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="user-details">
                        <p class="user-name">{{ auth()->user()->name }}</p>
                        <p class="user-role">
                            @if(auth()->user()->isAdmin())
                                Administrator
                            @elseif(auth()->user()->isPemilik())
                                Pemilik Kos
                            @else
                                Pencari Kos
                            @endif
                        </p>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="sidebar-logout">
                        <i class="fas fa-sign-out-alt me-2"></i>
                        <span class="nav-text">Keluar</span>
                    </button>
                </form>
            </div>
        </div>
    @endauth

    <!-- Main Content -->
    <main class="main-content @auth with-sidebar @endauth">
        @if(session('success'))
            <div class="container mt-3">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="container mt-3">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebarToggle');
            const mobileToggle = document.getElementById('mobileToggle');
            const sidebarOverlay = document.getElementById('sidebarOverlay');
            const body = document.body;

            // Desktop sidebar toggle
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('collapsed');
                    body.classList.toggle('collapsed');
                    
                    // Change icon
                    const icon = this.querySelector('i');
                    if (sidebar.classList.contains('collapsed')) {
                        icon.className = 'fas fa-chevron-right';
                    } else {
                        icon.className = 'fas fa-chevron-left';
                    }
                });
            }

            // Mobile sidebar toggle
            if (mobileToggle) {
                mobileToggle.addEventListener('click', function() {
                    sidebar.classList.add('show');
                    sidebarOverlay.classList.add('show');
                    body.style.overflow = 'hidden';
                });
            }

            // Close sidebar on overlay click (mobile)
            if (sidebarOverlay) {
                sidebarOverlay.addEventListener('click', function() {
                    sidebar.classList.remove('show');
                    sidebarOverlay.classList.remove('show');
                    body.style.overflow = '';
                });
            }

            // Close sidebar on escape key (mobile)
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && sidebar.classList.contains('show')) {
                    sidebar.classList.remove('show');
                    sidebarOverlay.classList.remove('show');
                    body.style.overflow = '';
                }
            });

            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 992) {
                    sidebar.classList.remove('show');
                    sidebarOverlay.classList.remove('show');
                    body.style.overflow = '';
                }
            });
        });

        // Navbar scroll effect (for guests)
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.glass-navbar');
            if (navbar) {
                if (window.scrollY > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            }
        });

        // Auto-hide alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                setTimeout(function() {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 5000);
            });
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add loading animation to forms
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function() {
                const submitBtn = form.querySelector('button[type="submit"]');
                if (submitBtn && !submitBtn.disabled) {
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memproses...';
                    submitBtn.disabled = true;
                }
            });
        });

        // Add ripple effect to buttons
        document.querySelectorAll('.btn, .sidebar-nav .nav-link').forEach(button => {
            button.addEventListener('click', function(e) {
                const ripple = document.createElement('span');
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;
                
                ripple.style.cssText = `
                    position: absolute;
                    border-radius: 50%;
                    background: rgba(255, 255, 255, 0.3);
                    transform: scale(0);
                    animation: ripple 0.6s linear;
                    width: ${size}px;
                    height: ${size}px;
                    left: ${x}px;
                    top: ${y}px;
                    pointer-events: none;
                `;
                
                this.style.position = 'relative';
                this.style.overflow = 'hidden';
                this.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });

        // Add ripple animation keyframes
        const style = document.createElement('style');
        style.textContent = `
            @keyframes ripple {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    </script>

    @stack('scripts')
</body>
</html>