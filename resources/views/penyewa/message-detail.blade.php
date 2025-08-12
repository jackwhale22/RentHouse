@extends('layouts.app')

@section('title', 'Detail Pesan - Kos Finder')

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
                                    <i class="fas fa-envelope-open"></i>
                                </div>
                                <div class="header-text">
                                    <h1 class="page-title">Detail Pesan</h1>
                                    <p class="page-subtitle">Lihat dan balas pesan dengan pemilik kos</p>
                                </div>
                            </div>
                            <div class="header-actions">
                                <a href="{{ route('my-messages') }}" class="glass-btn glass-btn-outline">
                                    <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar Pesan
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
                            <button type="button" class="alert-close"
                                onclick="this.parentElement.parentElement.parentElement.style.display='none'">
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
                                <strong>Terjadi Kesalahan!</strong>
                                <p>{{ session('error') }}</p>
                            </div>
                            <button type="button" class="alert-close"
                                onclick="this.parentElement.parentElement.parentElement.style.display='none'">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @endif

            <div class="row g-4">
                <!-- Main Content -->
                <div class="col-lg-8">
                    <!-- Kos Information Card -->
                    <div class="glass-card info-card mb-4">
                        <div class="card-header-custom">
                            <div class="header-info">
                                <div class="header-icon-small">
                                    <i class="fas fa-building"></i>
                                </div>
                                <div>
                                    <h5 class="card-title">
                                        <i class="fas fa-building me-2"></i>Informasi Kos
                                    </h5>
                                    <p class="card-subtitle">Detail lengkap kos yang Anda hubungi</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body-custom">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="info-item">
                                        <div class="info-label">
                                            <i class="fas fa-home me-2"></i>Nama Kos
                                        </div>
                                        <div class="info-value">{{ $message->kos->nama_kos }}</div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-label">
                                            <i class="fas fa-map-marker-alt me-2"></i>Lokasi
                                        </div>
                                        <div class="info-value">{{ $message->kos->lokasi }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-item">
                                        <div class="info-label">
                                            <i class="fas fa-money-bill-wave me-2"></i>Harga Sewa
                                        </div>
                                        <div class="info-value price-highlight">
                                            Rp {{ number_format($message->kos->harga, 0, ',', '.') }}/bulan
                                        </div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-label">
                                            <i class="fas fa-user-tie me-2"></i>Pemilik Kos
                                        </div>
                                        <div class="info-value">{{ $message->kos->pemilik->name }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Message Thread -->
                    <div class="glass-card conversation-card mb-4">
                        <div class="card-header-custom">
                            <div class="header-info">
                                <div class="header-icon-small">
                                    <i class="fas fa-comments"></i>
                                </div>
                                <div>
                                    <h5 class="card-title">
                                        <i class="fas fa-comments me-2"></i>Percakapan
                                    </h5>
                                    <p class="card-subtitle">Riwayat komunikasi dengan pemilik kos</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body-custom">
                            <div class="conversation-thread">
                                <!-- Original Message -->
                                <div class="message-bubble sent">
                                    <div class="bubble-header">
                                        <div class="sender-info">
                                            <div class="sender-avatar">
                                                <i class="fas fa-user-circle"></i>
                                            </div>
                                            <div class="sender-details">
                                                <strong>Anda</strong>
                                                <span class="sender-role">Penyewa</span>
                                            </div>
                                        </div>
                                        <div class="message-time">
                                            <i class="fas fa-clock me-1"></i>
                                            {{ $message->created_at->format('d/m/Y H:i') }}
                                        </div>
                                    </div>
                                    <div class="bubble-content">
                                        <div class="message-label">Pesan Awal:</div>
                                        {{ $message->catatan ?: 'Halo, saya tertarik dengan kos Anda.' }}
                                    </div>
                                </div>

                                <!-- Reply from Owner -->
                                @if($message->balasan_pemilik)
                                    <div class="message-bubble received">
                                        <div class="bubble-header">
                                            <div class="sender-info">
                                                <div class="sender-avatar owner">
                                                    <i class="fas fa-user-tie"></i>
                                                </div>
                                                <div class="sender-details">
                                                    <strong>{{ $message->kos->pemilik->name }}</strong>
                                                    <span class="sender-role owner">Pemilik Kos</span>
                                                </div>
                                            </div>
                                            <div class="message-time">
                                                <i class="fas fa-clock me-1"></i>
                                                @if($message->tanggal_balasan)
                                                    {{ $message->tanggal_balasan->format('d/m/Y H:i') }}
                                                @endif
                                            </div>
                                        </div>
                                        <div class="bubble-content">
                                            <div class="message-label">Balasan:</div>
                                            {{ $message->balasan_pemilik }}
                                        </div>
                                    </div>
                                @else
                                    <div class="no-reply-message">
                                        <div class="no-reply-icon">
                                            <i class="fas fa-hourglass-half"></i>
                                        </div>
                                        <div class="no-reply-content">
                                            <h6>Menunggu Balasan</h6>
                                            <p>Pemilik kos belum membalas pesan Anda. Pesan akan muncul di sini setelah pemilik
                                                memberikan balasan.</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Reply Form -->
                    <div class="glass-card reply-card">
                        <div class="card-header-custom">
                            <div class="header-info">
                                <div class="header-icon-small">
                                    <i class="fas fa-reply"></i>
                                </div>
                                <div>
                                    <h5 class="card-title">
                                        <i class="fas fa-reply me-2"></i>Balas Pesan
                                    </h5>
                                    <p class="card-subtitle">Kirim balasan kepada pemilik kos</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body-custom">
                            <form action="{{ route('my-messages.reply', $message->id) }}" method="POST" class="reply-form">
                                @csrf
                                <div class="form-group">
                                    <label for="catatan" class="form-label">
                                        <i class="fas fa-edit me-2"></i>Tulis Balasan Anda
                                    </label>
                                    <textarea class="glass-textarea @error('catatan') is-invalid @enderror" id="catatan"
                                        name="catatan" rows="6"
                                        placeholder="Tulis balasan Anda untuk pemilik kos di sini...">{{ old('catatan') }}</textarea>
                                    @error('catatan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="glass-btn glass-btn-primary">
                                        <i class="fas fa-paper-plane me-2"></i>Kirim Balasan
                                    </button>
                                    <button type="reset" class="glass-btn glass-btn-outline">
                                        <i class="fas fa-eraser me-2"></i>Bersihkan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- Contact Information -->
                    <div class="glass-card contact-card mb-4">
                        <div class="card-header-custom">
                            <div class="header-info">
                                <div class="header-icon-small">
                                    <i class="fas fa-address-card"></i>
                                </div>
                                <div>
                                    <h5 class="card-title">
                                        <i class="fas fa-user me-2"></i>Informasi Pemilik
                                    </h5>
                                    <p class="card-subtitle">Kontak pemilik kos</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body-custom">
                            <div class="owner-profile">
                                <div class="owner-avatar">
                                    <i class="fas fa-user-tie"></i>
                                </div>
                                <div class="owner-info">
                                    <h6 class="owner-name">{{ $message->kos->pemilik->name }}</h6>
                                    <span class="owner-badge">Pemilik Kos</span>
                                </div>
                            </div>

                            <div class="contact-details">
                                <div class="contact-item">
                                    <div class="contact-icon">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div class="contact-info">
                                        <div class="contact-label">Email</div>
                                        <div class="contact-value">{{ $message->kos->pemilik->email }}</div>
                                    </div>
                                </div>
                                @if($message->kos->pemilik->phone)
                                    <div class="contact-item">
                                        <div class="contact-icon">
                                            <i class="fas fa-phone"></i>
                                        </div>
                                        <div class="contact-info">
                                            <div class="contact-label">Telepon</div>
                                            <div class="contact-value">{{ $message->kos->pemilik->phone }}</div>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="status-section">
                                <div class="status-label">Status Kontak:</div>
                                <div class="status-badge">
                                    @if($message->status_kontak == 'pending')
                                        <span class="glass-badge status-pending">
                                            <i class="fas fa-clock me-1"></i>Menunggu Balasan
                                        </span>
                                    @elseif($message->status_kontak == 'contacted')
                                        <span class="glass-badge status-contacted">
                                            <i class="fas fa-comment-dots me-1"></i>Sudah Dihubungi
                                        </span>
                                    @else
                                        <span class="glass-badge status-closed">
                                            <i class="fas fa-archive me-1"></i>Percakapan Ditutup
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="quick-actions">
                                <h6 class="actions-title">
                                    <i class="fas fa-phone-alt me-2"></i>Kontak Langsung
                                </h6>
                                <div class="action-buttons">
                                    @if($message->kos->pemilik->phone)
                                        <a href="tel:{{ $message->kos->pemilik->phone }}" class="action-btn phone-btn">
                                            <i class="fas fa-phone me-2"></i>Telepon
                                        </a>
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $message->kos->pemilik->phone) }}"
                                            target="_blank" class="action-btn whatsapp-btn">
                                            <i class="fab fa-whatsapp me-2"></i>WhatsApp
                                        </a>
                                    @endif
                                    <a href="mailto:{{ $message->kos->pemilik->email }}" class="action-btn email-btn">
                                        <i class="fas fa-envelope me-2"></i>Email
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Message Stats -->
                    <div class="glass-card stats-card">
                        <div class="card-header-custom">
                            <div class="header-info">
                                <div class="header-icon-small">
                                    <i class="fas fa-chart-line"></i>
                                </div>
                                <div>
                                    <h5 class="card-title">
                                        <i class="fas fa-info-circle me-2"></i>Info Pesan
                                    </h5>
                                    <p class="card-subtitle">Detail tambahan</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body-custom">
                            <div class="stat-item">
                                <div class="stat-icon">
                                    <i class="fas fa-calendar-plus"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="stat-label">Pesan Dikirim</div>
                                    <div class="stat-value">{{ $message->created_at->diffForHumans() }}</div>
                                </div>
                            </div>
                            @if($message->tanggal_balasan)
                                <div class="stat-item">
                                    <div class="stat-icon">
                                        <i class="fas fa-reply"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="stat-label">Balasan Diterima</div>
                                        <div class="stat-value">{{ $message->tanggal_balasan->diffForHumans() }}</div>
                                    </div>
                                </div>
                            @endif
                            <div class="stat-item">
                                <div class="stat-icon">
                                    <i class="fas fa-eye"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="stat-label">Status</div>
                                    <div class="stat-value">
                                        @if($message->status_kontak == 'pending')
                                            Menunggu Balasan
                                        @elseif($message->status_kontak == 'contacted')
                                            Aktif
                                        @else
                                            Selesai
                                        @endif
                                    </div>
                                </div>
                            </div>
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

            /* Card Headers */
            .card-header-custom {
                padding: 2rem 2.5rem 1rem;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            }

            .header-info {
                display: flex;
                align-items: center;
                gap: 1rem;
            }

            .header-icon-small {
                width: 50px;
                height: 50px;
                background: var(--gradient-primary);
                border-radius: 15px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.2rem;
                color: var(--white);
                flex-shrink: 0;
            }

            .card-title {
                font-family: 'Poppins', sans-serif;
                font-size: 1.3rem;
                font-weight: 700;
                color: var(--white);
                margin-bottom: 0.25rem;
            }

            .card-subtitle {
                color: rgba(255, 255, 255, 0.8);
                font-size: 0.9rem;
                margin: 0;
            }

            .card-body-custom {
                padding: 1.5rem 2.5rem 2.5rem;
            }

            /* Info Card Styles */
            .info-item {
                margin-bottom: 1.5rem;
            }

            .info-item:last-child {
                margin-bottom: 0;
            }

            .info-label {
                color: rgba(255, 255, 255, 0.8);
                font-size: 0.9rem;
                font-weight: 600;
                margin-bottom: 0.5rem;
                display: flex;
                align-items: center;
            }

            .info-value {
                color: var(--white);
                font-size: 1rem;
                font-weight: 500;
                padding: 0.75rem 1rem;
                background: var(--glass-bg-light);
                border: 1px solid var(--glass-border);
                border-radius: 12px;
            }

            .price-highlight {
                background: var(--gradient-accent);
                color: var(--white);
                font-weight: 700;
                border: none;
            }

            /* Conversation Styles */
            .conversation-thread {
                display: flex;
                flex-direction: column;
                gap: 2rem;
            }

            .message-bubble {
                max-width: 85%;
                padding: 1.5rem;
                border-radius: 20px;
                position: relative;
            }

            .message-bubble.sent {
                align-self: flex-end;
                background: var(--gradient-primary);
                color: var(--white);
                border-bottom-right-radius: 8px;
            }

            .message-bubble.received {
                align-self: flex-start;
                background: var(--glass-bg-light);
                border: 1px solid var(--glass-border);
                color: var(--white);
                border-bottom-left-radius: 8px;
            }

            .bubble-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 1rem;
                padding-bottom: 0.75rem;
                border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            }

            .sender-info {
                display: flex;
                align-items: center;
                gap: 0.75rem;
            }

            .sender-avatar {
                width: 40px;
                height: 40px;
                background: rgba(255, 255, 255, 0.2);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.2rem;
                color: var(--white);
            }

            .sender-avatar.owner {
                background: var(--gradient-accent);
            }

            .sender-details strong {
                display: block;
                font-size: 0.95rem;
                margin-bottom: 0.25rem;
            }

            .sender-role {
                font-size: 0.8rem;
                opacity: 0.8;
                padding: 0.2rem 0.5rem;
                background: rgba(255, 255, 255, 0.15);
                border-radius: 10px;
            }

            .sender-role.owner {
                background: rgba(245, 158, 11, 0.3);
            }

            .message-time {
                font-size: 0.85rem;
                opacity: 0.8;
                display: flex;
                align-items: center;
            }

            .bubble-content {
                line-height: 1.6;
            }

            .message-label {
                font-size: 0.8rem;
                font-weight: 600;
                opacity: 0.8;
                margin-bottom: 0.5rem;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            /* No Reply Message */
            .no-reply-message {
                display: flex;
                align-items: center;
                gap: 1.5rem;
                padding: 2rem;
                background: var(--glass-bg-dark);
                border: 2px dashed var(--glass-border);
                border-radius: 20px;
                text-align: left;
            }

            .no-reply-icon {
                width: 60px;
                height: 60px;
                background: var(--gradient-accent);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.5rem;
                color: var(--white);
                flex-shrink: 0;
            }

            .no-reply-content h6 {
                color: var(--white);
                font-weight: 700;
                margin-bottom: 0.5rem;
            }

            .no-reply-content p {
                color: rgba(255, 255, 255, 0.8);
                margin: 0;
                font-size: 0.9rem;
            }

            /* Form Styles */
            .reply-form {
                display: flex;
                flex-direction: column;
                gap: 1.5rem;
            }

            .form-group {
                display: flex;
                flex-direction: column;
            }

            .form-label {
                color: var(--white);
                font-weight: 600;
                margin-bottom: 0.75rem;
                font-size: 1rem;
            }

            .glass-textarea {
                background: var(--glass-bg-light);
                backdrop-filter: blur(15px);
                border: 1px solid var(--glass-border);
                border-radius: 15px;
                padding: 1rem 1.25rem;
                color: var(--white);
                font-size: 0.95rem;
                line-height: 1.6;
                resize: vertical;
                min-height: 120px;
                transition: all 0.3s ease;
            }

            .glass-textarea:focus {
                outline: none;
                border-color: rgba(96, 165, 250, 0.5);
                background: var(--glass-bg);
                box-shadow: 0 0 0 3px rgba(96, 165, 250, 0.1);
            }

            .glass-textarea::placeholder {
                color: rgba(255, 255, 255, 0.6);
            }

            .form-actions {
                display: flex;
                gap: 1rem;
                flex-wrap: wrap;
            }

            /* Contact Card Styles */
            .owner-profile {
                display: flex;
                align-items: center;
                gap: 1rem;
                margin-bottom: 2rem;
                padding: 1.5rem;
                background: var(--glass-bg-dark);
                border: 1px solid var(--glass-border);
                border-radius: 15px;
            }

            .owner-avatar {
                width: 60px;
                height: 60px;
                background: var(--gradient-accent);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.5rem;
                color: var(--white);
                flex-shrink: 0;
            }

            .owner-name {
                color: var(--white);
                font-weight: 700;
                font-size: 1.1rem;
                margin-bottom: 0.25rem;
            }

            .owner-badge {
                background: var(--gradient-primary);
                color: var(--white);
                padding: 0.25rem 0.75rem;
                border-radius: 15px;
                font-size: 0.8rem;
                font-weight: 600;
            }

            /* Contact Details */
            .contact-details {
                margin-bottom: 2rem;
            }

            .contact-item {
                display: flex;
                align-items: center;
                gap: 1rem;
                padding: 1rem;
                margin-bottom: 1rem;
                background: var(--glass-bg-dark);
                border: 1px solid var(--glass-border);
                border-radius: 12px;
                transition: all 0.3s ease;
            }

            .contact-item:hover {
                background: var(--glass-bg-light);
                transform: translateX(5px);
            }

            .contact-icon {
                width: 40px;
                height: 40px;
                background: var(--gradient-secondary);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1rem;
                color: var(--white);
                flex-shrink: 0;
            }

            .contact-label {
                font-size: 0.8rem;
                color: rgba(255, 255, 255, 0.8);
                margin-bottom: 0.25rem;
            }

            .contact-value {
                color: var(--white);
                font-weight: 500;
                font-size: 0.9rem;
            }

            /* Status Section */
            .status-section {
                margin-bottom: 2rem;
                padding: 1.5rem;
                background: var(--glass-bg-dark);
                border: 1px solid var(--glass-border);
                border-radius: 15px;
            }

            .status-label {
                color: rgba(255, 255, 255, 0.8);
                font-size: 0.9rem;
                font-weight: 600;
                margin-bottom: 0.75rem;
            }

            /* Quick Actions */
            .quick-actions {
                margin-top: 2rem;
            }

            .actions-title {
                color: var(--white);
                font-weight: 700;
                margin-bottom: 1rem;
                font-size: 1rem;
            }

            .action-buttons {
                display: flex;
                flex-direction: column;
                gap: 0.75rem;
            }

            .action-btn {
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 0.75rem 1rem;
                border-radius: 12px;
                text-decoration: none;
                font-weight: 600;
                font-size: 0.9rem;
                transition: all 0.3s ease;
                border: 1px solid var(--glass-border);
                background: var(--glass-bg);
                color: var(--white);
            }

            .action-btn:hover {
                transform: translateY(-2px);
                color: var(--white);
            }

            .phone-btn:hover {
                background: var(--gradient-primary);
                border-color: var(--primary-light);
            }

            .whatsapp-btn:hover {
                background: linear-gradient(135deg, #25d366 0%, #128c7e 100%);
                border-color: #25d366;
            }

            .email-btn:hover {
                background: var(--gradient-secondary);
                border-color: var(--info-color);
            }

            /* Stats Card */
            .stat-item {
                display: flex;
                align-items: center;
                gap: 1rem;
                padding: 1rem;
                margin-bottom: 1rem;
                background: var(--glass-bg-dark);
                border: 1px solid var(--glass-border);
                border-radius: 12px;
            }

            .stat-item:last-child {
                margin-bottom: 0;
            }

            .stat-icon {
                width: 40px;
                height: 40px;
                background: var(--gradient-info);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1rem;
                color: var(--white);
                flex-shrink: 0;
            }

            .stat-label {
                font-size: 0.8rem;
                color: rgba(255, 255, 255, 0.8);
                margin-bottom: 0.25rem;
            }

            .stat-value {
                color: var(--white);
                font-weight: 600;
                font-size: 0.9rem;
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

            /* Glass Badges */
            .glass-badge {
                display: inline-flex;
                align-items: center;
                padding: 0.5rem 1rem;
                border-radius: 25px;
                font-size: 0.85rem;
                font-weight: 700;
                border: 2px solid;
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

                .card-header-custom {
                    padding: 1.5rem 1.5rem 1rem;
                }

                .card-body-custom {
                    padding: 1rem 1.5rem 1.5rem;
                }

                .message-bubble {
                    max-width: 95%;
                }

                .bubble-header {
                    flex-direction: column;
                    align-items: flex-start;
                    gap: 0.5rem;
                }

                .no-reply-message {
                    flex-direction: column;
                    text-align: center;
                }

                .form-actions {
                    flex-direction: column;
                }

                .form-actions .glass-btn {
                    width: 100%;
                }

                .owner-profile {
                    flex-direction: column;
                    text-align: center;
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

                .header-icon-small {
                    width: 40px;
                    height: 40px;
                    font-size: 1rem;
                }

                .message-bubble {
                    padding: 1rem;
                }

                .glass-textarea {
                    min-height: 100px;
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
            .glass-textarea:focus {
                outline: 2px solid rgba(255, 255, 255, 0.5);
                outline-offset: 2px;
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            // Add ripple effect to buttons
            document.querySelectorAll('.glass-btn, .action-btn').forEach(button => {
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

            // Enhanced card interactions
            document.querySelectorAll('.glass-card').forEach(card => {
                card.addEventListener('mouseenter', function () {
                    this.style.transform = 'translateY(-3px)';
                    this.style.boxShadow = 'var(--glass-shadow-hover)';
                });

                card.addEventListener('mouseleave', function () {
                    this.style.transform = '';
                    this.style.boxShadow = '';
                });
            });

            // Auto-resize textarea
            const textarea = document.getElementById('catatan');
            if (textarea) {
                textarea.addEventListener('input', function () {
                    this.style.height = 'auto';
                    this.style.height = Math.max(120, this.scrollHeight) + 'px';
                });
            }

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