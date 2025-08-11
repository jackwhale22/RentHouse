@extends('layouts.app')

@section('title', 'Kos Saya - Kos Finder')

@section('content')
    <div class="container-fluid glassmorphism-my-kos">
        <div class="container py-5">
            <!-- Page Header -->
            <div class="row mb-5">
                <div class="col-12">
                    <div class="glass-card page-header">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <div class="header-content">
                                <div class="header-icon">
                                    <i class="fas fa-building"></i>
                                </div>
                                <div class="header-text">
                                    <h1 class="page-title">Kos Saya</h1>
                                    <p class="page-subtitle">Kelola semua listing kos Anda dalam satu tempat</p>
                                </div>
                            </div>
                            <div class="header-actions">
                                <a href="{{ route('pemilik.kos.create') }}" class="glass-btn glass-btn-primary">
                                    <i class="fas fa-plus me-2"></i>Tambah Kos Baru
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filter & Stats Bar -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="glass-card filter-stats-bar">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <div class="stats-summary">
                                <div class="stat-item">
                                    <span class="stat-value">{{ $kosList->total() }}</span>
                                    <span class="stat-label">Total Kos</span>
                                </div>
                                <div class="stat-divider"></div>
                                <div class="stat-item">
                                    <span class="stat-value">{{ $kosList->where('is_verified', true)->count() }}</span>
                                    <span class="stat-label">Terverifikasi</span>
                                </div>
                                <div class="stat-divider"></div>
                                <div class="stat-item">
                                    <span class="stat-value">{{ $kosList->where('status_ketersediaan', 'tersedia')->count() }}</span>
                                    <span class="stat-label">Tersedia</span>
                                </div>
                            </div>
                            <div class="view-options">
                                <div class="btn-group view-toggle" role="group">
                                    <button type="button" class="glass-btn-sm active" data-view="grid" title="Tampilan Grid">
                                        <i class="fas fa-th"></i>
                                    </button>
                                    <button type="button" class="glass-btn-sm" data-view="list" title="Tampilan List">
                                        <i class="fas fa-list"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kos Content -->
            <div class="row">
                <div class="col-12">
                    <div class="glass-card kos-content">
                        @if($kosList->count() > 0)
                            <!-- Grid View -->
                            <div id="gridView" class="kos-grid">
                                <div class="row g-4">
                                    @foreach($kosList as $kos)
                                        <div class="col-lg-4 col-md-6">
                                            <div class="glass-card kos-card">
                                                <!-- Kos Image -->
                                                <div class="kos-image-container">
                                                    @if($kos->mainPhoto)
                                                        <img src="{{ asset($kos->mainPhoto->foto_path) }}" 
                                                             alt="{{ $kos->nama_kos }}" 
                                                             class="kos-image">
                                                    @else
                                                        <div class="kos-image-placeholder">
                                                            <i class="fas fa-home"></i>
                                                        </div>
                                                    @endif

                                                    <!-- Enhanced Status Badges -->
                                                    <div class="image-overlay">
                                                        <div class="status-badges">
                                                            <!-- Verification Badge -->
                                                            @if($kos->is_verified)
                                                                <div class="enhanced-badge enhanced-badge-sm status-verified">
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
                                                                <div class="enhanced-badge enhanced-badge-sm status-pending">
                                                                    <div class="badge-icon">
                                                                        <i class="fas fa-clock"></i>
                                                                    </div>
                                                                    <div class="badge-content">
                                                                        <div class="badge-title">PENDING</div>
                                                                        <div class="badge-subtitle">Menunggu</div>
                                                                    </div>
                                                                    <div class="badge-glow status-pending-glow"></div>
                                                                </div>
                                                            @endif

                                                            <!-- Availability Badge -->
                                                            @if($kos->status_ketersediaan == 'tersedia')
                                                                <div class="enhanced-badge enhanced-badge-sm status-available">
                                                                    <div class="badge-icon">
                                                                        <i class="fas fa-check"></i>
                                                                    </div>
                                                                    <div class="badge-content">
                                                                        <div class="badge-title">AVAILABLE</div>
                                                                        <div class="badge-subtitle">Tersedia</div>
                                                                    </div>
                                                                    <div class="badge-glow status-available-glow"></div>
                                                                </div>
                                                            @else
                                                                <div class="enhanced-badge enhanced-badge-sm status-unavailable">
                                                                    <div class="badge-icon">
                                                                        <i class="fas fa-times"></i>
                                                                    </div>
                                                                    <div class="badge-content">
                                                                        <div class="badge-title">UNAVAILABLE</div>
                                                                        <div class="badge-subtitle">Tidak Tersedia</div>
                                                                    </div>
                                                                    <div class="badge-glow status-unavailable-glow"></div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Kos Content -->
                                                <div class="kos-card-content">
                                                    <div class="kos-header">
                                                        <h5 class="kos-title">{{ $kos->nama_kos }}</h5>
                                                        <div class="kos-meta">
                                                            <small>
                                                                <i class="fas fa-calendar-alt me-1"></i>
                                                                Ditambahkan {{ $kos->created_at->diffForHumans() }}
                                                            </small>
                                                        </div>
                                                    </div>

                                                    <div class="kos-location">
                                                        <i class="fas fa-map-marker-alt me-2"></i>
                                                        <span>{{ Str::limit($kos->lokasi, 40) }}</span>
                                                    </div>

                                                    <div class="kos-price">
                                                        <span class="price-amount">Rp {{ number_format($kos->harga, 0, ',', '.') }}</span>
                                                        <span class="price-period">/bulan</span>
                                                    </div>
                                                </div>

                                                <!-- Action Buttons -->
                                                <div class="kos-card-footer">
                                                    <div class="action-buttons">
                                                        <a href="{{ route('pemilik.kos.edit', $kos->id) }}" 
                                                           class="glass-btn glass-btn-outline flex-fill">
                                                            <i class="fas fa-edit me-2"></i>Edit
                                                        </a>
                                                        <button type="button" 
                                                                class="glass-btn glass-btn-danger"
                                                                onclick="deleteKos({{ $kos->id }}, '{{ $kos->nama_kos }}')"
                                                                title="Hapus Kos">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- List View -->
                            <div id="listView" class="kos-list" style="display: none;">
                                <div class="glass-table-wrapper">
                                    <div class="table-responsive">
                                        <table class="glass-table">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <i class="fas fa-image me-2"></i>Foto
                                                    </th>
                                                    <th>
                                                        <i class="fas fa-home me-2"></i>Nama Kos
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
                                                @foreach($kosList as $kos)
                                                    <tr class="table-row">
                                                        <td>
                                                            <div class="table-image">
                                                                @if($kos->mainPhoto)
                                                                    <img src="{{ asset($kos->mainPhoto->foto_path) }}" 
                                                                         alt="{{ $kos->nama_kos }}" 
                                                                         class="table-kos-image">
                                                                @else
                                                                    <div class="table-image-placeholder">
                                                                        <i class="fas fa-home"></i>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="kos-info">
                                                                <div class="kos-name">{{ $kos->nama_kos }}</div>
                                                                <div class="kos-meta">
                                                                    <small>
                                                                        <i class="fas fa-calendar-alt me-1"></i>
                                                                        Ditambahkan {{ $kos->created_at->diffForHumans() }}
                                                                    </small>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="location-info">
                                                                <i class="fas fa-map-pin location-icon"></i>
                                                                <span class="location-text">{{ Str::limit($kos->lokasi, 30) }}</span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="price-info">
                                                                <span class="price-amount">Rp {{ number_format($kos->harga, 0, ',', '.') }}</span>
                                                                <span class="price-period">/bulan</span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            @if($kos->status_ketersediaan == 'tersedia')
                                                                <div class="enhanced-badge enhanced-badge-xs status-available">
                                                                    <div class="badge-icon">
                                                                        <i class="fas fa-check"></i>
                                                                    </div>
                                                                    <div class="badge-content">
                                                                        <div class="badge-title">AVAILABLE</div>
                                                                        <div class="badge-subtitle">Tersedia</div>
                                                                    </div>
                                                                    <div class="badge-glow status-available-glow"></div>
                                                                </div>
                                                            @else
                                                                <div class="enhanced-badge enhanced-badge-xs status-unavailable">
                                                                    <div class="badge-icon">
                                                                        <i class="fas fa-times"></i>
                                                                    </div>
                                                                    <div class="badge-content">
                                                                        <div class="badge-title">UNAVAILABLE</div>
                                                                        <div class="badge-subtitle">Tidak Tersedia</div>
                                                                    </div>
                                                                    <div class="badge-glow status-unavailable-glow"></div>
                                                                </div>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($kos->is_verified)
                                                                <div class="enhanced-badge enhanced-badge-xs status-verified">
                                                                    <div class="badge-icon">
                                                                        <i class="fas fa-check-circle"></i>
                                                                    </div>
                                                                    <div class="badge-content">
                                                                        <div class="badge-title">VERIFIED</div>
                                                                        <div class="badge-subtitle">Sudah</div>
                                                                    </div>
                                                                    <div class="badge-glow status-verified-glow"></div>
                                                                </div>
                                                            @else
                                                                <div class="enhanced-badge enhanced-badge-xs status-pending">
                                                                    <div class="badge-icon">
                                                                        <i class="fas fa-clock"></i>
                                                                    </div>
                                                                    <div class="badge-content">
                                                                        <div class="badge-title">PENDING</div>
                                                                        <div class="badge-subtitle">Tunggu</div>
                                                                    </div>
                                                                    <div class="badge-glow status-pending-glow"></div>
                                                                </div>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <div class="action-buttons">
                                                                <a href="{{ route('pemilik.kos.edit', $kos->id) }}" 
                                                                   class="glass-btn-sm glass-btn-primary" 
                                                                   title="Edit Kos">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                                <button type="button" 
                                                                        class="glass-btn-sm glass-btn-danger" 
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
                            </div>

                            <!-- Pagination -->
                            <div class="pagination-wrapper">
                                <div class="glass-card pagination-card">
                                    <div class="d-flex justify-content-center">
                                        {{ $kosList->links() }}
                                    </div>
                                </div>
                            </div>
                        @else
                            <!-- Empty State -->
                            <div class="empty-state">
                                <div class="empty-icon">
                                    <i class="fas fa-home"></i>
                                </div>
                                <h4 class="empty-title">Belum Ada Kos yang Ditambahkan</h4>
                                <p class="empty-description">
                                    Mulai dengan menambahkan listing kos pertama Anda untuk menarik calon penyewa dan 
                                    mulai menerima inquiry dari ribuan pengguna Kos Finder.
                                </p>
                                <div class="empty-actions">
                                    <a href="{{ route('pemilik.kos.create') }}" class="glass-btn glass-btn-primary glass-btn-lg">
                                        <i class="fas fa-plus me-2"></i>Tambah Kos Pertama
                                    </a>
                                </div>
                                <div class="empty-features">
                                    <div class="feature-item">
                                        <i class="fas fa-check-circle feature-icon"></i>
                                        <span>Listing gratis selamanya</span>
                                    </div>
                                    <div class="feature-item">
                                        <i class="fas fa-users feature-icon"></i>
                                        <span>Jangkau ribuan calon penyewa</span>
                                    </div>
                                    <div class="feature-item">
                                        <i class="fas fa-shield-alt feature-icon"></i>
                                        <span>Verifikasi cepat dan aman</span>
                                    </div>
                                </div>
                            </div>
                        @endif
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
                    <p class="modal-text">Apakah Anda yakin ingin menghapus kos <strong id="kosName"></strong>?</p>
                    <p class="modal-warning">
                        <i class="fas fa-info-circle me-2"></i>
                        Tindakan ini tidak dapat dibatalkan dan akan menghapus semua data terkait termasuk foto dan inquiry yang masuk.
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
                --gradient-danger: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);
            }

            .glassmorphism-my-kos {
                background: var(--gradient-background);
                min-height: 100vh;
                position: relative;
                overflow-x: hidden;
            }

            .glassmorphism-my-kos::before {
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

            /* Status Badge Variants */
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

            .status-verified:hover {
                background: linear-gradient(135deg, rgba(34, 197, 94, 0.3) 0%, rgba(21, 128, 61, 0.25) 100%);
                border-color: rgba(34, 197, 94, 0.6);
                box-shadow: 0 15px 40px rgba(34, 197, 94, 0.3);
            }

            .status-pending {
                background: linear-gradient(135deg, rgba(245, 158, 11, 0.2) 0%, rgba(217, 119, 6, 0.15) 100%);
                border-color: rgba(245, 158, 11, 0.4);
                color: #ffffff;
            }

            .status-pending .badge-icon {
                background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
                color: #ffffff;
                box-shadow: 0 4px 15px rgba(245, 158, 11, 0.4);
            }

            .status-pending-glow {
                background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            }

            .status-pending:hover {
                background: linear-gradient(135deg, rgba(245, 158, 11, 0.3) 0%, rgba(217, 119, 6, 0.25) 100%);
                border-color: rgba(245, 158, 11, 0.6);
                box-shadow: 0 15px 40px rgba(245, 158, 11, 0.3);
            }

            .status-available {
                background: linear-gradient(135deg, rgba(59, 130, 246, 0.2) 0%, rgba(37, 99, 235, 0.15) 100%);
                border-color: rgba(59, 130, 246, 0.4);
                color: #ffffff;
            }

            .status-available .badge-icon {
                background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
                color: #ffffff;
                box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4);
            }

            .status-available-glow {
                background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            }

            .status-available:hover {
                background: linear-gradient(135deg, rgba(59, 130, 246, 0.3) 0%, rgba(37, 99, 235, 0.25) 100%);
                border-color: rgba(59, 130, 246, 0.6);
                box-shadow: 0 15px 40px rgba(59, 130, 246, 0.3);
            }

            .status-unavailable {
                background: linear-gradient(135deg, rgba(239, 68, 68, 0.2) 0%, rgba(220, 38, 38, 0.15) 100%);
                border-color: rgba(239, 68, 68, 0.4);
                color: #ffffff;
            }

            .status-unavailable .badge-icon {
                background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
                color: #ffffff;
                box-shadow: 0 4px 15px rgba(239, 68, 68, 0.4);
            }

            .status-unavailable-glow {
                background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            }

            .status-unavailable:hover {
                background: linear-gradient(135deg, rgba(239, 68, 68, 0.3) 0%, rgba(220, 38, 38, 0.25) 100%);
                border-color: rgba(239, 68, 68, 0.6);
                box-shadow: 0 15px 40px rgba(239, 68, 68, 0.3);
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

            /* Filter & Stats Bar */
            .filter-stats-bar {
                padding: 1.5rem 2rem;
            }

            .stats-summary {
                display: flex;
                align-items: center;
                gap: 1.5rem;
            }

            .stat-item {
                display: flex;
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .stat-value {
                font-family: 'Poppins', sans-serif;
                font-size: 1.5rem;
                font-weight: 800;
                color: var(--white);
                line-height: 1;
            }

            .stat-label {
                font-size: 0.8rem;
                color: rgba(255, 255, 255, 0.7);
                text-transform: uppercase;
                letter-spacing: 0.5px;
                margin-top: 0.25rem;
            }

            .stat-divider {
                width: 1px;
                height: 30px;
                background: linear-gradient(to bottom, transparent, rgba(255, 255, 255, 0.3), transparent);
            }

            .view-options {
                display: flex;
                align-items: center;
                gap: 1rem;
            }

            .view-toggle {
                display: flex;
                background: var(--glass-bg);
                border: 1px solid var(--glass-border);
                border-radius: 10px;
                overflow: hidden;
            }

            .glass-btn-sm {
                width: 40px;
                height: 40px;
                border: none;
                background: transparent;
                color: rgba(255, 255, 255, 0.7);
                display: flex;
                align-items: center;
                justify-content: center;
                transition: all 0.3s ease;
                cursor: pointer;
            }

            .glass-btn-sm:hover {
                background: var(--glass-bg-light);
                color: var(--white);
            }

            .glass-btn-sm.active {
                background: var(--gradient-primary);
                color: var(--white);
            }

            /* Kos Content */
            .kos-content {
                padding: 2.5rem;
            }

            /* Grid View */
            .kos-grid {
                margin-bottom: 2rem;
            }

            .kos-card {
                padding: 0;
                overflow: hidden;
                transition: all 0.4s ease;
                height: 100%;
                display: flex;
                flex-direction: column;
            }

            .kos-card:hover {
                transform: translateY(-8px) scale(1.02);
                box-shadow: var(--glass-shadow-hover);
            }

            .kos-image-container {
                position: relative;
                height: 220px;
                overflow: hidden;
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
                font-size: 3rem;
                color: var(--white);
            }

            .image-overlay {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: linear-gradient(to bottom, rgba(0,0,0,0.1) 0%, transparent 50%, rgba(0,0,0,0.7) 100%);
                display: flex;
                flex-direction: column;
                justify-content: flex-start;
                padding: 1rem;
            }

            .status-badges {
                display: flex;
                flex-direction: column;
                gap: 0.5rem;
                align-items: flex-start;
            }

            .kos-card-content {
                padding: 1.5rem;
                flex-grow: 1;
                display: flex;
                flex-direction: column;
            }

            .kos-header {
                margin-bottom: 1rem;
            }

            .kos-title {
                font-family: 'Poppins', sans-serif;
                font-size: 1.2rem;
                font-weight: 700;
                color: var(--white);
                margin-bottom: 0.5rem;
                line-height: 1.3;
            }

            .kos-meta {
                color: rgba(255, 255, 255, 0.6);
                font-size: 0.8rem;
            }

            .kos-location {
                display: flex;
                align-items: center;
                color: rgba(255, 255, 255, 0.8);
                font-size: 0.9rem;
                margin-bottom: 1rem;
            }

            .kos-location i {
                color: rgba(255, 255, 255, 0.6);
                width: 16px;
            }

            .kos-price {
                margin-top: auto;
                margin-bottom: 1rem;
            }

            .price-amount {
                font-family: 'Poppins', sans-serif;
                font-size: 1.3rem;
                font-weight: 800;
                color: var(--white);
                display: block;
                line-height: 1;
            }

            .price-period {
                color: rgba(255, 255, 255, 0.7);
                font-size: 0.85rem;
            }

            .kos-card-footer {
                padding: 0 1.5rem 1.5rem;
                margin-top: auto;
            }

            .action-buttons {
                display: flex;
                gap: 0.75rem;
                align-items: center;
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
                width: 44px;
                height: 44px;
                padding: 0;
                border-radius: 12px;
            }

            .glass-btn-danger:hover {
                box-shadow: 0 8px 30px rgba(239, 68, 68, 0.6);
                color: var(--white);
                transform: translateY(-2px) scale(1.05);
            }

            .glass-btn-lg {
                padding: 1rem 2rem;
                font-size: 1.1rem;
            }

            /* List View */
            .glass-table-wrapper {
                background: var(--glass-bg);
                border: 1px solid var(--glass-border);
                border-radius: 15px;
                overflow: hidden;
                margin-bottom: 2rem;
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

            .table-image {
                width: 60px;
                height: 60px;
                border-radius: 12px;
                overflow: hidden;
            }

            .table-kos-image {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .table-image-placeholder {
                width: 100%;
                height: 100%;
                background: var(--gradient-primary);
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.5rem;
                color: var(--white);
            }

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

            /* Action Button Sizing */
            .glass-btn-sm.glass-btn-primary,
            .glass-btn-sm.glass-btn-danger {
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

            /* Pagination */
            .pagination-wrapper {
                margin-top: 2rem;
            }

            .pagination-card {
                padding: 1.5rem;
                text-align: center;
            }

            .pagination .page-item .page-link {
                background: var(--glass-bg);
                backdrop-filter: blur(15px);
                border: 1px solid var(--glass-border);
                color: var(--white);
                margin: 0 0.25rem;
                border-radius: 10px;
                padding: 0.5rem 0.75rem;
                transition: all 0.3s ease;
            }

            .pagination .page-item.active .page-link {
                background: var(--gradient-primary);
                border-color: transparent;
                color: var(--white);
            }

            .pagination .page-item .page-link:hover {
                background: var(--glass-bg-light);
                border-color: rgba(255, 255, 255, 0.5);
                color: var(--white);
                transform: translateY(-2px);
            }

            .pagination .page-item.disabled .page-link {
                background: var(--glass-bg-dark);
                border-color: rgba(255, 255, 255, 0.1);
                color: rgba(255, 255, 255, 0.4);
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
                font-size: 1.75rem;
                font-weight: 700;
                color: var(--white);
                margin-bottom: 1rem;
            }

            .empty-description {
                color: rgba(255, 255, 255, 0.8);
                font-size: 1rem;
                line-height: 1.6;
                max-width: 500px;
                margin: 0 auto 2rem;
            }

            .empty-actions {
                margin-bottom: 3rem;
            }

            .empty-features {
                display: flex;
                justify-content: center;
                gap: 2rem;
                flex-wrap: wrap;
            }

            .feature-item {
                display: flex;
                align-items: center;
                gap: 0.5rem;
                color: rgba(255, 255, 255, 0.8);
                font-size: 0.9rem;
            }

            .feature-icon {
                color: #34d399;
                font-size: 0.9rem;
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

                .filter-stats-bar {
                    padding: 1.5rem;
                }

                .stats-summary {
                    flex-wrap: wrap;
                    justify-content: center;
                    gap: 1rem;
                }

                .view-options {
                    margin-top: 1rem;
                }

                .kos-content {
                    padding: 2rem;
                }

                .glass-table thead th,
                .glass-table tbody td {
                    padding: 1rem 0.75rem;
                    font-size: 0.85rem;
                }

                .action-buttons {
                    justify-content: center;
                }

                .empty-features {
                    flex-direction: column;
                    align-items: center;
                    gap: 1rem;
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

                .kos-content {
                    padding: 1.5rem;
                }

                .kos-card-content {
                    padding: 1rem;
                }

                .empty-state {
                    padding: 3rem 1rem;
                }

                .stats-summary {
                    gap: 0.75rem;
                }

                .stat-item {
                    min-width: 80px;
                }

                .table-responsive {
                    font-size: 0.8rem;
                }
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
            .glass-btn:focus,
            .glass-btn-sm:focus,
            .enhanced-badge:focus {
                outline: 2px solid rgba(255, 255, 255, 0.5);
                outline-offset: 2px;
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            // View Toggle Functionality
            document.querySelectorAll('.view-toggle button').forEach(button => {
                button.addEventListener('click', function() {
                    const view = this.dataset.view;

                    // Update active button
                    document.querySelectorAll('.view-toggle button').forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');

                    // Show/hide views
                    if (view === 'grid') {
                        document.getElementById('gridView').style.display = 'block';
                        document.getElementById('listView').style.display = 'none';
                    } else {
                        document.getElementById('gridView').style.display = 'none';
                        document.getElementById('listView').style.display = 'block';
                    }

                    // Save preference
                    try {
                        localStorage.setItem('kosViewPreference', view);
                    } catch (e) {
                        console.log('LocalStorage not available');
                    }
                });
            });

            // Load saved view preference
            try {
                const savedView = localStorage.getItem('kosViewPreference') || 'grid';
                if (savedView === 'list') {
                    document.querySelector('[data-view="list"]').click();
                }
            } catch (e) {
                console.log('LocalStorage not available');
            }

            // Delete Kos Modal
            function deleteKos(kosId, kosName) {
                document.getElementById('kosName').textContent = kosName;
                document.getElementById('deleteForm').action = `/pemilik/kos/${kosId}`;

                const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
                modal.show();
            }

            // Add loading state to form submission
            document.getElementById('deleteForm').addEventListener('submit', function() {
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

            // Add ripple effect to buttons and badges
            document.querySelectorAll('.glass-btn, .glass-btn-sm, .enhanced-badge').forEach(element => {
                element.addEventListener('click', function(e) {
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

            // Enhanced card interactions
            document.querySelectorAll('.kos-card').forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-8px) scale(1.02)';
                });

                card.addEventListener('mouseleave', function() {
                    this.style.transform = '';
                });
            });

            // Enhanced table row interactions
            document.querySelectorAll('.table-row').forEach(row => {
                row.addEventListener('mouseenter', function() {
                    this.style.boxShadow = '0 4px 20px rgba(255, 255, 255, 0.1)';
                });

                row.addEventListener('mouseleave', function() {
                    this.style.boxShadow = '';
                });
            });

            // Enhanced badge interactions
            document.querySelectorAll('.enhanced-badge').forEach(badge => {
                badge.addEventListener('mouseenter', function() {
                    this.style.boxShadow = '0 20px 50px rgba(0, 0, 0, 0.3)';
                });

                badge.addEventListener('mouseleave', function() {
                    this.style.boxShadow = '';
                });
            });

            // Animate statistics on page load
            function animateStats() {
                document.querySelectorAll('.stat-value').forEach(element => {
                    const target = parseInt(element.textContent);
                    let current = 0;
                    const increment = target / 20;
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
            window.addEventListener('load', function() {
                setTimeout(animateStats, 500);
            });

            // Auto-refresh data every 5 minutes
            setInterval(() => {
                console.log('Auto-refreshing kos data...');
            }, 300000);

            // Lazy load images
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.classList.add('loaded');
                        observer.unobserve(img);
                    }
                });
            });

            document.querySelectorAll('.kos-image, .table-kos-image').forEach(img => {
                imageObserver.observe(img);
            });

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

            // Search functionality (if needed)
            function filterKos(searchTerm) {
                const cards = document.querySelectorAll('.kos-card');
                const rows = document.querySelectorAll('.table-row');

                cards.forEach(card => {
                    const title = card.querySelector('.kos-title').textContent.toLowerCase();
                    const location = card.querySelector('.kos-location span').textContent.toLowerCase();

                    if (title.includes(searchTerm.toLowerCase()) || location.includes(searchTerm.toLowerCase())) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });

                rows.forEach(row => {
                    const title = row.querySelector('.kos-name').textContent.toLowerCase();
                    const location = row.querySelector('.location-text').textContent.toLowerCase();

                    if (title.includes(searchTerm.toLowerCase()) || location.includes(searchTerm.toLowerCase())) {
                        row.style.display = 'table-row';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }

            // Performance optimization: Intersection Observer for badges
            const badgeObserverOptions = {
                root: null,
                rootMargin: '50px',
                threshold: 0.1
            };

            const badgeObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('badge-visible');
                    }
                });
            }, badgeObserverOptions);

            // Observe all enhanced badges
            document.querySelectorAll('.enhanced-badge').forEach(badge => {
                badgeObserver.observe(badge);
            });

            // Add visibility animation for badges
            const badgeVisibilityStyles = `
                .enhanced-badge {
                    opacity: 0;
                    transform: translateY(20px) scale(0.8);
                    transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
                }

                .enhanced-badge.badge-visible {
                    opacity: 1;
                    transform: translateY(0) scale(1);
                }

                .enhanced-badge:nth-child(1) {
                    transition-delay: 0.1s;
                }

                .enhanced-badge:nth-child(2) {
                    transition-delay: 0.2s;
                }
            `;

            const badgeVisibilityStyleSheet = document.createElement('style');
            badgeVisibilityStyleSheet.textContent = badgeVisibilityStyles;
            document.head.appendChild(badgeVisibilityStyleSheet);

            // Add click sound effect simulation (visual feedback)
            function addClickFeedback(element) {
                element.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    element.style.transform = '';
                }, 150);
            }

            // Apply click feedback to all interactive elements
            document.querySelectorAll('.enhanced-badge, .glass-btn, .glass-btn-sm').forEach(element => {
                element.addEventListener('click', function() {
                    addClickFeedback(this);
                });
            });

            // Auto-hide success/error messages after 5 seconds
            document.querySelectorAll('.glass-alert').forEach(alert => {
                setTimeout(() => {
                    if (alert.parentElement) {
                        alert.style.opacity = '0';
                        alert.style.transform = 'translateY(-20px)';
                        setTimeout(() => {
                            alert.style.display = 'none';
                        }, 300);
                    }
                }, 5000);
            });

            // Add smooth scrolling to anchor links
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

            // Add keyboard navigation support
            document.addEventListener('keydown', function(e) {
                if (e.ctrlKey || e.metaKey) {
                    switch(e.key) {
                        case '1':
                            e.preventDefault();
                            document.querySelector('[data-view="grid"]').click();
                            break;
                        case '2':
                            e.preventDefault();
                            document.querySelector('[data-view="list"]').click();
                            break;
                        case 'n':
                            e.preventDefault();
                            window.location.href = "{{ route('pemilik.kos.create') }}";
                            break;
                    }
                }
            });

            // Add tooltip functionality for badges
            document.querySelectorAll('.enhanced-badge').forEach(badge => {
                badge.addEventListener('mouseenter', function() {
                    const tooltip = document.createElement('div');
                    tooltip.className = 'badge-tooltip';
                    
                    const badgeTitle = this.querySelector('.badge-title').textContent;
                    const badgeSubtitle = this.querySelector('.badge-subtitle').textContent;
                    
                    tooltip.innerHTML = `
                        <div class="tooltip-content">
                            <strong>${badgeTitle}</strong><br>
                            <small>${badgeSubtitle}</small>
                        </div>
                    `;
                    
                    tooltip.style.cssText = `
                        position: absolute;
                        background: rgba(0, 0, 0, 0.9);
                        color: white;
                        padding: 0.5rem;
                        border-radius: 8px;
                        font-size: 0.8rem;
                        z-index: 1000;
                        pointer-events: none;
                        opacity: 0;
                        transform: translateY(10px);
                        transition: all 0.3s ease;
                        white-space: nowrap;
                    `;
                    
                    document.body.appendChild(tooltip);
                    
                    const rect = this.getBoundingClientRect();
                    tooltip.style.left = rect.left + (rect.width / 2) - (tooltip.offsetWidth / 2) + 'px';
                    tooltip.style.top = rect.bottom + 10 + 'px';
                    
                    setTimeout(() => {
                        tooltip.style.opacity = '1';
                        tooltip.style.transform = 'translateY(0)';
                    }, 10);
                    
                    this.addEventListener('mouseleave', function() {
                        tooltip.style.opacity = '0';
                        tooltip.style.transform = 'translateY(10px)';
                        setTimeout(() => {
                            if (tooltip.parentNode) {
                                tooltip.parentNode.removeChild(tooltip);
                            }
                        }, 300);
                    }, { once: true });
                });
            });

            // Add loading skeleton for images
            document.querySelectorAll('.kos-image, .table-kos-image').forEach(img => {
                const skeleton = document.createElement('div');
                skeleton.className = 'image-skeleton';
                skeleton.style.cssText = `
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
                    background-size: 200% 100%;
                    animation: loading 1.5s infinite;
                `;
                
                img.parentElement.style.position = 'relative';
                img.parentElement.appendChild(skeleton);
                
                img.addEventListener('load', function() {
                    skeleton.style.opacity = '0';
                    setTimeout(() => {
                        if (skeleton.parentNode) {
                            skeleton.parentNode.removeChild(skeleton);
                        }
                    }, 300);
                });
            });

            // Add loading animation CSS
            const loadingStyles = `
                @keyframes loading {
                    0% { background-position: -200% 0; }
                    100% { background-position: 200% 0; }
                }
            `;

            const loadingStyleSheet = document.createElement('style');
            loadingStyleSheet.textContent = loadingStyles;
            document.head.appendChild(loadingStyleSheet);

            // Add notification system for better UX feedback
            function showNotification(message, type = 'info') {
                const notification = document.createElement('div');
                notification.className = `notification notification-${type}`;
                notification.innerHTML = `
                    <div class="notification-content">
                        <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'info-circle'}"></i>
                        <span>${message}</span>
                    </div>
                `;
                
                notification.style.cssText = `
                    position: fixed;
                    top: 20px;
                    right: 20px;
                    background: var(--glass-bg);
                    backdrop-filter: blur(25px);
                    border: 1px solid var(--glass-border);
                    border-radius: 12px;
                    padding: 1rem 1.5rem;
                    color: var(--white);
                    z-index: 9999;
                    transform: translateX(400px);
                    transition: transform 0.3s ease;
                    box-shadow: var(--glass-shadow);
                    max-width: 300px;
                `;
                
                document.body.appendChild(notification);
                
                setTimeout(() => {
                    notification.style.transform = 'translateX(0)';
                }, 100);
                
                setTimeout(() => {
                    notification.style.transform = 'translateX(400px)';
                    setTimeout(() => {
                        if (notification.parentNode) {
                            notification.parentNode.removeChild(notification);
                        }
                    }, 300);
                }, 3000);
            }

            // Example usage of notification system
            // showNotification('Kos berhasil dihapus!', 'success');

            console.log('Enhanced My Kos Interface with Enhanced Badges Loaded Successfully!');
        </script>
    @endpush
@endsection