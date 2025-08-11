@extends('layouts.app')

@section('title', 'My Profile - Kos Finder')

@section('content')
    <div class="container-fluid glassmorphism-profile">
        <div class="container py-5">
            <!-- Page Header -->
            <div class="row mb-5">
                <div class="col-12">
                    <div class="glass-card page-header">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <div class="header-content">
                                <div class="header-icon">
                                    <i class="fas fa-user-circle"></i>
                                </div>
                                <div class="header-text">
                                    <h1 class="page-title">Profil Saya</h1>
                                    <p class="page-subtitle">Kelola informasi profil dan statistik akun Anda</p>
                                </div>
                            </div>
                            <div class="header-actions">
                                @if(auth()->user()->role == 'admin')
                                    <a href="{{ route('admin.dashboard') }}" class="glass-btn glass-btn-outline">
                                        <i class="fas fa-tachometer-alt me-2"></i>Dashboard Admin
                                    </a>
                                @elseif(auth()->user()->role == 'pemilik')
                                    <a href="{{ route('pemilik.dashboard') }}" class="glass-btn glass-btn-outline">
                                        <i class="fas fa-tachometer-alt me-2"></i>Dashboard Pemilik
                                    </a>
                                @else
                                    <a href="{{ route('dashboard') }}" class="glass-btn glass-btn-outline">
                                        <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <!-- Profile Information -->
                <div class="col-lg-8">
                    <div class="glass-card profile-card">
                        <div class="card-header profile-header">
                            <div class="header-icon-wrapper">
                                <div class="header-icon-bg profile">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                            <div class="header-info">
                                <h5 class="card-title">Informasi Profil</h5>
                                <p class="card-subtitle">Detail lengkap akun Anda</p>
                            </div>
                            <div class="profile-role">
                                @if(auth()->user()->role == 'admin')
                                    <div class="enhanced-badge enhanced-badge-sm admin-badge">
                                        <div class="badge-icon">
                                            <i class="fas fa-crown"></i>
                                        </div>
                                        <div class="badge-content">
                                            <div class="badge-title">ADMIN</div>
                                            <div class="badge-subtitle">Administrator</div>
                                        </div>
                                        <div class="badge-glow admin-glow"></div>
                                    </div>
                                @elseif(auth()->user()->role == 'pemilik')
                                    <div class="enhanced-badge enhanced-badge-sm owner-badge">
                                        <div class="badge-icon">
                                            <i class="fas fa-user-tie"></i>
                                        </div>
                                        <div class="badge-content">
                                            <div class="badge-title">PEMILIK</div>
                                            <div class="badge-subtitle">Pemilik Kos</div>
                                        </div>
                                        <div class="badge-glow owner-glow"></div>
                                    </div>
                                @else
                                    <div class="enhanced-badge enhanced-badge-sm tenant-badge">
                                        <div class="badge-icon">
                                            <i class="fas fa-user-friends"></i>
                                        </div>
                                        <div class="badge-content">
                                            <div class="badge-title">PENYEWA</div>
                                            <div class="badge-subtitle">Pencari Kos</div>
                                        </div>
                                        <div class="badge-glow tenant-glow"></div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="card-content">
                            <div class="row">
                                <!-- Avatar Section -->
                                <div class="col-md-4 text-center mb-4">
                                    <div class="profile-avatar-wrapper">
                                        <div class="profile-avatar">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <div class="avatar-overlay">
                                            <i class="fas fa-camera"></i>
                                            <span>Ubah Foto</span>
                                        </div>
                                    </div>
                                    <h5 class="profile-name">{{ auth()->user()->name }}</h5>
                                    <div class="verification-status">
                                        @if(auth()->user()->email_verified_at)
                                            <div class="enhanced-badge enhanced-badge-xs status-verified">
                                                <div class="badge-icon">
                                                    <i class="fas fa-check-circle"></i>
                                                </div>
                                                <div class="badge-content">
                                                    <div class="badge-title">VERIFIED</div>
                                                    <div class="badge-subtitle">Terverifikasi</div>
                                                </div>
                                                <div class="badge-glow status-verified-glow"></div>
                                            </div>
                                        @else
                                            <div class="enhanced-badge enhanced-badge-xs status-unverified">
                                                <div class="badge-icon">
                                                    <i class="fas fa-exclamation-circle"></i>
                                                </div>
                                                <div class="badge-content">
                                                    <div class="badge-title">UNVERIFIED</div>
                                                    <div class="badge-subtitle">Belum Verifikasi</div>
                                                </div>
                                                <div class="badge-glow status-unverified-glow"></div>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Profile Details -->
                                <div class="col-md-8">
                                    <div class="profile-details">
                                        <div class="detail-item">
                                            <div class="detail-label">
                                                <i class="fas fa-user me-2"></i>Nama Lengkap
                                            </div>
                                            <div class="detail-value">{{ auth()->user()->name }}</div>
                                        </div>

                                        <div class="detail-item">
                                            <div class="detail-label">
                                                <i class="fas fa-envelope me-2"></i>Email
                                            </div>
                                            <div class="detail-value">
                                                <a href="mailto:{{ auth()->user()->email }}" class="email-link">
                                                    {{ auth()->user()->email }}
                                                </a>
                                                @if(auth()->user()->email_verified_at)
                                                    <i class="fas fa-check-circle text-success ms-2" title="Terverifikasi"></i>
                                                @else
                                                    <i class="fas fa-exclamation-circle text-warning ms-2"
                                                        title="Belum Terverifikasi"></i>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="detail-item">
                                            <div class="detail-label">
                                                <i class="fas fa-phone me-2"></i>Nomor Telepon
                                            </div>
                                            <div class="detail-value">
                                                @if(auth()->user()->phone)
                                                    <a href="tel:{{ auth()->user()->phone }}" class="phone-link">
                                                        {{ auth()->user()->phone }}
                                                    </a>
                                                @else
                                                    <span class="text-muted">Belum diisi</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="detail-item">
                                            <div class="detail-label">
                                                <i class="fas fa-user-tag me-2"></i>Peran
                                            </div>
                                            <div class="detail-value">
                                                @if(auth()->user()->role == 'admin')
                                                    Administrator Sistem
                                                @elseif(auth()->user()->role == 'pemilik')
                                                    Pemilik Kos
                                                @else
                                                    Pencari Kos
                                                @endif
                                            </div>
                                        </div>

                                        <div class="detail-item">
                                            <div class="detail-label">
                                                <i class="fas fa-calendar-plus me-2"></i>Bergabung Sejak
                                            </div>
                                            <div class="detail-value">
                                                {{ auth()->user()->created_at->format('d F Y') }}
                                                <small
                                                    class="text-muted">({{ auth()->user()->created_at->diffForHumans() }})</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Statistics Sidebar -->
                <div class="col-lg-4">
                    <div class="glass-card stats-card">
                        <div class="card-header stats-header">
                            <div class="header-icon-wrapper">
                                <div class="header-icon-bg stats">
                                    <i class="fas fa-chart-bar"></i>
                                </div>
                            </div>
                            <div class="header-info">
                                <h5 class="card-title">Statistik</h5>
                                <p class="card-subtitle">Ringkasan aktivitas Anda</p>
                            </div>
                        </div>

                        <div class="card-content">
                            <div class="stats-grid">
                                @if(auth()->user()->role == 'pemilik')
                                                        <div class="stat-card primary-stat">
                                                            <div class="stat-icon primary">
                                                                <i class="fas fa-home"></i>
                                                            </div>
                                                            <div class="stat-content">
                                                                <div class="stat-header">
                                                                    <h6 class="stat-label">Total Kos</h6>
                                                                    <div class="stat-trend up">
                                                                        <i class="fas fa-arrow-up"></i>
                                                                    </div>
                                                                </div>
                                                                <h2 class="stat-number">{{ auth()->user()->kos()->count() }}</h2>
                                                                <p class="stat-description">Properti terdaftar</p>
                                                            </div>
                                                        </div>

                                                        <div class="stat-card success-stat">
                                                            <div class="stat-icon success">
                                                                <i class="fas fa-check-circle"></i>
                                                            </div>
                                                            <div class="stat-content">
                                                                <div class="stat-header">
                                                                    <h6 class="stat-label">Kos Terverifikasi</h6>
                                                                    <div class="stat-trend up">
                                                                        <i class="fas fa-arrow-up"></i>
                                                                    </div>
                                                                </div>
                                                                <h2 class="stat-number">
                                                                    {{ auth()->user()->kos()->where('is_verified', true)->count() }}
                                                                </h2>
                                                                <p class="stat-description">Sudah diverifikasi</p>
                                                            </div>
                                                        </div>

                                                        <div class="stat-card info-stat">
                                                            <div class="stat-icon info">
                                                                <i class="fas fa-envelope"></i>
                                                            </div>
                                                            <div class="stat-content">
                                                                <div class="stat-header">
                                                                    <h6 class="stat-label">Total Kontak</h6>
                                                                    <div class="stat-trend neutral">
                                                                        <i class="fas fa-minus"></i>
                                                                    </div>
                                                                </div>
                                                                <h2 class="stat-number">
                                                                    {{ \App\Models\Transaksi::whereHas('kos', function ($q) {
                                    $q->where('user_id', auth()->id()); })->count() }}
                                                                </h2>
                                                                <p class="stat-description">Pesan masuk</p>
                                                            </div>
                                                        </div>
                                @elseif(auth()->user()->role == 'penyewa')
                                    <div class="stat-card primary-stat">
                                        <div class="stat-icon primary">
                                            <i class="fas fa-envelope"></i>
                                        </div>
                                        <div class="stat-content">
                                            <div class="stat-header">
                                                <h6 class="stat-label">Total Kontak</h6>
                                                <div class="stat-trend up">
                                                    <i class="fas fa-arrow-up"></i>
                                                </div>
                                            </div>
                                            <h2 class="stat-number">{{ auth()->user()->transaksis()->count() }}</h2>
                                            <p class="stat-description">Pesan dikirim</p>
                                        </div>
                                    </div>

                                    <div class="stat-card warning-stat">
                                        <div class="stat-icon warning">
                                            <i class="fas fa-clock"></i>
                                        </div>
                                        <div class="stat-content">
                                            <div class="stat-header">
                                                <h6 class="stat-label">Kontak Pending</h6>
                                                <div class="stat-trend neutral">
                                                    <i class="fas fa-minus"></i>
                                                </div>
                                            </div>
                                            <h2 class="stat-number">
                                                {{ auth()->user()->transaksis()->where('status_transaksi', 'pending')->count() }}
                                            </h2>
                                            <p class="stat-description">Menunggu respon</p>
                                        </div>
                                    </div>
                                @else
                                    <div class="stat-card primary-stat">
                                        <div class="stat-icon primary">
                                            <i class="fas fa-users"></i>
                                        </div>
                                        <div class="stat-content">
                                            <div class="stat-header">
                                                <h6 class="stat-label">Total Pengguna</h6>
                                                <div class="stat-trend up">
                                                    <i class="fas fa-arrow-up"></i>
                                                </div>
                                            </div>
                                            <h2 class="stat-number">{{ \App\Models\User::count() }}</h2>
                                            <p class="stat-description">Pengguna terdaftar</p>
                                        </div>
                                    </div>

                                    <div class="stat-card success-stat">
                                        <div class="stat-icon success">
                                            <i class="fas fa-home"></i>
                                        </div>
                                        <div class="stat-content">
                                            <div class="stat-header">
                                                <h6 class="stat-label">Total Kos</h6>
                                                <div class="stat-trend up">
                                                    <i class="fas fa-arrow-up"></i>
                                                </div>
                                            </div>
                                            <h2 class="stat-number">{{ \App\Models\Kos::count() }}</h2>
                                            <p class="stat-description">Properti terdaftar</p>
                                        </div>
                                    </div>

                                    <div class="stat-card warning-stat">
                                        <div class="stat-icon warning">
                                            <i class="fas fa-clock"></i>
                                        </div>
                                        <div class="stat-content">
                                            <div class="stat-header">
                                                <h6 class="stat-label">Pending Verifikasi</h6>
                                                <div class="stat-trend neutral">
                                                    <i class="fas fa-minus"></i>
                                                </div>
                                            </div>
                                            <h2 class="stat-number">{{ \App\Models\Kos::where('is_verified', false)->count() }}
                                            </h2>
                                            <p class="stat-description">Menunggu verifikasi</p>
                                        </div>
                                    </div>

                                    <div class="stat-card info-stat">
                                        <div class="stat-icon info">
                                            <i class="fas fa-envelope"></i>
                                        </div>
                                        <div class="stat-content">
                                            <div class="stat-header">
                                                <h6 class="stat-label">Total Kontak</h6>
                                                <div class="stat-trend up">
                                                    <i class="fas fa-arrow-up"></i>
                                                </div>
                                            </div>
                                            <h2 class="stat-number">{{ \App\Models\Transaksi::count() }}</h2>
                                            <p class="stat-description">Semua transaksi</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="glass-card actions-card mt-4">
                        <div class="card-header actions-header">
                            <div class="header-icon-wrapper">
                                <div class="header-icon-bg actions">
                                    <i class="fas fa-bolt"></i>
                                </div>
                            </div>
                            <div class="header-info">
                                <h5 class="card-title">Aksi Cepat</h5>
                                <p class="card-subtitle">Navigasi dan pengaturan</p>
                            </div>
                        </div>

                        <div class="card-content">
                            <div class="actions-grid">
                                @if(auth()->user()->role == 'admin')
                                    <a href="{{ route('admin.users') }}" class="action-btn">
                                        <i class="fas fa-users"></i>
                                        <span>Kelola Pengguna</span>
                                    </a>
                                    <a href="{{ route('admin.verify-kos') }}" class="action-btn">
                                        <i class="fas fa-check-circle"></i>
                                        <span>Verifikasi Kos</span>
                                    </a>
                                @elseif(auth()->user()->role == 'pemilik')
                                    <a href="{{ route('pemilik.my-kos') }}" class="action-btn">
                                        <i class="fas fa-building"></i>
                                        <span>Kos Saya</span>
                                    </a>
                                    <a href="{{ route('pemilik.kos.create') }}" class="action-btn">
                                        <i class="fas fa-plus-circle"></i>
                                        <span>Tambah Kos</span>
                                    </a>
                                    <a href="{{ route('pemilik.messages') }}" class="action-btn">
                                        <i class="fas fa-envelope"></i>
                                        <span>Pesan</span>
                                    </a>
                                @else
                                    <a href="{{ route('search') }}" class="action-btn">
                                        <i class="fas fa-search"></i>
                                        <span>Cari Kos</span>
                                    </a>
                                    <a href="{{ route('my-transaksi') }}" class="action-btn">
                                        <i class="fas fa-receipt"></i>
                                        <span>Transaksi</span>
                                    </a>
                                    <a href="{{ route('my-messages') }}" class="action-btn">
                                        <i class="fas fa-comments"></i>
                                        <span>Pesan Saya</span>
                                    </a>
                                @endif

                                <button class="action-btn logout-btn" onclick="confirmLogout()">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <span>Logout</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Logout Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content glass-modal">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-sign-out-alt text-warning me-2"></i>
                        Konfirmasi Logout
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <p class="modal-text">Apakah Anda yakin ingin keluar dari akun?</p>
                    <p class="modal-warning">
                        <i class="fas fa-info-circle me-2"></i>
                        Anda akan diarahkan ke halaman login setelah logout.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="glass-btn glass-btn-outline" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Batal
                    </button>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="glass-btn glass-btn-danger">
                            <i class="fas fa-sign-out-alt me-2"></i>Ya, Logout
                        </button>
                    </form>
                </div>
            </div>
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
                --gradient-danger: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);
                --gradient-background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #4facfe 100%);
            }

            .glassmorphism-profile {
                background: var(--gradient-background);
                min-height: 100vh;
                position: relative;
                overflow-x: hidden;
            }

            .glassmorphism-profile::before {
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

            /* Enhanced Badge Styles */
            .enhanced-badge {
                position: relative;
                display: flex;
                align-items: center;
                gap: 0.75rem;
                padding: 0.75rem 1rem;
                border-radius: 16px;
                min-width: 140px;
                backdrop-filter: blur(20px);
                border: 2px solid;
                overflow: hidden;
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                cursor: pointer;
                box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
            }

            .enhanced-badge:hover {
                transform: translateY(-3px) scale(1.05);
                box-shadow: 0 15px 40px rgba(0, 0, 0, 0.25);
            }

            .badge-icon {
                width: 32px;
                height: 32px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 0.9rem;
                flex-shrink: 0;
                position: relative;
                z-index: 2;
            }

            .badge-content {
                flex-grow: 1;
                text-align: left;
            }

            .badge-title {
                font-family: 'Poppins', sans-serif;
                font-size: 0.75rem;
                font-weight: 800;
                letter-spacing: 1px;
                margin-bottom: 0.1rem;
                line-height: 1;
            }

            .badge-subtitle {
                font-size: 0.65rem;
                font-weight: 500;
                opacity: 0.9;
                line-height: 1;
            }

            .badge-glow {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                border-radius: 16px;
                opacity: 0.1;
                transition: opacity 0.3s ease;
            }

            .enhanced-badge:hover .badge-glow {
                opacity: 0.2;
            }

            /* Admin Badge */
            .admin-badge {
                background: linear-gradient(135deg, rgba(220, 38, 38, 0.2) 0%, rgba(153, 27, 27, 0.15) 100%);
                border-color: rgba(220, 38, 38, 0.4);
                color: #ffffff;
            }

            .admin-badge .badge-icon {
                background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%);
                color: #ffffff;
                box-shadow: 0 4px 15px rgba(220, 38, 38, 0.4);
            }

            .admin-glow {
                background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%);
            }

            /* Owner Badge */
            .owner-badge {
                background: linear-gradient(135deg, rgba(59, 130, 246, 0.2) 0%, rgba(37, 99, 235, 0.15) 100%);
                border-color: rgba(59, 130, 246, 0.4);
                color: #ffffff;
            }

            .owner-badge .badge-icon {
                background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
                color: #ffffff;
                box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4);
            }

            .owner-glow {
                background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            }

            /* Tenant Badge */
            .tenant-badge {
                background: linear-gradient(135deg, rgba(34, 197, 94, 0.2) 0%, rgba(21, 128, 61, 0.15) 100%);
                border-color: rgba(34, 197, 94, 0.4);
                color: #ffffff;
            }

            .tenant-badge .badge-icon {
                background: linear-gradient(135deg, #22c55e 0%, #15803d 100%);
                color: #ffffff;
                box-shadow: 0 4px 15px rgba(34, 197, 94, 0.4);
            }

            .tenant-glow {
                background: linear-gradient(135deg, #22c55e 0%, #15803d 100%);
            }

            /* Verification Badges */
            .status-verified {
                background: linear-gradient(135deg, rgba(34, 197, 94, 0.2) 0%, rgba(21, 128, 61, 0.15) 100%);
                border-color: rgba(34, 197, 94, 0.4);
                color: #ffffff;
            }

            .status-verified .badge-icon {
                background: linear-gradient(135deg, #22c55e 0%, #15803d 100%);
                color: #ffffff;
                box-shadow: 0 4px 15px rgba(34, 197, 94, 0.4);
            }

            .status-verified-glow {
                background: linear-gradient(135deg, #22c55e 0%, #15803d 100%);
            }

            .status-unverified {
                background: linear-gradient(135deg, rgba(245, 158, 11, 0.2) 0%, rgba(217, 119, 6, 0.15) 100%);
                border-color: rgba(245, 158, 11, 0.4);
                color: #ffffff;
            }

            .status-unverified .badge-icon {
                background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
                color: #ffffff;
                box-shadow: 0 4px 15px rgba(245, 158, 11, 0.4);
            }

            .status-unverified-glow {
                background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            }

            /* Small Badge Variant */
            .enhanced-badge-sm {
                min-width: 100px;
                padding: 0.5rem 0.75rem;
                gap: 0.5rem;
            }

            .enhanced-badge-sm .badge-icon {
                width: 24px;
                height: 24px;
                font-size: 0.75rem;
            }

            .enhanced-badge-sm .badge-title {
                font-size: 0.65rem;
            }

            .enhanced-badge-sm .badge-subtitle {
                font-size: 0.55rem;
            }

            /* Extra Small Badge Variant */
            .enhanced-badge-xs {
                min-width: 80px;
                padding: 0.4rem 0.6rem;
                gap: 0.4rem;
                border-radius: 12px;
            }

            .enhanced-badge-xs .badge-icon {
                width: 20px;
                height: 20px;
                font-size: 0.65rem;
            }

            .enhanced-badge-xs .badge-title {
                font-size: 0.6rem;
            }

            .enhanced-badge-xs .badge-subtitle {
                font-size: 0.5rem;
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

            /* Page Header */
            .page-header {
                padding: 2.5rem;
            }

            .page-header:hover {
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

            .page-title {
                font-family: 'Poppins', sans-serif;
                font-size: 2.5rem;
                font-weight: 800;
                color: var(--white);
                margin-bottom: 0.5rem;
            }

            .page-subtitle {
                font-size: 1.1rem;
                color: rgba(255, 255, 255, 0.8);
                margin: 0;
            }

            /* Card Headers */
            .card-header {
                padding: 2rem;
                border-bottom: 1px solid var(--glass-border);
                display: flex;
                align-items: center;
                gap: 1rem;
                background: var(--glass-bg-light);
            }

            .header-icon-wrapper {
                flex-shrink: 0;
            }

            .header-icon-bg {
                width: 60px;
                height: 60px;
                border-radius: 15px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.5rem;
                color: var(--white);
            }

            .header-icon-bg.profile {
                background: var(--gradient-secondary);
            }

            .header-icon-bg.stats {
                background: var(--gradient-accent);
            }

            .header-icon-bg.actions {
                background: var(--gradient-success);
            }

            .header-info {
                flex-grow: 1;
            }

            .card-title {
                font-family: 'Poppins', sans-serif;
                font-size: 1.3rem;
                font-weight: 700;
                color: var(--white);
                margin-bottom: 0.25rem;
            }

            .card-subtitle {
                color: rgba(255, 255, 255, 0.7);
                font-size: 0.9rem;
                margin: 0;
            }

            .card-content {
                padding: 2rem;
            }

            /* Profile Avatar */
            .profile-avatar-wrapper {
                position: relative;
                display: inline-block;
                margin-bottom: 1.5rem;
                cursor: pointer;
            }

            .profile-avatar {
                width: 120px;
                height: 120px;
                border-radius: 50%;
                background: var(--gradient-primary);
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 3rem;
                color: var(--white);
                box-shadow: 0 15px 40px rgba(102, 126, 234, 0.4);
                transition: all 0.4s ease;
            }

            .avatar-overlay {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.6);
                border-radius: 50%;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                opacity: 0;
                transition: all 0.3s ease;
                color: var(--white);
                font-size: 0.8rem;
                gap: 0.25rem;
            }

            .profile-avatar-wrapper:hover .avatar-overlay {
                opacity: 1;
            }

            .profile-avatar-wrapper:hover .profile-avatar {
                transform: scale(1.05);
            }

            .profile-name {
                font-family: 'Poppins', sans-serif;
                font-size: 1.5rem;
                font-weight: 700;
                color: var(--white);
                margin-bottom: 1rem;
            }

            .verification-status {
                margin-bottom: 1rem;
            }

            /* Profile Details */
            .profile-details {
                display: flex;
                flex-direction: column;
                gap: 1.5rem;
            }

            .detail-item {
                display: flex;
                flex-direction: column;
                gap: 0.5rem;
                padding: 1rem;
                background: var(--glass-bg);
                border: 1px solid var(--glass-border);
                border-radius: 15px;
                transition: all 0.3s ease;
            }

            .detail-item:hover {
                background: var(--glass-bg-light);
                transform: translateY(-2px);
            }

            .detail-label {
                color: rgba(255, 255, 255, 0.7);
                font-size: 0.9rem;
                font-weight: 600;
                display: flex;
                align-items: center;
            }

            .detail-value {
                color: var(--white);
                font-size: 1rem;
                font-weight: 500;
            }

            .email-link,
            .phone-link {
                color: #60a5fa;
                text-decoration: none;
                transition: all 0.3s ease;
            }

            .email-link:hover,
            .phone-link:hover {
                color: var(--white);
                text-decoration: underline;
            }

            /* Statistics Cards */
            .stats-grid {
                display: flex;
                flex-direction: column;
                gap: 1.5rem;
            }

            .stat-card {
                padding: 1.5rem;
                background: var(--glass-bg);
                border: 1px solid var(--glass-border);
                border-radius: 20px;
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
                width: 80px;
                height: 80px;
                background: linear-gradient(45deg, rgba(255, 255, 255, 0.1), transparent);
                border-radius: 50%;
                transform: translate(20px, -20px);
                transition: all 0.3s ease;
            }

            .stat-card:hover {
                transform: translateY(-5px) scale(1.02);
                box-shadow: var(--glass-shadow-hover);
            }

            .stat-card:hover::after {
                transform: translate(15px, -15px) scale(1.2);
            }

            .primary-stat:hover {
                background: rgba(102, 126, 234, 0.1);
            }

            .success-stat:hover {
                background: rgba(17, 153, 142, 0.1);
            }

            .warning-stat:hover {
                background: rgba(245, 158, 11, 0.1);
            }

            .info-stat:hover {
                background: rgba(14, 165, 233, 0.1);
            }

            .stat-icon {
                width: 50px;
                height: 50px;
                border-radius: 12px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.2rem;
                color: var(--white);
                margin-bottom: 1rem;
                position: relative;
                z-index: 2;
            }

            .stat-icon.primary {
                background: var(--gradient-primary);
                box-shadow: 0 6px 20px rgba(102, 126, 234, 0.3);
            }

            .stat-icon.success {
                background: var(--gradient-success);
                box-shadow: 0 6px 20px rgba(17, 153, 142, 0.3);
            }

            .stat-icon.warning {
                background: var(--gradient-accent);
                box-shadow: 0 6px 20px rgba(245, 158, 11, 0.3);
            }

            .stat-icon.info {
                background: var(--gradient-info);
                box-shadow: 0 6px 20px rgba(14, 165, 233, 0.3);
            }

            .stat-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 0.75rem;
            }

            .stat-label {
                font-family: 'Poppins', sans-serif;
                font-size: 0.8rem;
                font-weight: 600;
                color: rgba(255, 255, 255, 0.8);
                margin: 0;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            .stat-trend {
                width: 24px;
                height: 24px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 0.7rem;
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
                font-size: 2rem;
                font-weight: 900;
                color: var(--white);
                margin-bottom: 0.5rem;
                line-height: 1;
            }

            .stat-description {
                color: rgba(255, 255, 255, 0.7);
                font-size: 0.85rem;
                margin: 0;
            }

            /* Action Buttons */
            .actions-grid {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
            }

            .action-btn {
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 0.5rem;
                padding: 1rem;
                background: var(--glass-bg);
                border: 1px solid var(--glass-border);
                border-radius: 15px;
                color: var(--white);
                text-decoration: none;
                transition: all 0.3s ease;
                cursor: pointer;
                font-size: 0.9rem;
            }

            .action-btn:hover {
                background: var(--glass-bg-light);
                color: var(--white);
                transform: translateY(-3px);
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            }

            .action-btn i {
                font-size: 1.5rem;
            }

            .logout-btn:hover {
                background: rgba(239, 68, 68, 0.1);
                border-color: rgba(239, 68, 68, 0.3);
                color: #ef4444;
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

            .glass-btn-danger {
                background: var(--gradient-danger);
                color: var(--white);
                border: none;
                box-shadow: 0 4px 20px rgba(239, 68, 68, 0.4);
            }

            .glass-btn-danger:hover {
                box-shadow: 0 8px 30px rgba(239, 68, 68, 0.6);
                color: var(--white);
                transform: translateY(-2px);
            }

            /* Modal Styling */
            .glass-modal {
                background: var(--glass-bg);
                backdrop-filter: blur(25px);
                border: 1px solid var(--glass-border);
                border-radius: 20px;
                box-shadow: var(--glass-shadow);
            }

            .glass-modal .modal-header {
                border-bottom: 1px solid var(--glass-border);
                background: var(--glass-bg-light);
                color: var(--white);
            }

            .glass-modal .modal-body {
                color: var(--white);
            }

            .glass-modal .modal-footer {
                border-top: 1px solid var(--glass-border);
                background: var(--glass-bg-light);
            }

            .modal-text {
                font-size: 1.1rem;
                margin-bottom: 1rem;
            }

            .modal-warning {
                background: rgba(245, 158, 11, 0.1);
                border: 1px solid rgba(245, 158, 11, 0.3);
                border-radius: 10px;
                padding: 1rem;
                color: #fbbf24;
                font-size: 0.9rem;
                margin: 0;
            }

            .btn-close {
                filter: brightness(0) invert(1);
                opacity: 0.8;
            }

            .btn-close:hover {
                opacity: 1;
            }

            /* Responsive Design */
            @media (max-width: 768px) {
                .enhanced-badge {
                    min-width: 110px;
                    padding: 0.6rem 0.8rem;
                }

                .badge-icon {
                    width: 28px;
                    height: 28px;
                    font-size: 0.8rem;
                }

                .badge-title {
                    font-size: 0.7rem;
                }

                .badge-subtitle {
                    font-size: 0.6rem;
                }

                .page-header {
                    padding: 2rem;
                }

                .header-content {
                    flex-direction: column;
                    text-align: center;
                    gap: 1rem;
                }

                .page-title {
                    font-size: 2rem;
                }

                .header-actions {
                    width: 100%;
                }

                .header-actions .glass-btn {
                    width: 100%;
                }

                .card-header {
                    padding: 1.5rem;
                    flex-direction: column;
                    text-align: center;
                    gap: 1rem;
                }

                .card-content {
                    padding: 1.5rem;
                }

                .profile-avatar {
                    width: 100px;
                    height: 100px;
                    font-size: 2.5rem;
                }

                .actions-grid {
                    grid-template-columns: 1fr;
                }

                .d-flex.justify-content-between {
                    flex-direction: column;
                    gap: 1rem;
                }
            }

            @media (max-width: 576px) {
                .enhanced-badge {
                    min-width: 100px;
                    padding: 0.5rem 0.6rem;
                    flex-direction: column;
                    text-align: center;
                    gap: 0.4rem;
                }

                .badge-icon {
                    width: 24px;
                    height: 24px;
                    font-size: 0.75rem;
                }

                .badge-title {
                    font-size: 0.65rem;
                }

                .badge-subtitle {
                    font-size: 0.55rem;
                }

                .page-title {
                    font-size: 1.75rem;
                }

                .header-icon {
                    width: 60px;
                    height: 60px;
                    font-size: 1.5rem;
                }

                .header-icon-bg {
                    width: 50px;
                    height: 50px;
                    font-size: 1.2rem;
                }

                .card-header {
                    padding: 1rem;
                }

                .card-content {
                    padding: 1rem;
                }

                .profile-avatar {
                    width: 80px;
                    height: 80px;
                    font-size: 2rem;
                }

                .stat-number {
                    font-size: 1.5rem;
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
            .glass-btn:focus,
            .action-btn:focus,
            .enhanced-badge:focus {
                outline: 2px solid rgba(255, 255, 255, 0.5);
                outline-offset: 2px;
            }

            /* Text Selection */
            ::selection {
                background: rgba(255, 255, 255, 0.2);
                color: var(--white);
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            // Confirm logout function
            function confirmLogout() {
                const modal = new bootstrap.Modal(document.getElementById('logoutModal'));
                modal.show();
            }

            // Enhanced interactions
            document.querySelectorAll('.enhanced-badge').forEach(badge => {
                badge.addEventListener('mouseenter', function () {
                    this.style.boxShadow = '0 20px 50px rgba(0, 0, 0, 0.3)';
                });

                badge.addEventListener('mouseleave', function () {
                    this.style.boxShadow = '';
                });
            });

            // Animate statistics on load
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

            // Enhanced stat card interactions
            document.querySelectorAll('.stat-card').forEach(card => {
                card.addEventListener('click', function () {
                    this.style.transform = 'scale(0.98)';
                    setTimeout(() => {
                        this.style.transform = '';
                    }, 150);
                });
            });

            // Action button ripple effect
            document.querySelectorAll('.action-btn, .glass-btn, .enhanced-badge').forEach(element => {
                element.addEventListener('click', function (e) {
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
                                animation: rippleEffect 0.6s linear;
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

            // Copy contact info functionality
            document.querySelectorAll('.email-link, .phone-link').forEach(link => {
                link.addEventListener('contextmenu', function (e) {
                    e.preventDefault();
                    const text = this.textContent;
                    if (navigator.clipboard) {
                        navigator.clipboard.writeText(text).then(() => {
                            showNotification(`${text} disalin ke clipboard`, 'success');
                        });
                    }
                });
            });

            // Notification system
            function showNotification(message, type = 'info') {
                const existingNotification = document.querySelector('.notification');
                if (existingNotification) {
                    existingNotification.remove();
                }

                const notification = document.createElement('div');
                notification.className = `notification notification-${type}`;
                notification.innerHTML = `
                            <i class="fas fa-${type === 'success' ? 'check' : 'info'}-circle me-2"></i>
                            ${message}
                        `;

                document.body.appendChild(notification);

                setTimeout(() => {
                    notification.classList.add('show');
                }, 100);

                setTimeout(() => {
                    notification.classList.remove('show');
                    setTimeout(() => {
                        if (notification.parentNode) {
                            notification.parentNode.removeChild(notification);
                        }
                    }, 300);
                }, 3000);
            }

            // Add notification styles
            const notificationStyles = `
                        .notification {
                            position: fixed;
                            top: 120px;
                            right: 20px;
                            background: var(--glass-bg);
                            backdrop-filter: blur(25px);
                            border: 1px solid var(--glass-border);
                            border-radius: 15px;
                            padding: 1rem 1.5rem;
                            color: var(--white);
                            font-weight: 500;
                            z-index: 9999;
                            transform: translateX(400px);
                            transition: transform 0.3s ease;
                            box-shadow: var(--glass-shadow);
                        }

                        .notification.show {
                            transform: translateX(0);
                        }

                        .notification-success {
                            border-color: rgba(34, 197, 94, 0.3);
                            background: rgba(34, 197, 94, 0.1);
                        }
                    `;

            const styleSheet = document.createElement('style');
            styleSheet.textContent = notificationStyles;
            document.head.appendChild(styleSheet);

            // Add CSS for ripple effect
            const rippleStyles = `
                        @keyframes rippleEffect {
                            to {
                                transform: scale(4);
                                opacity: 0;
                            }
                        }
                    `;

            const rippleStyleSheet = document.createElement('style');
            rippleStyleSheet.textContent = rippleStyles;
            document.head.appendChild(rippleStyleSheet);

            // Intersection Observer for entrance animations
            const observerOptions = {
                root: null,
                rootMargin: '50px',
                threshold: 0.1
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.glass-card').forEach(card => {
                observer.observe(card);
            });

            // Add entrance animation styles
            const entranceStyles = `
                        .glass-card {
                            opacity: 0;
                            transform: translateY(30px);
                            transition: opacity 0.8s ease, transform 0.8s ease;
                        }

                        .glass-card.visible {
                            opacity: 1;
                            transform: translateY(0);
                        }
                    `;

            const entranceStyleSheet = document.createElement('style');
            entranceStyleSheet.textContent = entranceStyles;
            document.head.appendChild(entranceStyleSheet);

            // Initialize animations when page loads
            window.addEventListener('load', function () {
                setTimeout(() => {
                    document.querySelectorAll('.glass-card').forEach(card => {
                        card.classList.add('visible');
                    });
                }, 300);

                setTimeout(animateNumbers, 800);

                setTimeout(() => {
                    showNotification('Profile dimuat', 'success');
                }, 1200);
            });

            // Keyboard shortcuts
            document.addEventListener('keydown', function (e) {
                if (e.altKey && e.key === 'l') {
                    e.preventDefault();
                    confirmLogout();
                }
            });

            console.log('Enhanced Profile Interface Loaded Successfully!');
        </script>
    @endpush
@endsection