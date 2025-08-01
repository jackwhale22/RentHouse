@extends('layouts.app')

@section('title', 'Pesan Saya - Kos Finder')

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
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="header-text">
                                    <h1 class="page-title">Pesan Saya</h1>
                                    <p class="page-subtitle">Kelola komunikasi dengan pemilik kos</p>
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

            <!-- Alert Messages -->
            @if(session('success'))
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="glass-alert alert-success">
                            <div class="alert-icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="alert-content">
                                <strong>Berhasil!</strong>
                                <p>{{ session('success') }}</p>
                            </div>
                            <button type="button" class="alert-close" onclick="this.parentElement.style.display='none'">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="glass-alert alert-danger">
                            <div class="alert-icon">
                                <i class="fas fa-exclamation-circle"></i>
                            </div>
                            <div class="alert-content">
                                <strong>Error!</strong>
                                <p>{{ session('error') }}</p>
                            </div>
                            <button type="button" class="alert-close" onclick="this.parentElement.style.display='none'">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Messages Statistics -->
            @if($messages->count() > 0)
                <div class="row g-4 mb-5">
                    <div class="col-md-4">
                        <div class="glass-card stat-card warning-stat">
                            <div class="stat-icon warning">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="stat-content">
                                <div class="stat-header">
                                    <h6 class="stat-label">Menunggu Balasan</h6>
                                    <div class="stat-trend neutral">
                                        <i class="fas fa-hourglass-half"></i>
                                    </div>
                                </div>
                                <h2 class="stat-number">{{ $messages->where('status_kontak', 'pending')->count() }}</h2>
                                <p class="stat-description">Pesan pending</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="glass-card stat-card info-stat">
                            <div class="stat-icon info">
                                <i class="fas fa-comment-dots"></i>
                            </div>
                            <div class="stat-content">
                                <div class="stat-header">
                                    <h6 class="stat-label">Sudah Dibalas</h6>
                                    <div class="stat-trend up">
                                        <i class="fas fa-arrow-up"></i>
                                    </div>
                                </div>
                                <h2 class="stat-number">{{ $messages->where('status_kontak', 'contacted')->count() }}</h2>
                                <p class="stat-description">Pesan aktif</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="glass-card stat-card secondary-stat">
                            <div class="stat-icon secondary">
                                <i class="fas fa-archive"></i>
                            </div>
                            <div class="stat-content">
                                <div class="stat-header">
                                    <h6 class="stat-label">Ditutup</h6>
                                    <div class="stat-trend neutral">
                                        <i class="fas fa-minus"></i>
                                    </div>
                                </div>
                                <h2 class="stat-number">{{ $messages->where('status_kontak', 'closed')->count() }}</h2>
                                <p class="stat-description">Pesan selesai</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Messages List -->
            <div class="row">
                <div class="col-12">
                    <div class="glass-card table-card">
                        <div class="card-header-custom">
                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                <div class="header-info">
                                    <h5 class="table-title">
                                        <i class="fas fa-inbox me-2"></i>Daftar Pesan
                                    </h5>
                                    <p class="table-subtitle">Komunikasi dengan pemilik kos</p>
                                </div>
                                @if($messages->count() > 0)
                                    <div class="header-actions">
                                        <div class="glass-btn glass-btn-outline message-count-badge">
                                            <i class="fas fa-envelope me-2"></i>{{ $messages->total() }} Total Pesan
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="card-body-custom">
                            @if($messages->count() > 0)
                                <div class="messages-list">
                                    @foreach($messages as $message)
                                        <div class="message-card glass-message-item">
                                            <div class="message-header">
                                                <div class="message-info">
                                                    <div class="message-date">
                                                        <i class="fas fa-calendar me-2"></i>
                                                        {{ $message->created_at->format('d/m/Y H:i') }}
                                                    </div>
                                                    <div class="message-status">
                                                        @if($message->status_kontak == 'pending')
                                                            <span class="glass-badge status-pending">
                                                                <i class="fas fa-clock me-1"></i>Menunggu
                                                            </span>
                                                        @elseif($message->status_kontak == 'contacted')
                                                            <span class="glass-badge status-contacted">
                                                                <i class="fas fa-comment-dots me-1"></i>Sudah Dihubungi
                                                            </span>
                                                        @else
                                                            <span class="glass-badge status-closed">
                                                                <i class="fas fa-archive me-1"></i>Ditutup
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="message-actions">
                                                    <a href="{{ route('my-messages.detail', $message->id) }}" 
                                                       class="glass-btn-sm glass-btn-primary" 
                                                       title="Lihat Detail">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="message-content">
                                                <!-- Kos Information -->
                                                <div class="kos-preview">
                                                    <div class="kos-icon">
                                                        <i class="fas fa-home"></i>
                                                    </div>
                                                    <div class="kos-details">
                                                        <h6 class="kos-name">{{ $message->kos->nama_kos }}</h6>
                                                        <div class="kos-location">
                                                            <i class="fas fa-map-marker-alt me-1"></i>
                                                            {{ Str::limit($message->kos->lokasi, 40) }}
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Message Thread -->
                                                <div class="message-thread">
                                                    <!-- Original Message -->
                                                    <div class="message-bubble sent">
                                                        <div class="bubble-header">
                                                            <div class="sender-info">
                                                                <i class="fas fa-user-circle sender-avatar"></i>
                                                                <strong>Anda</strong>
                                                            </div>
                                                            <div class="message-time">
                                                                {{ $message->created_at->diffForHumans() }}
                                                            </div>
                                                        </div>
                                                        <div class="bubble-content">
                                                            {{ Str::limit($message->catatan ?: 'Halo, saya tertarik dengan kos Anda.', 100) }}
                                                        </div>
                                                    </div>

                                                    <!-- Reply Message -->
                                                    @if($message->balasan_pemilik)
                                                        <div class="message-bubble received">
                                                            <div class="bubble-header">
                                                                <div class="sender-info">
                                                                    <i class="fas fa-user-tie sender-avatar"></i>
                                                                    <strong>{{ $message->kos->pemilik->name }}</strong>
                                                                    <span class="owner-badge">Pemilik</span>
                                                                </div>
                                                                <div class="message-time">
                                                                    @if($message->tanggal_balasan)
                                                                        {{ $message->tanggal_balasan->diffForHumans() }}
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="bubble-content">
                                                                {{ Str::limit($message->balasan_pemilik, 100) }}
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="no-reply">
                                                            <i class="fas fa-hourglass-half me-2"></i>
                                                            <span>Menunggu balasan dari pemilik...</span>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Pagination -->
                                @if($messages->hasPages())
                                    <div class="pagination-wrapper">
                                        <div class="glass-pagination">
                                            {{ $messages->links('pagination::bootstrap-4') }}
                                        </div>
                                    </div>
                                @endif
                            @else
                                <!-- Empty State -->
                                <div class="empty-state">
                                    <div class="empty-icon">
                                        <i class="fas fa-envelope-open-text"></i>
                                    </div>
                                    <h5 class="empty-title">Belum Ada Pesan</h5>
                                    <p class="empty-description">
                                        Pesan balasan dari pemilik kos akan muncul di sini setelah Anda menghubungi mereka.
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

            /* Glass Alerts */
            .glass-alert {
                background: var(--glass-bg);
                backdrop-filter: blur(15px);
                border: 1px solid var(--glass-border);
                border-radius: 15px;
                padding: 1.5rem;
                display: flex;
                align-items: flex-start;
                gap: 1rem;
                position: relative;
            }

            .glass-alert.alert-success {
                border-color: rgba(16, 185, 129, 0.3);
                background: rgba(16, 185, 129, 0.1);
            }

            .glass-alert.alert-danger {
                border-color: rgba(239, 68, 68, 0.3);
                background: rgba(239, 68, 68, 0.1);
            }

            .alert-icon {
                width: 40px;
                height: 40px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.2rem;
                flex-shrink: 0;
            }

            .alert-success .alert-icon {
                background: var(--gradient-success);
                color: var(--white);
            }

            .alert-danger .alert-icon {
                background: var(--gradient-danger);
                color: var(--white);
            }

            .alert-content {
                flex-grow: 1;
            }

            .alert-content strong {
                color: var(--white);
                font-size: 1rem;
                margin-bottom: 0.5rem;
                display: block;
            }

            .alert-content p {
                color: rgba(255, 255, 255, 0.8);
                margin: 0;
                font-size: 0.9rem;
            }

            .alert-close {
                background: none;
                border: none;
                color: rgba(255, 255, 255, 0.6);
                cursor: pointer;
                padding: 0.25rem;
                border-radius: 50%;
                width: 30px;
                height: 30px;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: all 0.3s ease;
            }

            .alert-close:hover {
                background: rgba(255, 255, 255, 0.1);
                color: var(--white);
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

            .warning-stat:hover {
                background: rgba(217, 119, 6, 0.1);
            }

            .info-stat:hover {
                background: rgba(14, 165, 233, 0.1);
            }

            .secondary-stat:hover {
                background: rgba(75, 85, 99, 0.1);
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

            .stat-icon.warning {
                background: var(--gradient-accent);
                box-shadow: 0 8px 25px rgba(217, 119, 6, 0.3);
            }

            .stat-icon.info {
                background: var(--gradient-secondary);
                box-shadow: 0 8px 25px rgba(14, 165, 233, 0.3);
            }

            .stat-icon.secondary {
                background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
                box-shadow: 0 8px 25px rgba(75, 85, 99, 0.3);
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

            .message-count-badge {
                background: var(--glass-bg-light);
                border: 1px solid rgba(255, 255, 255, 0.3);
                padding: 0.75rem 1.25rem;
                border-radius: 50px;
                font-size: 0.9rem;
                font-weight: 600;
                color: var(--white);
            }

            /* Messages List */
            .messages-list {
                display: flex;
                flex-direction: column;
                gap: 1.5rem;
            }

            .glass-message-item {
                background: var(--glass-bg);
                backdrop-filter: blur(15px);
                border: 1px solid var(--glass-border);
                border-radius: 20px;
                padding: 2rem;
                transition: all 0.3s ease;
                position: relative;
                overflow: hidden;
            }

            .glass-message-item:hover {
                background: var(--glass-bg-light);
                transform: translateY(-5px);
                box-shadow: var(--glass-shadow-hover);
            }

            /* Message Header */
            .message-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 1.5rem;
                padding-bottom: 1rem;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            }

            .message-info {
                display: flex;
                align-items: center;
                gap: 1rem;
            }

            .message-date {
                color: rgba(255, 255, 255, 0.8);
                font-size: 0.9rem;
                font-weight: 500;
                display: flex;
                align-items: center;
            }

            .message-status .glass-badge {
                margin-bottom: 0;
            }

            .message-actions {
                display: flex;
                gap: 0.5rem;
            }

            /* Glass Badges */
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

            .glass-badge.status-contacted {
                background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
                color: #ffffff;
                border-color: #0ea5e9;
                box-shadow: 0 4px 15px rgba(14, 165, 233, 0.4);
            }

            .glass-badge.status-closed {
                background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
                color: #ffffff;
                border-color: #6b7280;
                box-shadow: 0 4px 15px rgba(107, 114, 128, 0.4);
            }

            /* Action Buttons */
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

            /* Kos Preview */
            .kos-preview {
                display: flex;
                align-items: center;
                gap: 1rem;
                margin-bottom: 1.5rem;
                padding: 1rem;
                background: var(--glass-bg-dark);
                border: 1px solid var(--glass-border);
                border-radius: 15px;
            }

            .kos-icon {
                width: 50px;
                height: 50px;
                background: var(--gradient-primary);
                border-radius: 12px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.3rem;
                color: var(--white);
                flex-shrink: 0;
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
                display: flex;
                align-items: center;
            }

            /* Message Thread */
            .message-thread {
                display: flex;
                flex-direction: column;
                gap: 1rem;
            }

            .message-bubble {
                max-width: 80%;
                padding: 1rem 1.5rem;
                border-radius: 20px;
                position: relative;
            }

            .message-bubble.sent {
                align-self: flex-end;
                background: var(--gradient-primary);
                color: var(--white);
                border-bottom-right-radius: 5px;
            }

            .message-bubble.received {
                align-self: flex-start;
                background: var(--glass-bg-light);
                border: 1px solid var(--glass-border);
                color: var(--white);
                border-bottom-left-radius: 5px;
            }

            .bubble-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 0.75rem;
                font-size: 0.85rem;
            }

            .sender-info {
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }

            .sender-avatar {
                font-size: 1.2rem;
            }

            .owner-badge {
                background: rgba(255, 255, 255, 0.2);
                color: var(--white);
                padding: 0.2rem 0.5rem;
                border-radius: 10px;
                font-size: 0.7rem;
                font-weight: 600;
            }

            .message-time {
                opacity: 0.8;
                font-size: 0.8rem;
            }

            .bubble-content {
                line-height: 1.5;
                font-size: 0.95rem;
            }

            .no-reply {
                padding: 1.5rem;
                text-align: center;
                color: rgba(255, 255, 255, 0.6);
                font-style: italic;
                background: var(--glass-bg-dark);
                border: 1px dashed var(--glass-border);
                border-radius: 15px;
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

                .message-header {
                    flex-direction: column;
                    align-items: flex-start;
                    gap: 1rem;
                }

                .message-info {
                    flex-direction: column;
                    align-items: flex-start;
                    gap: 0.5rem;
                }

                .message-bubble {
                    max-width: 95%;
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

                .glass-message-item {
                    padding: 1.5rem;
                }

                .kos-preview {
                    flex-direction: column;
                    text-align: center;
                }

                .message-bubble {
                    padding: 1rem;
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

            // Enhanced message card interactions
            document.querySelectorAll('.glass-message-item').forEach(card => {
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