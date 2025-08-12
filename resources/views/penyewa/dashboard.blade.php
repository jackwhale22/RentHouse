@extends('layouts.app')

@section('title', 'Dashboard - Kos Finder')

@section('content')
    <div class="container-fluid glassmorphism-dashboard">
        <div class="container py-5">
            <!-- Dashboard Header -->
            <div class="row mb-5">
                <div class="col-12">
                    <div class="glass-card dashboard-header">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <div class="header-content">
                                <div class="header-icon">
                                    <i class="fas fa-home"></i>
                                </div>
                                <div class="header-text">
                                    <h1 class="dashboard-title">Welcome back, {{ auth()->user()->name }}!</h1>
                                    <p class="dashboard-subtitle">Temukan kos impian Anda dan kelola kontak dengan mudah</p>
                                </div>
                            </div>
                            <div class="header-actions">
                                <a href="{{ route('search') }}" class="glass-btn glass-btn-primary">
                                    <i class="fas fa-search me-2"></i>Cari Kos
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="row g-4 mb-5">
                <!-- Total Contacts -->
                <div class="col-md-6 col-lg-3">
                    <div class="glass-card stat-card primary-stat">
                        <div class="stat-icon primary">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-header">
                                <h6 class="stat-label">Total Kontak</h6>
                                <div class="stat-trend up">
                                    <i class="fas fa-arrow-up"></i>
                                </div>
                            </div>
                            <h2 class="stat-number">{{ $totalTransaksi }}</h2>
                            <p class="stat-description">Pemilik kos dihubungi</p>
                        </div>
                    </div>
                </div>

                <!-- Pending Contacts -->
                <div class="col-md-6 col-lg-3">
                    <div class="glass-card stat-card warning-stat">
                        <div class="stat-icon warning">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-header">
                                <h6 class="stat-label">Menunggu Respon</h6>
                                <div class="stat-trend neutral">
                                    <i class="fas fa-minus"></i>
                                </div>
                            </div>
                            <h2 class="stat-number">{{ $pendingTransaksi }}</h2>
                            <p class="stat-description">Menunggu balasan</p>
                        </div>
                    </div>
                </div>

                <!-- Available Kos -->
                <div class="col-md-6 col-lg-3">
                    <div class="glass-card stat-card success-stat">
                        <div class="stat-icon success">
                            <i class="fas fa-building"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-header">
                                <h6 class="stat-label">Kos Tersedia</h6>
                                <div class="stat-trend up">
                                    <i class="fas fa-arrow-up"></i>
                                </div>
                            </div>
                            <h2 class="stat-number">
                                {{ \App\Models\Kos::where('is_verified', true)->where('status_ketersediaan', 'tersedia')->count() }}
                            </h2>
                            <p class="stat-description">Siap untuk dihuni</p>
                        </div>
                    </div>
                </div>

                <!-- Successful Contacts -->
                <div class="col-md-6 col-lg-3">
                    <div class="glass-card stat-card info-stat">
                        <div class="stat-icon info">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-header">
                                <h6 class="stat-label">Kontak Selesai</h6>
                                <div class="stat-trend up">
                                    <i class="fas fa-arrow-up"></i>
                                </div>
                            </div>
                            <h2 class="stat-number">
                                {{ auth()->user()->transaksis()->where('status_transaksi', 'selesai')->count() }}</h2>
                            <p class="stat-description">Berhasil terhubung</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="row g-4 mb-5">
                <div class="col-md-4">
                    <div class="glass-card quick-action-card">
                        <div class="quick-icon primary">
                            <i class="fas fa-search"></i>
                        </div>
                        <h6 class="quick-title">Cari Kos</h6>
                        <p class="quick-description">Temukan kos sesuai kriteria dan budget Anda</p>
                        <a href="{{ route('search') }}" class="glass-btn glass-btn-primary w-100">
                            <i class="fas fa-search me-2"></i>Mulai Pencarian
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="glass-card quick-action-card">
                        <div class="quick-icon warning">
                            <i class="fas fa-list"></i>
                        </div>
                        <h6 class="quick-title">Kontak Saya</h6>
                        <p class="quick-description">Lihat riwayat kontak dengan pemilik kos</p>
                        <a href="{{ route('my-transaksi') }}" class="glass-btn glass-btn-outline w-100">
                            <i class="fas fa-list me-2"></i>Lihat Kontak
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="glass-card quick-action-card">
                        <div class="quick-icon info">
                            <i class="fas fa-user"></i>
                        </div>
                        <h6 class="quick-title">Profil Saya</h6>
                        <p class="quick-description">Kelola informasi dan preferensi profil</p>
                        <a href="{{ route('profile') }}" class="glass-btn glass-btn-outline w-100">
                            <i class="fas fa-user me-2"></i>Edit Profil
                        </a>
                    </div>
                </div>
            </div>

            <!-- Recent Kos -->
            <div class="row g-4 mb-5">
                <div class="col-12">
                    <div class="glass-card table-card">
                        <div class="card-header-custom">
                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                <div class="header-info">
                                    <h5 class="table-title">
                                        <i class="fas fa-home me-2"></i>Kos Terbaru
                                    </h5>
                                    <p class="table-subtitle">Listing kos terbaru yang mungkin Anda sukai</p>
                                </div>
                                <div class="header-actions">
                                    <a href="{{ route('search') }}" class="glass-btn glass-btn-outline">
                                        <i class="fas fa-eye me-2"></i>Lihat Semua
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body-custom">
                            @if($recentKos->count() > 0)
                                <div class="kos-grid">
                                    @foreach($recentKos as $kos)
                                        <div class="kos-card-wrapper">
                                            <div class="glass-kos-card">
                                                <!-- Kos Image -->
                                                <div class="kos-image-container">
                                                    @if($kos->mainPhoto)
                                                        <img src="{{ asset($kos->mainPhoto->foto_path) }}" alt="{{ $kos->nama_kos }}" class="kos-image">
                                                        <div class="image-overlay">
                                                            <div class="overlay-content">
                                                                <i class="fas fa-eye overlay-icon"></i>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="kos-image-placeholder">
                                                            <i class="fas fa-home placeholder-icon"></i>
                                                            <p class="placeholder-text">No Image</p>
                                                        </div>
                                                    @endif

                                                    <!-- Status Badge -->
                                                    <div class="status-badge available">
                                                        <i class="fas fa-check me-1"></i>Available
                                                    </div>
                                                </div>

                                                <!-- Kos Content -->
                                                <div class="kos-content">
                                                    <!-- Kos Header -->
                                                    <div class="kos-header">
                                                        <h6 class="kos-title">{{ $kos->nama_kos }}</h6>
                                                        <div class="kos-rating">
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star-half-alt"></i>
                                                        </div>
                                                    </div>

                                                    <!-- Kos Details -->
                                                    <div class="kos-details">
                                                        <div class="detail-item location">
                                                            <i class="fas fa-map-marker-alt detail-icon"></i>
                                                            <span class="detail-text">{{ Str::limit($kos->lokasi, 30) }}</span>
                                                        </div>

                                                        <div class="detail-item price">
                                                            <i class="fas fa-money-bill-wave detail-icon"></i>
                                                            <span class="detail-text">
                                                                <strong>Rp {{ number_format($kos->harga, 0, ',', '.') }}</strong>
                                                                <small>/bulan</small>
                                                            </span>
                                                        </div>

                                                        @if($kos->fasilitas)
                                                            <div class="detail-item facilities">
                                                                <i class="fas fa-star detail-icon"></i>
                                                                <span class="detail-text">{{ Str::limit($kos->fasilitas, 40) }}</span>
                                                            </div>
                                                        @endif
                                                    </div>

                                                    <!-- Action Button -->
                                                    <div class="kos-actions">
                                                        <a href="{{ route('kos.show', $kos->id) }}"
                                                            class="glass-btn glass-btn-primary w-100">
                                                            <i class="fas fa-eye me-2"></i>Lihat Detail
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <!-- Empty State -->
                                <div class="empty-state">
                                    <div class="empty-icon">
                                        <i class="fas fa-home"></i>
                                    </div>
                                    <h5 class="empty-title">Belum Ada Kos Tersedia</h5>
                                    <p class="empty-description">
                                        Saat ini belum ada listing kos baru. Coba lakukan pencarian untuk menemukan kos yang
                                        sesuai
                                    </p>
                                    <div class="empty-actions">
                                        <a href="{{ route('search') }}" class="glass-btn glass-btn-primary">
                                            <i class="fas fa-search me-2"></i>Cari Kos Sekarang
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Contacts -->
            @if($recentTransaksi->count() > 0)
                <div class="row">
                    <div class="col-12">
                        <div class="glass-card table-card">
                            <div class="card-header-custom">
                                <div class="d-flex justify-content-between align-items-center flex-wrap">
                                    <div class="header-info">
                                        <h5 class="table-title">
                                            <i class="fas fa-history me-2"></i>Kontak Terbaru
                                        </h5>
                                        <p class="table-subtitle">Riwayat kontak dengan pemilik kos</p>
                                    </div>
                                    <div class="header-actions">
                                        <a href="{{ route('my-transaksi') }}" class="glass-btn glass-btn-outline">
                                            <i class="fas fa-eye me-2"></i>Lihat Semua
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body-custom">
                                <div class="glass-table-wrapper">
                                    <div class="table-responsive">
                                        <table class="glass-table">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <i class="fas fa-home me-2"></i>Kos
                                                    </th>
                                                    <th>
                                                        <i class="fas fa-user-tie me-2"></i>Pemilik
                                                    </th>
                                                    <th>
                                                        <i class="fas fa-flag me-2"></i>Status
                                                    </th>
                                                    <th>
                                                        <i class="fas fa-calendar me-2"></i>Tanggal
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($recentTransaksi as $transaksi)
                                                    <tr class="table-row">
                                                        <td>
                                                            <div class="kos-info">
                                                                <div class="kos-name">{{ $transaksi->kos->nama_kos }}</div>
                                                                <div class="kos-location">
                                                                    <i class="fas fa-map-pin location-icon"></i>
                                                                    {{ Str::limit($transaksi->kos->lokasi, 30) }}
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="owner-info">
                                                                <div class="owner-name">{{ $transaksi->kos->pemilik->name }}</div>
                                                                @if($transaksi->kos->pemilik->phone)
                                                                    <div class="owner-contact">
                                                                        <i class="fas fa-phone contact-icon"></i>
                                                                        {{ $transaksi->kos->pemilik->phone }}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <span class="glass-badge status-{{ $transaksi->status_transaksi }}">
                                                                <i
                                                                    class="fas fa-{{ $transaksi->status_transaksi == 'pending' ? 'clock' : ($transaksi->status_transaksi == 'selesai' ? 'check-circle' : 'times-circle') }} me-1"></i>
                                                                {{ ucfirst($transaksi->status_transaksi) }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <div class="date-info">
                                                                <div class="date-relative">
                                                                    {{ $transaksi->created_at->diffForHumans() }}</div>
                                                                <div class="date-exact">
                                                                    {{ $transaksi->created_at->format('M d, Y') }}</div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    @push('styles')
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

            .glassmorphism-dashboard {
                background: var(--gradient-background);
                min-height: 100vh;
                position: relative;
                overflow-x: hidden;
            }

            .glassmorphism-dashboard::before {
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

            /* Glass Card */
            .glass-card {
                background: var(--glass-bg);
                backdrop-filter: blur(25px);
                border: 1px solid var(--glass-border);
                border-radius: 24px;
                box-shadow: var(--glass-shadow);
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

            .glass-card:hover::before {
                opacity: 1;
            }

            /* Dashboard Header */
            .dashboard-header {
                padding: 2.5rem;
                margin-bottom: 2rem;
            }

            .dashboard-header:hover {
                transform: translateY(-5px);
                box-shadow: var(--glass-shadow-hover);
                background: var(--glass-bg-light);
            }

            .header-content {
                display: flex;
                align-items: center;
                gap: 1.5rem;
            }

            .header-icon {
                width: 80px;
                height: 80px;
                background: var(--gradient-primary);
                border-radius: 20px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 2rem;
                color: var(--white);
                box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
            }

            .dashboard-title {
                font-family: 'Poppins', sans-serif;
                font-size: 2.5rem;
                font-weight: 800;
                color: var(--white);
                margin-bottom: 0.5rem;
            }

            .dashboard-subtitle {
                font-size: 1.1rem;
                color: rgba(255, 255, 255, 0.8);
                margin: 0;
            }

            /* Statistics Cards */
            .stat-card {
                padding: 2rem;
                transition: all 0.4s ease;
                cursor: pointer;
                position: relative;
                overflow: hidden;
            }

            .stat-card::after {
                content: '';
                position: absolute;
                top: 0;
                right: 0;
                width: 100px;
                height: 100px;
                background: linear-gradient(45deg, rgba(255, 255, 255, 0.1), transparent);
                border-radius: 50%;
                transform: translate(30px, -30px);
                transition: all 0.3s ease;
            }

            .stat-card:hover {
                transform: translateY(-8px) scale(1.02);
                box-shadow: var(--glass-shadow-hover);
            }

            .stat-card:hover::after {
                transform: translate(20px, -20px) scale(1.2);
            }

            .primary-stat:hover {
                background: rgba(102, 126, 234, 0.1);
            }

            .success-stat:hover {
                background: rgba(17, 153, 142, 0.1);
            }

            .warning-stat:hover {
                background: rgba(217, 119, 6, 0.1);
            }

            .info-stat:hover {
                background: rgba(14, 165, 233, 0.1);
            }

            .stat-icon {
                width: 60px;
                height: 60px;
                border-radius: 15px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.5rem;
                color: var(--white);
                margin-bottom: 1.5rem;
                position: relative;
                z-index: 2;
            }

            .stat-icon.primary {
                background: var(--gradient-primary);
                box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
            }

            .stat-icon.success {
                background: var(--gradient-success);
                box-shadow: 0 8px 25px rgba(17, 153, 142, 0.3);
            }

            .stat-icon.warning {
                background: var(--gradient-accent);
                box-shadow: 0 8px 25px rgba(217, 119, 6, 0.3);
            }

            .stat-icon.info {
                background: var(--gradient-secondary);
                box-shadow: 0 8px 25px rgba(14, 165, 233, 0.3);
            }

            .stat-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 1rem;
            }

            .stat-label {
                font-family: 'Poppins', sans-serif;
                font-size: 0.9rem;
                font-weight: 600;
                color: rgba(255, 255, 255, 0.8);
                margin: 0;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            .stat-trend {
                width: 30px;
                height: 30px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 0.8rem;
            }

            .stat-trend.up {
                background: rgba(34, 197, 94, 0.2);
                color: #22c55e;
            }

            .stat-trend.neutral {
                background: rgba(156, 163, 175, 0.2);
                color: #9ca3af;
            }

            .stat-number {
                font-family: 'Poppins', sans-serif;
                font-size: 2.5rem;
                font-weight: 900;
                color: var(--white);
                margin-bottom: 0.5rem;
                line-height: 1;
            }

            .stat-description {
                color: rgba(255, 255, 255, 0.7);
                font-size: 0.9rem;
                margin: 0;
            }

            /* Quick Action Cards */
            .quick-action-card {
                padding: 2rem;
                text-align: center;
                transition: all 0.4s ease;
                cursor: pointer;
            }

            .quick-action-card:hover {
                transform: translateY(-8px) scale(1.02);
                box-shadow: var(--glass-shadow-hover);
            }

            .quick-icon {
                width: 60px;
                height: 60px;
                border-radius: 15px;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 1.5rem;
                font-size: 1.5rem;
                color: var(--white);
            }

            .quick-icon.primary {
                background: var(--gradient-primary);
            }

            .quick-icon.warning {
                background: var(--gradient-accent);
            }

            .quick-icon.info {
                background: var(--gradient-secondary);
            }

            .quick-title {
                font-family: 'Poppins', sans-serif;
                font-size: 1.2rem;
                font-weight: 700;
                color: var(--white);
                margin-bottom: 1rem;
            }

            .quick-description {
                color: rgba(255, 255, 255, 0.8);
                font-size: 0.9rem;
                line-height: 1.6;
                margin-bottom: 1.5rem;
            }

            /* Table Card */
            .table-card {
                padding: 0;
                overflow: hidden;
            }

            .card-header-custom {
                padding: 2.5rem 2.5rem 0;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
                margin-bottom: 2rem;
            }

            .table-title {
                font-family: 'Poppins', sans-serif;
                font-size: 1.5rem;
                font-weight: 700;
                color: var(--white);
                margin-bottom: 0.5rem;
            }

            .table-subtitle {
                color: rgba(255, 255, 255, 0.8);
                font-size: 1rem;
                margin: 0;
            }

            .card-body-custom {
                padding: 0 2.5rem 2.5rem;
            }

            /* Kos Grid */
            .kos-grid {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
                gap: 2rem;
            }

            .kos-card-wrapper {
                transition: all 0.3s ease;
            }

            .kos-card-wrapper:hover {
                transform: translateY(-5px);
            }

            /* Glass Kos Card */
            .glass-kos-card {
                background: var(--glass-bg);
                backdrop-filter: blur(25px);
                border: 1px solid var(--glass-border);
                border-radius: 20px;
                box-shadow: var(--glass-shadow);
                transition: all 0.4s ease;
                overflow: hidden;
                position: relative;
            }

            .glass-kos-card:hover {
                box-shadow: var(--glass-shadow-hover);
                background: var(--glass-bg-light);
            }

            /* Kos Image */
            .kos-image-container {
                position: relative;
                height: 200px;
                overflow: hidden;
                border-radius: 20px 20px 0 0;
            }

            .kos-image {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: transform 0.3s ease;
            }

            .glass-kos-card:hover .kos-image {
                transform: scale(1.05);
            }

            .kos-image-placeholder {
                width: 100%;
                height: 100%;
                background: var(--glass-bg-light);
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                color: rgba(255, 255, 255, 0.6);
            }

            .placeholder-icon {
                font-size: 3rem;
                margin-bottom: 0.5rem;
            }

            .placeholder-text {
                font-size: 0.9rem;
                margin: 0;
            }

            .image-overlay {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                display: flex;
                align-items: center;
                justify-content: center;
                opacity: 0;
                transition: opacity 0.3s ease;
            }

            .glass-kos-card:hover .image-overlay {
                opacity: 1;
            }

            .overlay-icon {
                font-size: 2rem;
                color: var(--white);
            }

            /* Status Badge */
            .status-badge {
                position: absolute;
                top: 1rem;
                right: 1rem;
                padding: 0.5rem 1rem;
                border-radius: 50px;
                font-size: 0.8rem;
                font-weight: 600;
                backdrop-filter: blur(15px);
                z-index: 10;
            }

            .status-badge.available {
                background: rgba(34, 197, 94, 0.2);
                border: 1px solid rgba(34, 197, 94, 0.3);
                color: #22c55e;
            }

            /* Kos Content */
            .kos-content {
                padding: 1.5rem;
            }

            .kos-header {
                margin-bottom: 1rem;
            }

            .kos-title {
                font-family: 'Poppins', sans-serif;
                font-size: 1.1rem;
                font-weight: 700;
                color: var(--white);
                margin-bottom: 0.5rem;
                line-height: 1.3;
            }

            .kos-rating {
                display: flex;
                gap: 0.25rem;
                color: #fbbf24;
                font-size: 0.9rem;
            }

            /* Kos Details */
            .kos-details {
                margin-bottom: 1.5rem;
            }

            .detail-item {
                display: flex;
                align-items: flex-start;
                gap: 0.75rem;
                margin-bottom: 0.75rem;
            }

            .detail-icon {
                color: rgba(255, 255, 255, 0.6);
                font-size: 0.9rem;
                width: 16px;
                margin-top: 0.1rem;
                flex-shrink: 0;
            }

            .detail-text {
                color: rgba(255, 255, 255, 0.9);
                font-size: 0.9rem;
                line-height: 1.4;
            }

            .detail-item.price .detail-text strong {
                color: var(--white);
                font-size: 1rem;
            }

            .detail-item.price .detail-text small {
                color: rgba(255, 255, 255, 0.6);
            }

            /* Glass Table */
            .glass-table-wrapper {
                background: var(--glass-bg);
                border: 1px solid var(--glass-border);
                border-radius: 15px;
                overflow: hidden;
            }

            .glass-table {
                width: 100%;
                margin: 0;
                background: transparent;
            }

            .glass-table thead th {
                background: var(--glass-bg-light);
                color: var(--white);
                font-weight: 600;
                font-size: 0.9rem;
                padding: 1.25rem 1rem;
                border: none;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                border-bottom: 1px solid var(--glass-border);
            }

            .glass-table tbody td {
                padding: 1.25rem 1rem;
                border: none;
                border-bottom: 1px solid rgba(255, 255, 255, 0.05);
                vertical-align: middle;
            }

            .table-row {
                transition: all 0.3s ease;
            }

            .table-row:hover {
                background: var(--glass-bg-light);
                transform: scale(1.01);
            }

            /* Table Content Styling */
            .kos-info .kos-name {
                color: var(--white);
                font-weight: 600;
                font-size: 1rem;
                margin-bottom: 0.25rem;
            }

            .kos-info .kos-location {
                color: rgba(255, 255, 255, 0.7);
                font-size: 0.85rem;
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }

            .location-icon {
                color: rgba(255, 255, 255, 0.6);
                font-size: 0.8rem;
            }

            .owner-info .owner-name {
                color: var(--white);
                font-weight: 600;
                font-size: 0.95rem;
                margin-bottom: 0.25rem;
            }

            .owner-info .owner-contact {
                color: rgba(255, 255, 255, 0.7);
                font-size: 0.85rem;
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }

            .contact-icon {
                color: rgba(255, 255, 255, 0.6);
                font-size: 0.8rem;
            }

            .date-info .date-relative {
                color: var(--white);
                font-weight: 600;
                font-size: 0.9rem;
                margin-bottom: 0.25rem;
            }

            .date-info .date-exact {
                color: rgba(255, 255, 255, 0.6);
                font-size: 0.8rem;
            }

            /* Glass Badges */
            .glass-badge {
                display: inline-flex;
                align-items: center;
                padding: 0.4rem 0.8rem;
                border-radius: 20px;
                font-size: 0.8rem;
                font-weight: 600;
                border: 1px solid;
            }

            .glass-badge.status-pending {
                background: rgba(245, 158, 11, 0.2);
                color: #f59e0b;
                border-color: rgba(245, 158, 11, 0.3);
            }

            .glass-badge.status-selesai {
                background: rgba(34, 197, 94, 0.2);
                color: #22c55e;
                border-color: rgba(34, 197, 94, 0.3);
            }

            .glass-badge.status-dibatalkan {
                background: rgba(239, 68, 68, 0.2);
                color: #ef4444;
                border-color: rgba(239, 68, 68, 0.3);
            }

            /* Glass Buttons */
            .glass-btn {
                background: var(--glass-bg);
                backdrop-filter: blur(25px);
                border: 1px solid var(--glass-border);
                border-radius: 50px;
                padding: 12px 24px;
                font-weight: 600;
                font-size: 0.95rem;
                text-decoration: none;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                display: inline-flex;
                align-items: center;
                justify-content: center;
                position: relative;
                overflow: hidden;
                color: var(--white);
                font-family: 'Inter', sans-serif;
                cursor: pointer;
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
                transform: translateY(-2px);
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
                transform: translateY(-2px);
            }

            /* Empty State */
            .empty-state {
                text-align: center;
                padding: 4rem 2rem;
            }

            .empty-icon {
                width: 120px;
                height: 120px;
                background: var(--glass-bg-light);
                border: 2px solid var(--glass-border);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 2rem;
                font-size: 3rem;
                color: rgba(255, 255, 255, 0.6);
            }

            .empty-title {
                font-family: 'Poppins', sans-serif;
                font-size: 1.5rem;
                font-weight: 700;
                color: var(--white);
                margin-bottom: 1rem;
            }

            .empty-description {
                color: rgba(255, 255, 255, 0.8);
                font-size: 1rem;
                line-height: 1.6;
                max-width: 400px;
                margin: 0 auto 2rem;
            }

            /* Responsive Design */
            @media (max-width: 768px) {
                .dashboard-header {
                    padding: 2rem;
                }

                .header-content {
                    flex-direction: column;
                    text-align: center;
                    gap: 1rem;
                }

                .dashboard-title {
                    font-size: 2rem;
                }

                .header-actions {
                    width: 100%;
                }

                .header-actions .glass-btn {
                    width: 100%;
                }

                .stat-card {
                    padding: 1.5rem;
                }

                .stat-number {
                    font-size: 2rem;
                }

                .quick-action-card {
                    padding: 1.5rem;
                }

                .card-header-custom {
                    padding: 2rem 1.5rem 0;
                }

                .card-body-custom {
                    padding: 0 1.5rem 1.5rem;
                }

                .kos-grid {
                    grid-template-columns: 1fr;
                    gap: 1.5rem;
                }

                .glass-table thead th,
                .glass-table tbody td {
                    padding: 1rem 0.75rem;
                    font-size: 0.85rem;
                }

                .d-flex.justify-content-between {
                    flex-direction: column;
                    gap: 1rem;
                }

                .header-actions {
                    align-self: stretch;
                }
            }

            @media (max-width: 576px) {
                .dashboard-title {
                    font-size: 1.75rem;
                }

                .header-icon {
                    width: 60px;
                    height: 60px;
                    font-size: 1.5rem;
                }

                .stat-icon {
                    width: 50px;
                    height: 50px;
                    font-size: 1.2rem;
                }

                .kos-content {
                    padding: 1rem;
                }

                .glass-badge {
                    font-size: 0.7rem;
                    padding: 0.3rem 0.6rem;
                }
            }

            /* Accessibility */
            @media (prefers-reduced-motion: reduce) {

                *,
                *::before,
                *::after {
                    animation-duration: 0.01ms !important;
                    animation-iteration-count: 1 !important;
                    transition-duration: 0.01ms !important;
                }
            }

            /* Focus states */
            .glass-btn:focus {
                outline: 2px solid rgba(255, 255, 255, 0.5);
                outline-offset: 2px;
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            // Add click animation to stat cards
            document.querySelectorAll('.stat-card').forEach(card => {
                card.addEventListener('click', function () {
                    this.style.transform = 'scale(0.98)';
                    setTimeout(() => {
                        this.style.transform = '';
                    }, 150);
                });
            });

            // Add ripple effect to buttons
            document.querySelectorAll('.glass-btn').forEach(button => {
                button.addEventListener('click', function (e) {
                    const ripple = document.createElement('span');
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;

                    ripple.style.width = ripple.style.height = size + 'px';
                    ripple.style.left = x + 'px';
                    ripple.style.top = y + 'px';
                    ripple.classList.add('ripple');

                    this.appendChild(ripple);

                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                });
            });

            // Animate number counting on page load
            function animateNumbers() {
                document.querySelectorAll('.stat-number').forEach(element => {
                    const target = parseInt(element.textContent);
                    let current = 0;
                    const increment = target / 30;
                    const timer = setInterval(() => {
                        current += increment;
                        if (current >= target) {
                            element.textContent = target;
                            clearInterval(timer);
                        } else {
                            element.textContent = Math.floor(current);
                        }
                    }, 50);
                });
            }

            // Enhanced kos card interactions
            document.querySelectorAll('.glass-kos-card').forEach(card => {
                card.addEventListener('mouseenter', function () {
                    this.style.boxShadow = '0 12px 40px rgba(255, 255, 255, 0.15)';
                });

                card.addEventListener('mouseleave', function () {
                    this.style.boxShadow = '';
                });
            });

            // Enhanced table row interactions
            document.querySelectorAll('.table-row').forEach(row => {
                row.addEventListener('mouseenter', function () {
                    this.style.boxShadow = '0 4px 20px rgba(255, 255, 255, 0.1)';
                });

                row.addEventListener('mouseleave', function () {
                    this.style.boxShadow = '';
                });
            });

            // Run animations when page loads
            window.addEventListener('load', function () {
                setTimeout(animateNumbers, 500);
            });

            // Add CSS for ripple effect
            const style = document.createElement('style');
            style.textContent = `
                        .ripple {
                            position: absolute;
                            border-radius: 50%;
                            background: rgba(255, 255, 255, 0.3);
                            transform: scale(0);
                            animation: rippleEffect 0.6s linear;
                            pointer-events: none;
                        }

                        @keyframes rippleEffect {
                            to {
                                transform: scale(4);
                                opacity: 0;
                            }
                        }
                    `;
            document.head.appendChild(style);
        </script>
    @endpush
@endsection