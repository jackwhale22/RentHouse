@extends('layouts.app')

@section('title', 'Kontak Saya - Kos Finder')

@section('content')
    <div class="container-fluid glassmorphism-dashboard">
        <div class="container py-5">
            <!-- Page Header -->
            <div class="row mb-5">
                <div class="col-12">
                    <div class="glass-card page-header">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <div class="header-content">
                                <div class="header-icon">
                                    <i class="fas fa-address-book"></i>
                                </div>
                                <div class="header-text">
                                    <h1 class="page-title">Kontak Saya</h1>
                                    <p class="page-subtitle">Kelola riwayat kontak dengan pemilik kos</p>
                                </div>
                            </div>
                            <div class="header-actions">
                                <a href="{{ route('search') }}" class="glass-btn glass-btn-primary">
                                    <i class="fas fa-search me-2"></i>Cari Kos Lagi
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Statistics -->
            @if($transaksis->count() > 0)
                <div class="row g-4 mb-5">
                    <div class="col-md-4">
                        <div class="glass-card stat-card warning-stat">
                            <div class="stat-icon warning">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="stat-content">
                                <div class="stat-header">
                                    <h6 class="stat-label">Menunggu Respon</h6>
                                    <div class="stat-trend neutral">
                                        <i class="fas fa-hourglass-half"></i>
                                    </div>
                                </div>
                                <h2 class="stat-number">
                                    {{ auth()->user()->transaksis()->where('status_transaksi', 'pending')->count() }}</h2>
                                <p class="stat-description">Kontak pending</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="glass-card stat-card success-stat">
                            <div class="stat-icon success">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="stat-content">
                                <div class="stat-header">
                                    <h6 class="stat-label">Berhasil</h6>
                                    <div class="stat-trend up">
                                        <i class="fas fa-arrow-up"></i>
                                    </div>
                                </div>
                                <h2 class="stat-number">
                                    {{ auth()->user()->transaksis()->where('status_transaksi', 'selesai')->count() }}</h2>
                                <p class="stat-description">Kontak selesai</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="glass-card stat-card danger-stat">
                            <div class="stat-icon danger">
                                <i class="fas fa-times-circle"></i>
                            </div>
                            <div class="stat-content">
                                <div class="stat-header">
                                    <h6 class="stat-label">Dibatalkan</h6>
                                    <div class="stat-trend neutral">
                                        <i class="fas fa-minus"></i>
                                    </div>
                                </div>
                                <h2 class="stat-number">
                                    {{ auth()->user()->transaksis()->where('status_transaksi', 'dibatalkan')->count() }}</h2>
                                <p class="stat-description">Kontak batal</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Contacts Table -->
            <div class="row">
                <div class="col-12">
                    <div class="glass-card table-card">
                        <div class="card-header-custom">
                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                <div class="header-info">
                                    <h5 class="table-title">
                                        <i class="fas fa-list me-2"></i>Riwayat Kontak
                                    </h5>
                                    <p class="table-subtitle">Daftar semua kontak dengan pemilik kos</p>
                                </div>
                                @if($transaksis->count() > 0)
                                    <div class="header-actions">
                                        <div class="glass-btn glass-btn-outline contact-count-badge">
                                            <i class="fas fa-phone me-2"></i>{{ $transaksis->total() }} Total Kontak
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="card-body-custom">
                            @if($transaksis->count() > 0)
                                <div class="contacts-list">
                                    @foreach($transaksis as $transaksi)
                                        <div class="contact-card glass-contact-item">
                                            <div class="contact-main">
                                                <!-- Kos Image & Info -->
                                                <div class="kos-preview">
                                                    <div class="kos-image-container">
                                                        @if($transaksi->kos->foto)
                                                            <img src="{{ asset($transaksi->kos->foto) }}"
                                                                alt="{{ $transaksi->kos->nama_kos }}" class="kos-thumbnail">
                                                        @else
                                                            <div class="kos-thumbnail-placeholder">
                                                                <i class="fas fa-home"></i>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="kos-info">
                                                        <h6 class="kos-name">{{ $transaksi->kos->nama_kos }}</h6>
                                                        <div class="kos-location">
                                                            <i class="fas fa-map-marker-alt me-1"></i>
                                                            {{ Str::limit($transaksi->kos->lokasi, 40) }}
                                                        </div>
                                                        <div class="kos-price">
                                                            <strong>Rp
                                                                {{ number_format($transaksi->kos->harga, 0, ',', '.') }}</strong>
                                                            <small>/bulan</small>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Owner Info -->
                                                <div class="owner-preview">
                                                    <div class="owner-avatar">
                                                        <i class="fas fa-user-circle"></i>
                                                    </div>
                                                    <div class="owner-details">
                                                        <h6 class="owner-name">{{ $transaksi->kos->pemilik->name }}</h6>
                                                        <div class="owner-role">Pemilik Kos</div>
                                                        <div class="contact-details">
                                                            <div class="contact-item">
                                                                <i class="fas fa-envelope contact-icon"></i>
                                                                <span
                                                                    class="contact-text">{{ Str::limit($transaksi->kos->pemilik->email, 25) }}</span>
                                                            </div>
                                                            @if($transaksi->kos->pemilik->phone)
                                                                <div class="contact-item">
                                                                    <i class="fas fa-phone contact-icon"></i>
                                                                    <span
                                                                        class="contact-text">{{ $transaksi->kos->pemilik->phone }}</span>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Status & Actions -->
                                                <div class="contact-status-actions">
                                                    <div class="status-section">
                                                        @if($transaksi->status_transaksi == 'pending')
                                                            <span class="glass-badge status-pending">
                                                                <i class="fas fa-clock me-1"></i>Menunggu
                                                            </span>
                                                        @elseif($transaksi->status_transaksi == 'selesai')
                                                            <span class="glass-badge status-completed">
                                                                <i class="fas fa-check me-1"></i>Selesai
                                                            </span>
                                                        @else
                                                            <span class="glass-badge status-cancelled">
                                                                <i class="fas fa-times me-1"></i>Dibatalkan
                                                            </span>
                                                        @endif

                                                        <div class="contact-date">
                                                            <div class="date-primary">{{ $transaksi->created_at->format('d M Y') }}
                                                            </div>
                                                            <div class="date-secondary">
                                                                {{ $transaksi->created_at->diffForHumans() }}</div>
                                                        </div>
                                                    </div>

                                                    <div class="action-section">
                                                        <a href="{{ route('kos.show', $transaksi->kos->id) }}"
                                                            class="glass-btn-sm glass-btn-primary" title="Lihat Detail Kos">
                                                            <i class="fas fa-eye"></i>
                                                        </a>

                                                        @if($transaksi->status_transaksi == 'pending')
                                                            <button type="button" class="glass-btn-sm glass-btn-danger"
                                                                onclick="cancelContact({{ $transaksi->id }}, '{{ $transaksi->kos->nama_kos }}')"
                                                                title="Batalkan Kontak">
                                                                <i class="fas fa-times"></i>
                                                            </button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            @if($transaksi->catatan)
                                                <div class="contact-message">
                                                    <div class="message-header">
                                                        <i class="fas fa-comment-dots me-2"></i>
                                                        <strong>Pesan Anda:</strong>
                                                    </div>
                                                    <div class="message-content">
                                                        {{ $transaksi->catatan }}
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Pagination -->
                                @if($transaksis->hasPages())
                                    <div class="pagination-wrapper">
                                        <div class="glass-pagination">
                                            {{ $transaksis->links('pagination::bootstrap-4') }}
                                        </div>
                                    </div>
                                @endif
                            @else
                                <!-- Empty State -->
                                <div class="empty-state">
                                    <div class="empty-icon">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <h5 class="empty-title">Belum Ada Kontak</h5>
                                    <p class="empty-description">
                                        Anda belum menghubungi pemilik kos manapun. Mulai dengan mencari kos yang menarik minat
                                        Anda.
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
        </div>
    </div>

    <!-- Cancel Contact Modal -->
    <div class="modal fade" id="cancelContactModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content glass-modal">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-exclamation-triangle text-warning me-2"></i>
                        Konfirmasi Batalkan Kontak
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="modal-text">Apakah Anda yakin ingin membatalkan kontak dengan kos <strong
                            id="cancelKosName"></strong>?</p>
                    <p class="modal-warning">
                        <i class="fas fa-info-circle me-2"></i>
                        Tindakan ini akan mengubah status kontak menjadi dibatalkan dan tidak dapat dikembalikan.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="glass-btn glass-btn-outline" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Batal
                    </button>
                    <form id="cancelContactForm" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="glass-btn glass-btn-danger">
                            <i class="fas fa-times me-2"></i>Ya, Batalkan
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

            /* Page Header */
            .page-header {
                padding: 2.5rem;
                margin-bottom: 2rem;
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

            .success-stat:hover {
                background: rgba(17, 153, 142, 0.1);
            }

            .warning-stat:hover {
                background: rgba(217, 119, 6, 0.1);
            }

            .danger-stat:hover {
                background: rgba(239, 68, 68, 0.1);
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

            .stat-icon.success {
                background: var(--gradient-success);
                box-shadow: 0 8px 25px rgba(17, 153, 142, 0.3);
            }

            .stat-icon.warning {
                background: var(--gradient-accent);
                box-shadow: 0 8px 25px rgba(217, 119, 6, 0.3);
            }

            .stat-icon.danger {
                background: var(--gradient-danger);
                box-shadow: 0 8px 25px rgba(239, 68, 68, 0.3);
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

            .contact-count-badge {
                background: var(--glass-bg-light);
                border: 1px solid rgba(255, 255, 255, 0.3);
                padding: 0.75rem 1.25rem;
                border-radius: 50px;
                font-size: 0.9rem;
                font-weight: 600;
                color: var(--white);
            }

            /* Contacts List */
            .contacts-list {
                display: flex;
                flex-direction: column;
                gap: 1.5rem;
            }

            .glass-contact-item {
                background: var(--glass-bg);
                backdrop-filter: blur(15px);
                border: 1px solid var(--glass-border);
                border-radius: 20px;
                padding: 2rem;
                transition: all 0.3s ease;
                position: relative;
                overflow: hidden;
            }

            .glass-contact-item:hover {
                background: var(--glass-bg-light);
                transform: translateY(-5px);
                box-shadow: var(--glass-shadow-hover);
            }

            .contact-main {
                display: grid;
                grid-template-columns: 1fr auto auto;
                gap: 2rem;
                align-items: center;
            }

            /* Kos Preview */
            .kos-preview {
                display: flex;
                align-items: center;
                gap: 1rem;
            }

            .kos-image-container {
                flex-shrink: 0;
            }

            .kos-thumbnail {
                width: 80px;
                height: 80px;
                border-radius: 15px;
                object-fit: cover;
                border: 2px solid var(--glass-border);
            }

            .kos-thumbnail-placeholder {
                width: 80px;
                height: 80px;
                background: var(--gradient-primary);
                border-radius: 15px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.5rem;
                color: var(--white);
            }

            .kos-name {
                font-family: 'Poppins', sans-serif;
                font-size: 1.1rem;
                font-weight: 700;
                color: var(--white);
                margin-bottom: 0.5rem;
            }

            .kos-location {
                color: rgba(255, 255, 255, 0.8);
                font-size: 0.9rem;
                margin-bottom: 0.5rem;
                display: flex;
                align-items: center;
            }

            .kos-price {
                color: var(--white);
                font-size: 1rem;
            }

            .kos-price strong {
                color: #60a5fa;
                font-weight: 700;
            }

            .kos-price small {
                color: rgba(255, 255, 255, 0.7);
                margin-left: 0.25rem;
            }

            /* Owner Preview */
            .owner-preview {
                display: flex;
                align-items: center;
                gap: 1rem;
                min-width: 250px;
            }

            .owner-avatar {
                width: 50px;
                height: 50px;
                background: var(--gradient-secondary);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.5rem;
                color: var(--white);
                flex-shrink: 0;
            }

            .owner-name {
                font-family: 'Poppins', sans-serif;
                font-size: 1rem;
                font-weight: 700;
                color: var(--white);
                margin-bottom: 0.25rem;
            }

            .owner-role {
                color: rgba(255, 255, 255, 0.7);
                font-size: 0.8rem;
                margin-bottom: 0.75rem;
            }

            .contact-details .contact-item {
                display: flex;
                align-items: center;
                gap: 0.5rem;
                margin-bottom: 0.25rem;
            }

            .contact-icon {
                color: rgba(255, 255, 255, 0.6);
                font-size: 0.8rem;
                width: 12px;
                flex-shrink: 0;
            }

            .contact-text {
                color: rgba(255, 255, 255, 0.8);
                font-size: 0.8rem;
            }

            /* Status & Actions */
            .contact-status-actions {
                display: flex;
                flex-direction: column;
                align-items: flex-end;
                gap: 1rem;
                min-width: 150px;
            }

            .status-section {
                text-align: right;
            }

            .glass-badge {
                display: inline-flex;
                align-items: center;
                padding: 0.5rem 1rem;
                border-radius: 25px;
                font-size: 0.85rem;
                font-weight: 700;
                border: 2px solid;
                margin-bottom: 0.75rem;
                text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                backdrop-filter: blur(10px);
            }

            .glass-badge.status-pending {
                background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
                color: #ffffff;
                border-color: #fbbf24;
                box-shadow: 0 4px 15px rgba(251, 191, 36, 0.4);
            }

            .glass-badge.status-completed {
                background: linear-gradient(135deg, #10b981 0%, #059669 100%);
                color: #ffffff;
                border-color: #10b981;
                box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4);
            }

            .glass-badge.status-cancelled {
                background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
                color: #ffffff;
                border-color: #ef4444;
                box-shadow: 0 4px 15px rgba(239, 68, 68, 0.4);
            }

            .contact-date .date-primary {
                color: var(--white);
                font-weight: 600;
                font-size: 0.9rem;
                margin-bottom: 0.25rem;
            }

            .contact-date .date-secondary {
                color: rgba(255, 255, 255, 0.6);
                font-size: 0.8rem;
            }

            .action-section {
                display: flex;
                gap: 0.5rem;
            }

            .glass-btn-sm {
                width: 40px;
                height: 40px;
                border-radius: 12px;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: all 0.3s ease;
                font-size: 1rem;
                text-decoration: none;
                border: 1px solid var(--glass-border);
                background: var(--glass-bg);
                backdrop-filter: blur(15px);
                cursor: pointer;
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

            /* Contact Message */
            .contact-message {
                margin-top: 1.5rem;
                padding-top: 1.5rem;
                border-top: 1px solid rgba(255, 255, 255, 0.1);
            }

            .message-header {
                color: rgba(255, 255, 255, 0.8);
                font-size: 0.9rem;
                margin-bottom: 0.75rem;
                display: flex;
                align-items: center;
            }

            .message-content {
                background: var(--glass-bg-dark);
                border: 1px solid var(--glass-border);
                border-radius: 12px;
                padding: 1rem;
                color: rgba(255, 255, 255, 0.9);
                font-size: 0.9rem;
                line-height: 1.5;
                font-style: italic;
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

            /* Pagination */
            .pagination-wrapper {
                padding: 2rem 0 1rem;
                display: flex;
                justify-content: center;
            }

            .glass-pagination .pagination {
                background: var(--glass-bg);
                backdrop-filter: blur(15px);
                border: 1px solid var(--glass-border);
                border-radius: 15px;
                padding: 0.5rem;
            }

            .glass-pagination .page-link {
                background: transparent;
                border: none;
                color: rgba(255, 255, 255, 0.8);
                padding: 0.5rem 0.75rem;
                border-radius: 8px;
                margin: 0 0.25rem;
                transition: all 0.3s ease;
            }

            .glass-pagination .page-link:hover {
                background: var(--glass-bg-light);
                color: var(--white);
                transform: translateY(-1px);
            }

            .glass-pagination .page-item.active .page-link {
                background: var(--gradient-primary);
                color: var(--white);
                box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
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

                .contact-main {
                    grid-template-columns: 1fr;
                    gap: 1.5rem;
                }

                .contact-status-actions {
                    flex-direction: row;
                    justify-content: space-between;
                    align-items: center;
                    min-width: auto;
                }

                .status-section {
                    text-align: left;
                }

                .owner-preview {
                    min-width: auto;
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
                .page-title {
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

                .glass-contact-item {
                    padding: 1.5rem;
                }

                .kos-preview {
                    flex-direction: column;
                    text-align: center;
                }

                .kos-thumbnail,
                .kos-thumbnail-placeholder {
                    width: 60px;
                    height: 60px;
                }

                .owner-preview {
                    flex-direction: column;
                    text-align: center;
                }

                .action-section {
                    justify-content: center;
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
            // Cancel contact modal
            function cancelContact(contactId, kosName) {
                document.getElementById('cancelKosName').textContent = kosName;
                document.getElementById('cancelContactForm').action = `/transaksi/${contactId}/cancel`;

                const modal = new bootstrap.Modal(document.getElementById('cancelContactModal'));
                modal.show();
            }

            // Add loading state to form submission
            document.getElementById('cancelContactForm').addEventListener('submit', function () {
                const submitBtn = this.querySelector('button[type="submit"]');
                const originalHtml = submitBtn.innerHTML;

                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Membatalkan...';
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

            // Enhanced contact card interactions
            document.querySelectorAll('.glass-contact-item').forEach(card => {
                card.addEventListener('mouseenter', function () {
                    this.style.boxShadow = '0 12px 40px rgba(255, 255, 255, 0.15)';
                });

                card.addEventListener('mouseleave', function () {
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