@extends('layouts.app')

@section('title', 'Dashboard Pemilik - Rent House')

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
                                    <i class="fas fa-tachometer-alt"></i>
                                </div>
                                <div class="header-text">
                                    <h1 class="dashboard-title">Dashboard Pemilik</h1>
                                    <p class="dashboard-subtitle">Kelola kontrakan dan pantau aktivitas Anda</p>
                                </div>
                            </div>
                            <div class="header-actions">
                                <a href="{{ route('pemilik.kos.create') }}" class="glass-btn glass-btn-primary">
                                    <i class="fas fa-plus me-2"></i>Tambah Kontrakan Baru
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="row g-4 mb-5">
                <!-- Total Kos -->
                <div class="col-md-6 col-lg-3">
                    <div class="glass-card stat-card primary-stat">
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
                            <h2 class="stat-number">{{ $totalKos }}</h2>
                            <p class="stat-description">Semua listing kontrakan Anda</p>
                        </div>
                    </div>
                </div>

                <!-- Verified Kos -->
                <div class="col-md-6 col-lg-3">
                    <div class="glass-card stat-card success-stat">
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
                            <h2 class="stat-number">{{ $verifiedKos }}</h2>
                            <p class="stat-description">Aktif dan terverifikasi</p>
                        </div>
                    </div>
                </div>

                <!-- Pending Verification -->
                <div class="col-md-6 col-lg-3">
                    <div class="glass-card stat-card warning-stat">
                        <div class="stat-icon warning">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-header">
                                <h6 class="stat-label">Menunggu Verifikasi</h6>
                                <div class="stat-trend neutral">
                                    <i class="fas fa-minus"></i>
                                </div>
                            </div>
                            <h2 class="stat-number">{{ $pendingKos }}</h2>
                            <p class="stat-description">Dalam proses review</p>
                        </div>
                    </div>
                </div>

                <!-- Total Contacts -->
                <div class="col-md-6 col-lg-3">
                    <div class="glass-card stat-card info-stat">
                        <div class="stat-icon info">
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
                            <p class="stat-description">Inquiry dari penyewa</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Kos Table -->
            <div class="row">
                <div class="col-12">
                    <div class="glass-card table-card">
                        <div class="card-header-custom">
                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                <div class="header-info">
                                    <h5 class="table-title">
                                        <i class="fas fa-building me-2"></i>Kos Terbaru
                                    </h5>
                                    <p class="table-subtitle">Kelola dan pantau listing kontrakan Anda</p>
                                </div>
                                <div class="header-actions">
                                    <a href="{{ route('pemilik.my-kos') }}" class="glass-btn glass-btn-outline">
                                        <i class="fas fa-eye me-2"></i>Lihat Semua
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body-custom">
                            @if($recentKos->count() > 0)
                                <div class="glass-table-wrapper">
                                    <div class="table-responsive">
                                        <table class="glass-table">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <i class="fas fa-home me-2"></i>Nama Kontrakan
                                                    </th>
                                                    <th>
                                                        <i class="fas fa-map-marker-alt me-2"></i>Lokasi
                                                    </th>
                                                    <th>
                                                        <i class="fas fa-money-bill-wave me-2"></i>Harga
                                                    </th>
                                                    <th>
                                                        <i class="fas fa-toggle-on me-2"></i>Status
                                                    </th>
                                                    <th>
                                                        <i class="fas fa-shield-check me-2"></i>Verifikasi
                                                    </th>
                                                    <th>
                                                        <i class="fas fa-cogs me-2"></i>Aksi
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($recentKos as $kos)
                                                    <tr class="table-row">
                                                        <td>
                                                            <div class="kos-info">
                                                                <div class="kos-name">{{ $kos->nama_kos }}</div>
                                                                <div class="kos-meta">ID: #{{ $kos->id }}</div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="location-info">
                                                                <i class="fas fa-map-pin location-icon"></i>
                                                                <span
                                                                    class="location-text">{{ Str::limit($kos->lokasi, 30) }}</span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="price-info">
                                                                <span class="price-amount">Rp
                                                                    {{ number_format($kos->harga, 0, ',', '.') }}</span>
                                                                <span class="price-period">/bulan</span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <span class="glass-badge status-{{ $kos->status_ketersediaan }}">
                                                                <i
                                                                    class="fas fa-{{ $kos->status_ketersediaan == 'tersedia' ? 'check' : 'times' }} me-1"></i>
                                                                {{ $kos->status_ketersediaan == 'tersedia' ? 'Tersedia' : 'Tidak Tersedia' }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <span
                                                                class="glass-badge verification-{{ $kos->is_verified ? 'verified' : 'pending' }}">
                                                                <i
                                                                    class="fas fa-{{ $kos->is_verified ? 'check-circle' : 'clock' }} me-1"></i>
                                                                {{ $kos->is_verified ? 'Terverifikasi' : 'Menunggu' }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <div class="action-buttons">
                                                                <a href="{{ route('pemilik.kos.edit', $kos->id) }}"
                                                                    class="glass-btn-sm glass-btn-primary" title="Edit Kos">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                                <button type="button" class="glass-btn-sm glass-btn-danger"
                                                                    onclick="deleteKos({{ $kos->id }}, '{{ $kos->nama_kos }}')"
                                                                    title="Hapus Kos">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @else
                                <!-- Empty State -->
                                <div class="empty-state">
                                    <div class="empty-icon">
                                        <i class="fas fa-home"></i>
                                    </div>
                                    <h5 class="empty-title">Belum Ada Kontrakan yang Ditambahkan</h5>
                                    <p class="empty-description">
                                        Mulai dengan menambahkan listing kontrakan pertama Anda dan jangkau ribuan calon penyewa
                                    </p>
                                    <div class="empty-actions">
                                        <a href="{{ route('pemilik.kos.create') }}" class="glass-btn glass-btn-primary">
                                            <i class="fas fa-plus me-2"></i>Tambah Kontrakan Pertama
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="row g-4 mt-4">
                <div class="col-md-4">
                    <div class="glass-card quick-action-card">
                        <div class="quick-icon primary">
                            <i class="fas fa-plus-circle"></i>
                        </div>
                        <h6 class="quick-title">Tambah Kontrakan Baru</h6>
                        <p class="quick-description">Buat listing kontrakan baru dan mulai menerima inquiries</p>
                        <a href="{{ route('pemilik.kos.create') }}" class="glass-btn glass-btn-outline w-100">
                            <i class="fas fa-arrow-right me-2"></i>Mulai Sekarang
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="glass-card quick-action-card">
                        <div class="quick-icon success">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <h6 class="quick-title">Kelola Pesan</h6>
                        <p class="quick-description">Lihat dan balas pesan dari calon penyewa</p>
                        <a href="{{ route('pemilik.messages') }}" class="glass-btn glass-btn-outline w-100">
                            <i class="fas fa-arrow-right me-2"></i>Lihat Pesan
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="glass-card quick-action-card">
                        <div class="quick-icon info">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h6 class="quick-title">Analitik</h6>
                        <p class="quick-description">Pantau performa dan statistik kontrakan Anda</p>
                        <a href="{{ route('pemilik.my-kos') }}" class="glass-btn glass-btn-outline w-100">
                            <i class="fas fa-arrow-right me-2"></i>Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content glass-modal">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-exclamation-triangle text-warning me-2"></i>
                        Konfirmasi Hapus
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="modal-text">Apakah Anda yakin ingin menghapus kontrakan <strong id="kosName"></strong>?</p>
                    <p class="modal-warning">
                        <i class="fas fa-info-circle me-2"></i>
                        Tindakan ini tidak dapat dibatalkan dan akan menghapus semua data terkait.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="glass-btn glass-btn-outline" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Batal
                    </button>
                    <form id="deleteForm" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="glass-btn glass-btn-danger">
                            <i class="fas fa-trash me-2"></i>Ya, Hapus
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

            .kos-info .kos-meta {
                color: rgba(255, 255, 255, 0.6);
                font-size: 0.8rem;
            }

            .location-info {
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }

            .location-icon {
                color: rgba(255, 255, 255, 0.6);
                font-size: 0.8rem;
            }

            .location-text {
                color: rgba(255, 255, 255, 0.9);
                font-size: 0.9rem;
            }

            .price-info .price-amount {
                color: var(--white);
                font-weight: 700;
                font-size: 1rem;
                display: block;
            }

            .price-info .price-period {
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

            .glass-badge.status-tersedia {
                background: rgba(34, 197, 94, 0.2);
                color: #22c55e;
                border-color: rgba(34, 197, 94, 0.3);
            }

            .glass-badge.status-tidak_tersedia {
                background: rgba(239, 68, 68, 0.2);
                color: #ef4444;
                border-color: rgba(239, 68, 68, 0.3);
            }

            .glass-badge.verification-verified {
                background: rgba(34, 197, 94, 0.2);
                color: #22c55e;
                border-color: rgba(34, 197, 94, 0.3);
            }

            .glass-badge.verification-pending {
                background: rgba(245, 158, 11, 0.2);
                color: #f59e0b;
                border-color: rgba(245, 158, 11, 0.3);
            }

            /* Action Buttons */
            .action-buttons {
                display: flex;
                gap: 0.5rem;
                align-items: center;
            }

            .glass-btn-sm {
                width: 36px;
                height: 36px;
                border-radius: 10px;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: all 0.3s ease;
                font-size: 0.9rem;
                text-decoration: none;
                border: 1px solid var(--glass-border);
                background: var(--glass-bg);
                backdrop-filter: blur(15px);
            }

            .glass-btn-sm.glass-btn-primary {
                color: #60a5fa;
                border-color: rgba(96, 165, 250, 0.3);
            }

            .glass-btn-sm.glass-btn-primary:hover {
                background: rgba(96, 165, 250, 0.1);
                color: var(--white);
                transform: scale(1.1);
            }

            .glass-btn-sm.glass-btn-danger {
                color: #ef4444;
                border-color: rgba(239, 68, 68, 0.3);
            }

            .glass-btn-sm.glass-btn-danger:hover {
                background: rgba(239, 68, 68, 0.1);
                color: var(--white);
                transform: scale(1.1);
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

            .glass-btn-danger {
                background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
                color: var(--white);
                border: none;
                box-shadow: 0 4px 20px rgba(239, 68, 68, 0.4);
            }

            .glass-btn-danger:hover {
                box-shadow: 0 8px 30px rgba(239, 68, 68, 0.6);
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

            .quick-icon.success {
                background: var(--gradient-success);
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

                .card-header-custom {
                    padding: 2rem 1.5rem 0;
                }

                .card-body-custom {
                    padding: 0 1.5rem 1.5rem;
                }

                .glass-table thead th,
                .glass-table tbody td {
                    padding: 1rem 0.75rem;
                    font-size: 0.85rem;
                }

                .quick-action-card {
                    padding: 1.5rem;
                }

                .empty-state {
                    padding: 3rem 1rem;
                }

                .d-flex.justify-content-between {
                    flex-direction: column;
                    gap: 1rem;
                }

                .header-actions {
                    align-self: stretch;
                }

                .action-buttons {
                    justify-content: center;
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

                .table-responsive {
                    font-size: 0.8rem;
                }

                .kos-info .kos-name {
                    font-size: 0.9rem;
                }

                .location-text {
                    font-size: 0.8rem;
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
            .glass-btn:focus,
            .glass-btn-sm:focus {
                outline: 2px solid rgba(255, 255, 255, 0.5);
                outline-offset: 2px;
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            // Delete Kos Modal
            function deleteKos(kosId, kosName) {
                document.getElementById('kosName').textContent = kosName;
                document.getElementById('deleteForm').action = `/pemilik/kos/${kosId}/delete`;

                const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
                modal.show();
            }

            // Add loading state to form submission
            document.getElementById('deleteForm').addEventListener('submit', function () {
                const submitBtn = this.querySelector('button[type="submit"]');
                const originalHtml = submitBtn.innerHTML;

                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menghapus...';
                submitBtn.disabled = true;

                // Re-enable button after 5 seconds (in case of error)
                setTimeout(() => {
                    submitBtn.innerHTML = originalHtml;
                    submitBtn.disabled = false;
                }, 5000);
            });

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
            document.querySelectorAll('.glass-btn, .glass-btn-sm').forEach(button => {
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

            // Run animations when page loads
            window.addEventListener('load', function () {
                setTimeout(animateNumbers, 500);
            });

            // Add hover sound effect (optional)
            document.querySelectorAll('.glass-card').forEach(card => {
                card.addEventListener('mouseenter', function () {
                    // Add subtle sound effect here if desired
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

            // Auto-refresh data every 5 minutes
            setInterval(() => {
                // You can add AJAX call here to refresh statistics
                console.log('Auto-refreshing dashboard data...');
            }, 300000);
        </script>
    @endpush
@endsection
