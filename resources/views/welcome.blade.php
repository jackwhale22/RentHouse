@extends('layouts.app')

@section('title', 'Welcome to Kos Finder')

@section('content')
    <div class="container-fluid p-0 glassmorphism-page">
        <!-- Hero Section with Animated Background -->
        <div class="hero-section position-relative">
            <!-- Animated Background Elements -->
            <div class="bg-animations">
                <div class="floating-element floating-1"></div>
                <div class="floating-element floating-2"></div>
                <div class="floating-element floating-3"></div>
                <div class="floating-element floating-4"></div>
                <div class="floating-element floating-5"></div>
                <div class="floating-element floating-6"></div>
            </div>

            <div class="container position-relative">
                <div class="row align-items-center min-vh-100 py-5">
                    <div class="col-lg-6">
                        <div class="hero-content">
                            <h1 class="hero-title mb-4">
                                Temukan <span class="gradient-text">Kos</span>
                                Impian Anda
                            </h1>
                            <p class="hero-subtitle mb-4">
                                Temukan rumah kos yang nyaman dan terjangkau di sekitar Anda.
                                Hubungi langsung dengan pemilik dan dapatkan tempat tinggal ideal.
                            </p>

                            <!-- Glassmorphism Search Form -->
                            <div class="glass-card search-card mb-4">
                                <form action="{{ route('public.search') }}" method="GET">
                                    <div class="row g-3">
                                        <div class="col-md-8">
                                            <div class="glass-input-group">
                                                <i class="fas fa-search input-icon"></i>
                                                <input type="text" class="glass-input" name="search"
                                                    placeholder="Cari berdasarkan nama kos atau lokasi..."
                                                    value="{{ request('search') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <button type="submit" class="btn glass-btn glass-btn-primary w-100">
                                                <i class="fas fa-search me-2"></i>Cari
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            @guest
                                <div class="hero-actions">
                                    <a href="{{ route('register') }}" class="btn glass-btn glass-btn-primary me-3">
                                        <i class="fas fa-rocket me-2"></i>Mulai Sekarang
                                    </a>
                                    <a href="{{ route('login') }}" class="btn glass-btn glass-btn-outline">
                                        <i class="fas fa-sign-in-alt me-2"></i>Masuk
                                    </a>
                                </div>
                            @else
                                <div class="hero-actions">
                                    <a href="{{ route('search') }}" class="btn glass-btn glass-btn-primary">
                                        <i class="fas fa-search me-2"></i>Pencarian Lanjutan
                                    </a>
                                </div>
                            @endguest
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="hero-visual">
                            <div class="glass-circle">
                                <i class="fas fa-home hero-icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Section -->
        <div class="stats-section py-5">
            <div class="container">
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="glass-card stat-card text-center">
                            <div class="stat-icon primary">
                                <i class="fas fa-home"></i>
                            </div>
                            <h3 class="stat-number">{{ $totalKos }}</h3>
                            <p class="stat-label">Kos Terverifikasi</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="glass-card stat-card text-center">
                            <div class="stat-icon success">
                                <i class="fas fa-users"></i>
                            </div>
                            <h3 class="stat-number">{{ $totalOwners }}</h3>
                            <p class="stat-label">Pemilik Terpercaya</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="glass-card stat-card text-center">
                            <div class="stat-icon info">
                                <i class="fas fa-heart"></i>
                            </div>
                            <h3 class="stat-number">{{ \App\Models\User::where('role', 'penyewa')->count() }}</h3>
                            <p class="stat-label">Penyewa Puas</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Featured Kos Section -->
        @if($featuredKos->count() > 0)
            <div class="featured-section py-5">
                <div class="container">
                    <div class="section-header text-center mb-5">
                        <h2 class="section-title">Kos <span class="gradient-text">Unggulan</span></h2>
                        <p class="section-subtitle">Listing kos terbaru dan terverifikasi</p>
                    </div>

                    <div class="row g-4">
                        @foreach($featuredKos as $kos)
                            <div class="col-lg-4 col-md-6">
                                <div class="glass-card kos-card h-100">
                                    <div class="kos-image-container">
                                        @if($kos->mainPhoto)
                                            <img src="{{ asset($kos->mainPhoto->foto_path) }}" class="kos-image" alt="{{ $kos->nama_kos }}">
                                        @else
                                            <div class="kos-image-placeholder">
                                                <i class="fas fa-home"></i>
                                            </div>
                                        @endif
                                        <div class="image-overlay">
                                            <span class="verified-badge">
                                                <i class="fas fa-check-circle me-1"></i>Terverifikasi
                                            </span>
                                        </div>
                                    </div>

                                    <div class="kos-content">
                                        <h5 class="kos-title">{{ $kos->nama_kos }}</h5>

                                        <div class="kos-location mb-3">
                                            <i class="fas fa-map-marker-alt me-2"></i>
                                            <span>{{ Str::limit($kos->lokasi, 40) }}</span>
                                        </div>

                                        <div class="kos-price mb-3">
                                            <span class="price-amount">Rp {{ number_format($kos->harga, 0, ',', '.') }}</span>
                                            <span class="price-period">/bulan</span>
                                        </div>

                                        @if($kos->fasilitas)
                                            <div class="kos-facilities mb-3">
                                                <i class="fas fa-star me-2"></i>
                                                <span>{{ Str::limit($kos->fasilitas, 50) }}</span>
                                            </div>
                                        @endif

                                        <div class="kos-owner mb-3">
                                            <i class="fas fa-user me-2"></i>
                                            <span>{{ $kos->pemilik->name }}</span>
                                        </div>
                                    </div>

                                    <div class="kos-footer">
                                        <a href="{{ route('public.kos.show', $kos->id) }}"
                                            class="btn glass-btn glass-btn-primary w-100">
                                            <i class="fas fa-eye me-2"></i>Lihat Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="text-center mt-5">
                        <a href="{{ route('public.search') }}" class="btn glass-btn glass-btn-outline glass-btn-lg">
                            <i class="fas fa-th me-2"></i>Lihat Semua Kos
                        </a>
                    </div>
                </div>
            </div>
        @endif

        <!-- Features Section -->
        <div class="features-section py-5">
            <div class="container">
                <div class="section-header text-center mb-5">
                    <h2 class="section-title">Why Choose <span class="gradient-text">Kos Finder?</span></h2>
                    <p class="section-subtitle">We make finding and managing boarding houses simple and efficient</p>
                </div>

                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="glass-card feature-card text-center h-100">
                            <div class="feature-icon primary">
                                <i class="fas fa-search"></i>
                            </div>
                            <h5 class="feature-title">Easy Search</h5>
                            <p class="feature-description">Find kos by location, price range, and facilities with our
                                advanced
                                search filters.</p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="glass-card feature-card text-center h-100">
                            <div class="feature-icon success">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <h5 class="feature-title">Verified Listings</h5>
                            <p class="feature-description">All kos listings are verified by our admin team to ensure quality
                                and
                                authenticity.</p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="glass-card feature-card text-center h-100">
                            <div class="feature-icon info">
                                <i class="fas fa-phone"></i>
                            </div>
                            <h5 class="feature-title">Direct Contact</h5>
                            <p class="feature-description">Connect directly with kos owners for inquiries and bookings
                                without
                                any middleman.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="cta-section py-5">
            <div class="container">
                <div class="glass-card cta-card text-center">
                    <h2 class="cta-title mb-4">Siap untuk <span class="gradient-text">Memulai?</span></h2>
                    @guest
                        <p class="cta-subtitle mb-4">Bergabunglah dengan ribuan pengguna yang telah menemukan kos impian mereka
                            melalui platform kami.</p>
                        <div class="cta-actions">
                            <a href="{{ route('register') }}" class="btn glass-btn glass-btn-primary me-3">
                                <i class="fas fa-user-plus me-2"></i>Daftar sebagai Penyewa
                            </a>
                            <a href="{{ route('register') }}" class="btn glass-btn glass-btn-outline">
                                <i class="fas fa-building me-2"></i>Daftar sebagai Pemilik
                            </a>
                        </div>
                    @else
                        <p class="cta-subtitle mb-4">Selamat datang kembali! Mulai jelajahi kos yang tersedia di area Anda.</p>
                        <div class="cta-actions">
                            <a href="{{ route('search') }}" class="btn glass-btn glass-btn-primary">
                                <i class="fas fa-search me-2"></i>Jelajahi Kos
                            </a>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
            rel="stylesheet">

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
            }

            * {
                box-sizing: border-box;
            }

            body {
                font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', sans-serif;
                font-weight: 400;
                line-height: 1.6;
                color: var(--white);
                background: var(--gradient-background);
            }

            .glassmorphism-page {
                background: var(--gradient-background);
                min-height: 100vh;
                position: relative;
                overflow-x: hidden;
            }

            .glassmorphism-page::before {
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

            /* Typography */
            h1,
            h2,
            h3,
            h4,
            h5,
            h6 {
                font-family: 'Poppins', sans-serif;
                font-weight: 700;
                line-height: 1.2;
                color: var(--white);
                margin-bottom: 1rem;
            }

            /* Hero Section */
            .hero-section {
                background: transparent;
                position: relative;
                overflow: hidden;
                min-height: 100vh;
                display: flex;
                align-items: center;
            }

            .bg-animations {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: 1;
            }

            .floating-element {
                position: absolute;
                border-radius: 50%;
                background: var(--glass-bg);
                backdrop-filter: blur(20px);
                border: 1px solid var(--glass-border);
                animation: float 8s ease-in-out infinite;
            }

            .floating-1 {
                width: 120px;
                height: 120px;
                top: 15%;
                left: 8%;
                animation-delay: 0s;
            }

            .floating-2 {
                width: 80px;
                height: 80px;
                top: 50%;
                right: 10%;
                animation-delay: 2s;
            }

            .floating-3 {
                width: 150px;
                height: 150px;
                bottom: 15%;
                left: 12%;
                animation-delay: 4s;
            }

            .floating-4 {
                width: 60px;
                height: 60px;
                top: 30%;
                right: 25%;
                animation-delay: 1s;
            }

            .floating-5 {
                width: 100px;
                height: 100px;
                top: 70%;
                left: 60%;
                animation-delay: 3s;
            }

            .floating-6 {
                width: 40px;
                height: 40px;
                bottom: 40%;
                right: 40%;
                animation-delay: 5s;
            }

            @keyframes float {

                0%,
                100% {
                    transform: translateY(0px) rotate(0deg) scale(1);
                    opacity: 0.7;
                }

                33% {
                    transform: translateY(-30px) rotate(120deg) scale(1.1);
                    opacity: 0.9;
                }

                66% {
                    transform: translateY(15px) rotate(240deg) scale(0.9);
                    opacity: 0.8;
                }
            }

            .hero-content {
                z-index: 2;
                position: relative;
            }

            .hero-title {
                font-size: clamp(2.5rem, 5vw, 4rem);
                font-weight: 900;
                line-height: 1.1;
                color: var(--white);
                text-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
                margin-bottom: 2rem;
            }

            .gradient-text {
                background: var(--gradient-secondary);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                position: relative;
            }

            .hero-subtitle {
                font-size: 1.25rem;
                color: rgba(255, 255, 255, 0.85);
                line-height: 1.7;
                font-weight: 400;
                max-width: 500px;
            }

            .hero-visual {
                display: flex;
                justify-content: center;
                align-items: center;
                z-index: 2;
                position: relative;
            }

            .glass-circle {
                width: 350px;
                height: 350px;
                border-radius: 50%;
                background: var(--glass-bg);
                backdrop-filter: blur(30px);
                border: 2px solid var(--glass-border);
                display: flex;
                align-items: center;
                justify-content: center;
                box-shadow: var(--glass-shadow);
                animation: pulse 4s ease-in-out infinite;
                position: relative;
                overflow: hidden;
            }

            .glass-circle::before {
                content: '';
                position: absolute;
                top: -50%;
                left: -50%;
                width: 200%;
                height: 200%;
                background: conic-gradient(from 0deg, transparent, rgba(255, 255, 255, 0.1), transparent);
                animation: rotate 10s linear infinite;
            }

            .hero-icon {
                font-size: 140px;
                color: var(--white);
                opacity: 0.9;
                z-index: 1;
                position: relative;
            }

            @keyframes pulse {

                0%,
                100% {
                    transform: scale(1);
                    box-shadow: var(--glass-shadow);
                }

                50% {
                    transform: scale(1.05);
                    box-shadow: var(--glass-shadow-hover);
                }
            }

            @keyframes rotate {
                0% {
                    transform: rotate(0deg);
                }

                100% {
                    transform: rotate(360deg);
                }
            }

            /* Glass Components */
            .glass-card {
                background: var(--glass-bg);
                backdrop-filter: blur(25px);
                border: 1px solid var(--glass-border);
                border-radius: 24px;
                box-shadow: var(--glass-shadow);
                padding: 2.5rem;
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                position: relative;
                overflow: hidden;
            }

            .glass-card::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 1px;
                background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
                opacity: 0;
                transition: opacity 0.3s ease;
            }

            .glass-card:hover {
                transform: translateY(-8px);
                box-shadow: var(--glass-shadow-hover);
                background: var(--glass-bg-light);
            }

            .glass-card:hover::before {
                opacity: 1;
            }

            .glass-btn {
                background: var(--glass-bg);
                backdrop-filter: blur(25px);
                border: 1px solid var(--glass-border);
                border-radius: 50px;
                padding: 14px 32px;
                font-weight: 600;
                font-size: 1rem;
                text-decoration: none;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                display: inline-flex;
                align-items: center;
                justify-content: center;
                position: relative;
                overflow: hidden;
                color: var(--white);
                font-family: 'Inter', sans-serif;
            }

            .glass-btn::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
                transition: left 0.6s ease;
            }

            .glass-btn:hover::before {
                left: 100%;
            }

            .glass-btn-primary {
                background: var(--gradient-primary);
                color: var(--white);
                border: none;
                box-shadow: 0 4px 20px rgba(102, 126, 234, 0.4);
            }

            .glass-btn-primary:hover {
                box-shadow: 0 8px 30px rgba(102, 126, 234, 0.6);
                color: var(--white);
            }

            .glass-btn-outline {
                color: var(--white);
                border: 2px solid rgba(255, 255, 255, 0.3);
                background: transparent;
            }

            .glass-btn-outline:hover {
                background: var(--glass-bg-light);
                border-color: rgba(255, 255, 255, 0.5);
                color: var(--white);
            }

            .glass-btn-lg {
                padding: 16px 40px;
                font-size: 1.1rem;
            }

            .glass-btn:hover {
                transform: translateY(-2px);
            }

            .glass-input-group {
                position: relative;
            }

            .glass-input {
                background: var(--glass-bg);
                backdrop-filter: blur(20px);
                border: 1px solid var(--glass-border);
                border-radius: 50px;
                padding: 16px 24px 16px 55px;
                font-size: 1rem;
                color: var(--white);
                width: 100%;
                transition: all 0.3s ease;
                font-family: 'Inter', sans-serif;
            }

            .glass-input::placeholder {
                color: rgba(255, 255, 255, 0.6);
            }

            .glass-input:focus {
                outline: none;
                border: 2px solid rgba(255, 255, 255, 0.5);
                box-shadow: 0 0 25px rgba(255, 255, 255, 0.2);
                background: var(--glass-bg-light);
                color: var(--white);
            }

            .input-icon {
                position: absolute;
                left: 20px;
                top: 50%;
                transform: translateY(-50%);
                color: rgba(255, 255, 255, 0.6);
                z-index: 2;
                font-size: 1rem;
            }

            /* Statistics Section */
            .stats-section {
                padding: 120px 0;
                background: rgba(255, 255, 255, 0.02);
                position: relative;
            }

            .stat-card {
                padding: 3rem 2rem;
                text-align: center;
                border: none;
                background: var(--glass-bg);
                transition: all 0.4s ease;
            }

            .stat-card:hover {
                background: var(--glass-bg-light);
            }

            .stat-icon {
                width: 90px;
                height: 90px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 1.5rem;
                font-size: 2.2rem;
                background: var(--gradient-primary);
                color: var(--white);
                box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
            }

            .stat-icon.success {
                background: var(--gradient-success);
                box-shadow: 0 10px 30px rgba(17, 153, 142, 0.3);
            }

            .stat-icon.info {
                background: var(--gradient-secondary);
                box-shadow: 0 10px 30px rgba(79, 172, 254, 0.3);
            }

            .stat-number {
                font-size: 3.5rem;
                font-weight: 900;
                color: var(--white);
                margin-bottom: 0.5rem;
                font-family: 'Poppins', sans-serif;
            }

            .stat-label {
                color: rgba(255, 255, 255, 0.8);
                font-size: 1.1rem;
                margin: 0;
                font-weight: 500;
            }

            /* Featured Section */
            .featured-section {
                padding: 120px 0;
                background: rgba(255, 255, 255, 0.01);
            }

            .section-header {
                margin-bottom: 4rem;
            }

            .section-title {
                font-size: clamp(2rem, 4vw, 3.5rem);
                font-weight: 800;
                color: var(--white);
                margin-bottom: 1rem;
                font-family: 'Poppins', sans-serif;
            }

            .section-subtitle {
                font-size: 1.25rem;
                color: rgba(255, 255, 255, 0.8);
                margin: 0;
                font-weight: 400;
            }

            /* Kos Cards */
            .kos-card {
                padding: 0;
                overflow: hidden;
                background: var(--glass-bg);
                border-radius: 20px;
            }

            .kos-image-container {
                position: relative;
                height: 280px;
                overflow: hidden;
                border-radius: 20px 20px 0 0;
            }

            .kos-image {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: transform 0.4s ease;
            }

            .kos-card:hover .kos-image {
                transform: scale(1.1);
            }

            .kos-image-placeholder {
                width: 100%;
                height: 100%;
                background: var(--gradient-primary);
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 4rem;
                color: var(--white);
            }

            .image-overlay {
                position: absolute;
                top: 16px;
                right: 16px;
            }

            .verified-badge {
                background: var(--gradient-success);
                color: var(--white);
                padding: 6px 14px;
                border-radius: 20px;
                font-size: 0.85rem;
                font-weight: 600;
                box-shadow: 0 4px 15px rgba(17, 153, 142, 0.4);
            }

            .kos-content {
                padding: 2.5rem;
            }

            .kos-title {
                color: var(--white);
                font-weight: 700;
                font-size: 1.4rem;
                margin-bottom: 1.5rem;
                font-family: 'Poppins', sans-serif;
            }

            .kos-location,
            .kos-facilities,
            .kos-owner {
                color: rgba(255, 255, 255, 0.8);
                font-size: 0.95rem;
                display: flex;
                align-items: center;
                margin-bottom: 1rem;
            }

            .kos-location i,
            .kos-facilities i,
            .kos-owner i {
                color: rgba(255, 255, 255, 0.6);
                width: 20px;
            }

            .kos-price {
                margin: 2rem 0;
            }

            .price-amount {
                font-size: 2rem;
                font-weight: 800;
                color: #4facfe;
                font-family: 'Poppins', sans-serif;
            }

            .price-period {
                color: rgba(255, 255, 255, 0.7);
                font-size: 1rem;
                font-weight: 500;
            }

            .kos-footer {
                padding: 0 2.5rem 2.5rem;
            }

            /* Features Section */
            .features-section {
                padding: 120px 0;
                background: rgba(255, 255, 255, 0.02);
            }

            .feature-card {
                padding: 3.5rem 2.5rem;
                text-align: center;
                background: var(--glass-bg);
                transition: all 0.4s ease;
            }

            .feature-card:hover {
                background: var(--glass-bg-light);
            }

            .feature-icon {
                width: 110px;
                height: 110px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 2rem;
                font-size: 2.8rem;
                background: var(--gradient-primary);
                color: var(--white);
                box-shadow: 0 15px 40px rgba(102, 126, 234, 0.3);
            }

            .feature-icon.success {
                background: var(--gradient-success);
                box-shadow: 0 15px 40px rgba(17, 153, 142, 0.3);
            }

            .feature-icon.info {
                background: var(--gradient-secondary);
                box-shadow: 0 15px 40px rgba(79, 172, 254, 0.3);
            }

            .feature-title {
                color: var(--white);
                font-weight: 700;
                font-size: 1.6rem;
                margin-bottom: 1.5rem;
                font-family: 'Poppins', sans-serif;
            }

            .feature-description {
                color: rgba(255, 255, 255, 0.8);
                line-height: 1.7;
                margin: 0;
                font-size: 1rem;
            }

            /* CTA Section */
            .cta-section {
                padding: 120px 0;
                background: rgba(255, 255, 255, 0.01);
            }

            .cta-card {
                background: var(--glass-bg-light);
                padding: 5rem 4rem;
                border-radius: 30px;
                text-align: center;
            }

            .cta-title {
                font-size: clamp(2rem, 4vw, 3.5rem);
                font-weight: 800;
                color: var(--white);
                margin-bottom: 1.5rem;
                font-family: 'Poppins', sans-serif;
            }

            .cta-subtitle {
                font-size: 1.25rem;
                color: rgba(255, 255, 255, 0.8);
                line-height: 1.7;
                margin-bottom: 3rem;
                max-width: 600px;
                margin-left: auto;
                margin-right: auto;
            }

            .cta-actions {
                display: flex;
                justify-content: center;
                gap: 1.5rem;
                flex-wrap: wrap;
            }

            .search-card {
                padding: 2.5rem;
                background: var(--glass-bg-light);
                border-radius: 25px;
                margin-bottom: 2rem;
            }

            .hero-actions {
                display: flex;
                gap: 1.5rem;
                flex-wrap: wrap;
            }

            /* Responsive Design */
            @media (max-width: 768px) {
                .hero-title {
                    font-size: 2.5rem;
                    text-align: center;
                }

                .hero-subtitle {
                    text-align: center;
                    margin: 0 auto 2rem;
                }

                .section-title {
                    font-size: 2.5rem;
                }

                .cta-title {
                    font-size: 2.5rem;
                }

                .glass-circle {
                    width: 250px;
                    height: 250px;
                    margin-top: 3rem;
                }

                .hero-icon {
                    font-size: 100px;
                }

                .hero-actions,
                .cta-actions {
                    flex-direction: column;
                    align-items: center;
                }

                .glass-btn {
                    width: 100%;
                    text-align: center;
                    max-width: 300px;
                }

                .stat-card,
                .feature-card {
                    padding: 2.5rem 2rem;
                }

                .cta-card {
                    padding: 3rem 2rem;
                }

                .stats-section,
                .featured-section,
                .features-section,
                .cta-section {
                    padding: 80px 0;
                }
            }

            @media (max-width: 576px) {
                .glass-card {
                    padding: 2rem;
                }

                .kos-content {
                    padding: 2rem;
                }

                .kos-footer {
                    padding: 0 2rem 2rem;
                }

                .search-card {
                    padding: 2rem;
                    margin-bottom: 1.5rem;
                }

                .glass-input {
                    padding: 14px 20px 14px 50px;
                }

                .input-icon {
                    left: 18px;
                }
            }

            /* Additional animations and effects */
            @media (prefers-reduced-motion: no-preference) {

                .glass-card,
                .glass-btn {
                    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                }

                .kos-card {
                    transition: all 0.4s ease;
                }

                .stat-icon,
                .feature-icon {
                    transition: transform 0.3s ease;
                }

                .stat-card:hover .stat-icon,
                .feature-card:hover .feature-icon {
                    transform: scale(1.1);
                }
            }

            /* Focus states for accessibility */
            .glass-btn:focus,
            .glass-input:focus {
                outline: 2px solid rgba(255, 255, 255, 0.5);
                outline-offset: 2px;
            }

            /* Print styles */
            @media print {
                .glassmorphism-page {
                    background: white !important;
                    color: black !important;
                }

                .glass-card {
                    background: white !important;
                    border: 1px solid #ccc !important;
                    box-shadow: none !important;
                }

                .hero-title,
                .section-title,
                .cta-title {
                    color: black !important;
                }
            }
        </style>
    @endpush
@endsection