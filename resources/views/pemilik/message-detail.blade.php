@extends('layouts.app')

@section('title', 'Detail Pesan - Rent House')

@section('content')
    <div class="container-fluid glassmorphism-detail-pesan">
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
                                    <p class="page-subtitle">Kelola dan balas pesan dari calon penyewa</p>
                                </div>
                            </div>
                            <div class="header-actions">
                                <a href="{{ route('pemilik.messages') }}" class="glass-btn glass-btn-outline">
                                    <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar Pesan
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Success Alert -->
            @if(session('success'))
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="glass-alert glass-alert-success">
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

            <div class="row g-4">
                <!-- Main Content -->
                <div class="col-lg-8">
                    <!-- Penyewa Information -->
                    <div class="glass-card info-card mb-4">
                        <div class="card-header penyewa-header">
                            <div class="header-icon-wrapper">
                                <div class="header-icon-bg penyewa">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                            <div class="header-info">
                                <h5 class="card-title">Informasi Penyewa</h5>
                                <p class="card-subtitle">Detail lengkap calon penyewa</p>
                            </div>
                            <div class="user-avatar">
                                <i class="fas fa-user-circle"></i>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="info-grid">
                                <div class="info-item">
                                    <div class="info-label">
                                        <i class="fas fa-user me-2"></i>Nama Lengkap
                                    </div>
                                    <div class="info-value">{{ $message->penyewa->name }}</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">
                                        <i class="fas fa-envelope me-2"></i>Email
                                    </div>
                                    <div class="info-value">
                                        <a href="mailto:{{ $message->penyewa->email }}" class="email-link">
                                            {{ $message->penyewa->email }}
                                        </a>
                                    </div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">
                                        <i class="fas fa-phone me-2"></i>Nomor Telepon
                                    </div>
                                    <div class="info-value">
                                        @if($message->penyewa->phone)
                                            <a href="tel:{{ $message->penyewa->phone }}" class="phone-link">
                                                {{ $message->penyewa->phone }}
                                            </a>
                                        @else
                                            <span class="text-muted">Tidak tersedia</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">
                                        <i class="fas fa-calendar-plus me-2"></i>Tanggal Bergabung
                                    </div>
                                    <div class="info-value">{{ $message->penyewa->created_at->format('d F Y') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kos Information -->
                    <div class="glass-card info-card mb-4">
                        <div class="card-header kos-header">
                            <div class="header-icon-wrapper">
                                <div class="header-icon-bg kos">
                                    <i class="fas fa-building"></i>
                                </div>
                            </div>
                            <div class="header-info">
                                <h5 class="card-title">Informasi Kos</h5>
                                <p class="card-subtitle">Detail kos yang diminati</p>
                            </div>
                            <div class="kos-status">
                                @if($message->kos->status_ketersediaan == 'tersedia')
                                    <div class="enhanced-badge enhanced-badge-sm status-new">
                                        <div class="badge-icon">
                                            <i class="fas fa-check-circle"></i>
                                        </div>
                                        <div class="badge-content">
                                            <div class="badge-title">TERSEDIA</div>
                                            <div class="badge-subtitle">Aktif</div>
                                        </div>
                                        <div class="badge-glow status-new-glow"></div>
                                    </div>
                                @else
                                    <div class="enhanced-badge enhanced-badge-sm priority-high">
                                        <div class="badge-icon">
                                            <i class="fas fa-times-circle"></i>
                                        </div>
                                        <div class="badge-content">
                                            <div class="badge-title">PENUH</div>
                                            <div class="badge-subtitle">Tidak Tersedia</div>
                                        </div>
                                        <div class="badge-glow priority-high-glow"></div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="info-grid">
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
                                <div class="info-item">
                                    <div class="info-label">
                                        <i class="fas fa-money-bill-wave me-2"></i>Harga per Bulan
                                    </div>
                                    <div class="info-value price-value">
                                        Rp {{ number_format($message->kos->harga, 0, ',', '.') }}
                                    </div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">
                                        <i class="fas fa-toggle-on me-2"></i>Status Ketersediaan
                                    </div>
                                    <div class="info-value">
                                        @if($message->kos->status_ketersediaan == 'tersedia')
                                            <span class="status-text available">Tersedia</span>
                                        @else
                                            <span class="status-text unavailable">Tidak Tersedia</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Original Message -->
                    <div class="glass-card message-card mb-4">
                        <div class="card-header message-header">
                            <div class="header-icon-wrapper">
                                <div class="header-icon-bg message">
                                    <i class="fas fa-comment"></i>
                                </div>
                            </div>
                            <div class="header-info">
                                <h5 class="card-title">Pesan dari Penyewa</h5>
                                <p class="card-subtitle">Dikirim pada {{ $message->created_at->format('d F Y, H:i') }} WIB
                                </p>
                            </div>
                            <div class="message-timestamp">
                                <div class="enhanced-badge enhanced-badge-xs priority-medium">
                                    <div class="badge-icon">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <div class="badge-content">
                                        <div class="badge-title">{{ $message->created_at->diffForHumans() }}</div>
                                        <div class="badge-subtitle">Dikirim</div>
                                    </div>
                                    <div class="badge-glow priority-medium-glow"></div>
                                </div>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="message-bubble original-message">
                                @if($message->catatan)
                                    <p>{{ $message->catatan }}</p>
                                @else
                                    <p class="text-muted"><em>Tidak ada pesan khusus</em></p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Reply Section -->
                    @if($message->balasan_pemilik)
                        <div class="glass-card reply-card mb-4">
                            <div class="card-header reply-header">
                                <div class="header-icon-wrapper">
                                    <div class="header-icon-bg reply">
                                        <i class="fas fa-reply"></i>
                                    </div>
                                </div>
                                <div class="header-info">
                                    <h5 class="card-title">Balasan Anda</h5>
                                    <p class="card-subtitle">Dikirim pada {{ $message->tanggal_balasan->format('d F Y, H:i') }}
                                        WIB</p>
                                </div>
                                <div class="reply-status">
                                    <div class="enhanced-badge enhanced-badge-xs status-read">
                                        <div class="badge-icon">
                                            <i class="fas fa-check-double"></i>
                                        </div>
                                        <div class="badge-content">
                                            <div class="badge-title">TERKIRIM</div>
                                            <div class="badge-subtitle">Sukses</div>
                                        </div>
                                        <div class="badge-glow status-read-glow"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-content">
                                <div class="message-bubble reply-message">
                                    <p>{{ $message->balasan_pemilik }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Reply Form -->
                    <div class="glass-card reply-form-card">
                        <div class="card-header form-header">
                            <div class="header-icon-wrapper">
                                <div class="header-icon-bg form">
                                    <i class="fas fa-edit"></i>
                                </div>
                            </div>
                            <div class="header-info">
                                <h5 class="card-title">
                                    @if($message->balasan_pemilik)
                                        Perbarui Balasan
                                    @else
                                        Kirim Balasan
                                    @endif
                                </h5>
                                <p class="card-subtitle">Balas pesan dari calon penyewa</p>
                            </div>
                        </div>
                        <div class="card-content">
                            <form action="{{ route('pemilik.messages.reply', $message->id) }}" method="POST"
                                class="reply-form">
                                @csrf
                                <div class="form-group">
                                    <label for="balasan_pemilik" class="glass-label">
                                        <i class="fas fa-comment-dots me-2"></i>Balasan Anda
                                    </label>
                                    <div class="glass-textarea-wrapper">
                                        <textarea class="glass-textarea @error('balasan_pemilik') is-invalid @enderror"
                                            id="balasan_pemilik" name="balasan_pemilik" rows="5"
                                            placeholder="Tulis balasan Anda untuk penyewa...">{{ old('balasan_pemilik', $message->balasan_pemilik) }}</textarea>
                                        <div class="character-count">
                                            <span
                                                id="charCount">{{ strlen(old('balasan_pemilik', $message->balasan_pemilik ?? '')) }}</span>/500
                                            karakter
                                        </div>
                                    </div>
                                    @error('balasan_pemilik')
                                        <div class="glass-error">
                                            <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="glass-btn glass-btn-primary reply-btn">
                                        <i class="fas fa-paper-plane me-2"></i>
                                        <span class="btn-text">
                                            @if($message->balasan_pemilik)
                                                Perbarui Balasan
                                            @else
                                                Kirim Balasan
                                            @endif
                                        </span>
                                        <span class="btn-loading" style="display: none;">
                                            <i class="fas fa-spinner fa-spin me-2"></i>Mengirim...
                                        </span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Status Management Sidebar -->
                <div class="col-lg-4">
                    <div class="glass-card status-card sticky-card">
                        <div class="card-header status-header">
                            <div class="header-icon-wrapper">
                                <div class="header-icon-bg status">
                                    <i class="fas fa-cogs"></i>
                                </div>
                            </div>
                            <div class="header-info">
                                <h5 class="card-title">Kelola Status</h5>
                                <p class="card-subtitle">Ubah status pesan dan transaksi</p>
                            </div>
                        </div>
                        <div class="card-content">
                            <!-- Current Status Display -->
                            <div class="current-status-section">
                                <div class="status-item">
                                    <div class="status-label">
                                        <i class="fas fa-eye me-2"></i>Status Kontak
                                    </div>
                                    <div class="status-value">
                                        @if($message->status_kontak == 'pending')
                                            <div class="enhanced-badge enhanced-badge-sm status-new">
                                                <div class="badge-icon">
                                                    <i class="fas fa-clock"></i>
                                                </div>
                                                <div class="badge-content">
                                                    <div class="badge-title">MENUNGGU</div>
                                                    <div class="badge-subtitle">Belum Dihubungi</div>
                                                </div>
                                                <div class="badge-glow status-new-glow"></div>
                                            </div>
                                        @elseif($message->status_kontak == 'contacted')
                                            <div class="enhanced-badge enhanced-badge-sm status-read">
                                                <div class="badge-icon">
                                                    <i class="fas fa-check"></i>
                                                </div>
                                                <div class="badge-content">
                                                    <div class="badge-title">DIHUBUNGI</div>
                                                    <div class="badge-subtitle">Sudah Dihubungi</div>
                                                </div>
                                                <div class="badge-glow status-read-glow"></div>
                                            </div>
                                        @else
                                            <div class="enhanced-badge enhanced-badge-sm status-archived">
                                                <div class="badge-icon">
                                                    <i class="fas fa-times"></i>
                                                </div>
                                                <div class="badge-content">
                                                    <div class="badge-title">DITUTUP</div>
                                                    <div class="badge-subtitle">Tidak Aktif</div>
                                                </div>
                                                <div class="badge-glow status-archived-glow"></div>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="status-item">
                                    <div class="status-label">
                                        <i class="fas fa-exchange-alt me-2"></i>Status Transaksi
                                    </div>
                                    <div class="status-value">
                                        @if($message->status_transaksi == 'pending')
                                            <div class="enhanced-badge enhanced-badge-sm priority-medium">
                                                <div class="badge-icon">
                                                    <i class="fas fa-clock"></i>
                                                </div>
                                                <div class="badge-content">
                                                    <div class="badge-title">PENDING</div>
                                                    <div class="badge-subtitle">Proses</div>
                                                </div>
                                                <div class="badge-glow priority-medium-glow"></div>
                                            </div>
                                        @elseif($message->status_transaksi == 'selesai')
                                            <div class="enhanced-badge enhanced-badge-sm priority-low">
                                                <div class="badge-icon">
                                                    <i class="fas fa-check-circle"></i>
                                                </div>
                                                <div class="badge-content">
                                                    <div class="badge-title">SELESAI</div>
                                                    <div class="badge-subtitle">Sukses</div>
                                                </div>
                                                <div class="badge-glow priority-low-glow"></div>
                                            </div>
                                        @else
                                            <div class="enhanced-badge enhanced-badge-sm priority-high">
                                                <div class="badge-icon">
                                                    <i class="fas fa-times-circle"></i>
                                                </div>
                                                <div class="badge-content">
                                                    <div class="badge-title">DIBATALKAN</div>
                                                    <div class="badge-subtitle">Batal</div>
                                                </div>
                                                <div class="badge-glow priority-high-glow"></div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Status Update Forms -->
                            <div class="status-forms-section">
                                <!-- Transaction Status Form -->
                                <div class="status-form-group">
                                    <h6 class="form-section-title">
                                        <i class="fas fa-exchange-alt me-2"></i>Ubah Status Transaksi
                                    </h6>
                                    <form action="{{ route('pemilik.messages.update-transaksi-status', $message->id) }}"
                                        method="POST" class="status-form">
                                        @csrf
                                        <div class="form-group">
                                            <div class="glass-select-wrapper">
                                                <select class="glass-select @error('status_transaksi') is-invalid @enderror"
                                                    id="status_transaksi" name="status_transaksi">
                                                    <option value="pending" {{ $message->status_transaksi == 'pending' ? 'selected' : '' }}>
                                                        Pending
                                                    </option>
                                                    <option value="selesai" {{ $message->status_transaksi == 'selesai' ? 'selected' : '' }}>
                                                        Selesai
                                                    </option>
                                                    <option value="dibatalkan" {{ $message->status_transaksi == 'dibatalkan' ? 'selected' : '' }}>
                                                        Dibatalkan
                                                    </option>
                                                </select>
                                                <div class="select-icon">
                                                    <i class="fas fa-chevron-down"></i>
                                                </div>
                                            </div>
                                            @error('status_transaksi')
                                                <div class="glass-error">
                                                    <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <button type="submit" class="glass-btn glass-btn-primary w-100">
                                            <i class="fas fa-save me-2"></i>Perbarui Status Transaksi
                                        </button>
                                    </form>
                                </div>

                                <!-- Contact Status Form -->
                                <div class="status-form-group">
                                    <h6 class="form-section-title">
                                        <i class="fas fa-eye me-2"></i>Ubah Status Kontak
                                    </h6>
                                    <form action="{{ route('pemilik.messages.status', $message->id) }}" method="POST"
                                        class="status-form">
                                        @csrf
                                        <div class="form-group">
                                            <div class="glass-select-wrapper">
                                                <select class="glass-select @error('status_kontak') is-invalid @enderror"
                                                    id="status_kontak" name="status_kontak">
                                                    <option value="pending" {{ $message->status_kontak == 'pending' ? 'selected' : '' }}>
                                                        Menunggu
                                                    </option>
                                                    <option value="contacted" {{ $message->status_kontak == 'contacted' ? 'selected' : '' }}>
                                                        Sudah Dihubungi
                                                    </option>
                                                    <option value="closed" {{ $message->status_kontak == 'closed' ? 'selected' : '' }}>
                                                        Ditutup
                                                    </option>
                                                </select>
                                                <div class="select-icon">
                                                    <i class="fas fa-chevron-down"></i>
                                                </div>
                                            </div>
                                            @error('status_kontak')
                                                <div class="glass-error">
                                                    <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <button type="submit" class="glass-btn glass-btn-primary w-100">
                                            <i class="fas fa-save me-2"></i>Perbarui Status Kontak
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <!-- Quick Actions -->
                            <div class="quick-actions-section">
                                <h6 class="form-section-title">
                                    <i class="fas fa-bolt me-2"></i>Aksi Cepat
                                </h6>
                                <div class="quick-actions-grid">
                                    @if($message->penyewa->phone)
                                        <a href="tel:{{ $message->penyewa->phone }}"
                                            class="glass-btn glass-btn-outline quick-action-btn">
                                            <i class="fas fa-phone"></i>
                                            <span>Telepon</span>
                                        </a>
                                    @endif
                                    <a href="mailto:{{ $message->penyewa->email }}"
                                        class="glass-btn glass-btn-outline quick-action-btn">
                                        <i class="fas fa-envelope"></i>
                                        <span>Email</span>
                                    </a>
                                    @if($message->penyewa->phone)
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $message->penyewa->phone) }}"
                                            target="_blank" class="glass-btn glass-btn-outline quick-action-btn whatsapp-btn">
                                            <i class="fab fa-whatsapp"></i>
                                            <span>WhatsApp</span>
                                        </a>
                                    @endif
                                    <a href="{{ route('pemilik.kos.edit', $message->kos->id) }}"
                                        class="glass-btn glass-btn-outline quick-action-btn">
                                        <i class="fas fa-edit"></i>
                                        <span>Edit Kos</span>
                                    </a>
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
                --gradient-background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #4facfe 100%);
            }

            .glassmorphism-detail-pesan {
                background: var(--gradient-background);
                min-height: 100vh;
                position: relative;
                overflow-x: hidden;
            }

            .glassmorphism-detail-pesan::before {
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

            /* Status Badges untuk Messages */
            .status-new {
                background: linear-gradient(135deg, rgba(34, 197, 94, 0.2) 0%, rgba(21, 128, 61, 0.15) 100%);
                border-color: rgba(34, 197, 94, 0.4);
                color: #ffffff;
            }

            .status-new .badge-icon {
                background: linear-gradient(135deg, #22c55e 0%, #15803d 100%);
                color: #ffffff;
                box-shadow: 0 4px 15px rgba(34, 197, 94, 0.4);
            }

            .status-new-glow {
                background: linear-gradient(135deg, #22c55e 0%, #15803d 100%);
            }

            .status-new:hover {
                background: linear-gradient(135deg, rgba(34, 197, 94, 0.3) 0%, rgba(21, 128, 61, 0.25) 100%);
                border-color: rgba(34, 197, 94, 0.6);
                box-shadow: 0 15px 40px rgba(34, 197, 94, 0.3);
            }

            .status-read {
                background: linear-gradient(135deg, rgba(59, 130, 246, 0.2) 0%, rgba(37, 99, 235, 0.15) 100%);
                border-color: rgba(59, 130, 246, 0.4);
                color: #ffffff;
            }

            .status-read .badge-icon {
                background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
                color: #ffffff;
                box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4);
            }

            .status-read-glow {
                background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            }

            .status-read:hover {
                background: linear-gradient(135deg, rgba(59, 130, 246, 0.3) 0%, rgba(37, 99, 235, 0.25) 100%);
                border-color: rgba(59, 130, 246, 0.6);
                box-shadow: 0 15px 40px rgba(59, 130, 246, 0.3);
            }

            .status-archived {
                background: linear-gradient(135deg, rgba(156, 163, 175, 0.2) 0%, rgba(107, 114, 128, 0.15) 100%);
                border-color: rgba(156, 163, 175, 0.4);
                color: #ffffff;
            }

            .status-archived .badge-icon {
                background: linear-gradient(135deg, #9ca3af 0%, #6b7280 100%);
                color: #ffffff;
                box-shadow: 0 4px 15px rgba(156, 163, 175, 0.4);
            }

            .status-archived-glow {
                background: linear-gradient(135deg, #9ca3af 0%, #6b7280 100%);
            }

            .status-archived:hover {
                background: linear-gradient(135deg, rgba(156, 163, 175, 0.3) 0%, rgba(107, 114, 128, 0.25) 100%);
                border-color: rgba(156, 163, 175, 0.6);
                box-shadow: 0 15px 40px rgba(156, 163, 175, 0.3);
            }

            /* Priority Badges */
            .priority-high {
                background: linear-gradient(135deg, rgba(239, 68, 68, 0.2) 0%, rgba(220, 38, 38, 0.15) 100%);
                border-color: rgba(239, 68, 68, 0.4);
                color: #ffffff;
            }

            .priority-high .badge-icon {
                background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
                color: #ffffff;
                box-shadow: 0 4px 15px rgba(239, 68, 68, 0.4);
            }

            .priority-high-glow {
                background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            }

            .priority-high:hover {
                background: linear-gradient(135deg, rgba(239, 68, 68, 0.3) 0%, rgba(220, 38, 38, 0.25) 100%);
                border-color: rgba(239, 68, 68, 0.6);
                box-shadow: 0 15px 40px rgba(239, 68, 68, 0.3);
            }

            .priority-medium {
                background: linear-gradient(135deg, rgba(245, 158, 11, 0.2) 0%, rgba(217, 119, 6, 0.15) 100%);
                border-color: rgba(245, 158, 11, 0.4);
                color: #ffffff;
            }

            .priority-medium .badge-icon {
                background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
                color: #ffffff;
                box-shadow: 0 4px 15px rgba(245, 158, 11, 0.4);
            }

            .priority-medium-glow {
                background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            }

            .priority-medium:hover {
                background: linear-gradient(135deg, rgba(245, 158, 11, 0.3) 0%, rgba(217, 119, 6, 0.25) 100%);
                border-color: rgba(245, 158, 11, 0.6);
                box-shadow: 0 15px 40px rgba(245, 158, 11, 0.3);
            }

            .priority-low {
                background: linear-gradient(135deg, rgba(34, 197, 94, 0.2) 0%, rgba(21, 128, 61, 0.15) 100%);
                border-color: rgba(34, 197, 94, 0.4);
                color: #ffffff;
            }

            .priority-low .badge-icon {
                background: linear-gradient(135deg, #22c55e 0%, #15803d 100%);
                color: #ffffff;
                box-shadow: 0 4px 15px rgba(34, 197, 94, 0.4);
            }

            .priority-low-glow {
                background: linear-gradient(135deg, #22c55e 0%, #15803d 100%);
            }

            .priority-low:hover {
                background: linear-gradient(135deg, rgba(34, 197, 94, 0.3) 0%, rgba(21, 128, 61, 0.25) 100%);
                border-color: rgba(34, 197, 94, 0.6);
                box-shadow: 0 15px 40px rgba(34, 197, 94, 0.3);
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

            /* Glass Alert */
            .glass-alert {
                background: var(--glass-bg);
                backdrop-filter: blur(25px);
                border: 1px solid var(--glass-border);
                border-radius: 15px;
                padding: 1.5rem;
                display: flex;
                align-items: flex-start;
                gap: 1rem;
                position: relative;
            }

            .glass-alert-success {
                background: rgba(17, 153, 142, 0.1);
                border-color: rgba(17, 153, 142, 0.3);
            }

            .alert-icon {
                flex-shrink: 0;
                width: 40px;
                height: 40px;
                background: var(--gradient-success);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                color: var(--white);
                font-size: 1.2rem;
            }

            .alert-content {
                flex-grow: 1;
            }

            .alert-content strong {
                color: var(--white);
                font-family: 'Poppins', sans-serif;
                font-weight: 700;
                display: block;
                margin-bottom: 0.5rem;
            }

            .alert-content p {
                color: rgba(255, 255, 255, 0.8);
                margin: 0;
            }

            .alert-close {
                flex-shrink: 0;
                width: 30px;
                height: 30px;
                background: transparent;
                border: none;
                color: rgba(255, 255, 255, 0.6);
                cursor: pointer;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: all 0.3s ease;
            }

            .alert-close:hover {
                background: rgba(255, 255, 255, 0.1);
                color: var(--white);
            }

            /* Info Cards */
            .info-card {
                padding: 0;
                margin-bottom: 2rem;
            }

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

            .header-icon-bg.penyewa {
                background: var(--gradient-secondary);
            }

            .header-icon-bg.kos {
                background: var(--gradient-primary);
            }

            .header-icon-bg.message {
                background: var(--gradient-accent);
            }

            .header-icon-bg.reply {
                background: var(--gradient-success);
            }

            .header-icon-bg.form {
                background: var(--gradient-info);
            }

            .header-icon-bg.status {
                background: var(--gradient-primary);
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

            .user-avatar,
            .kos-status,
            .message-timestamp,
            .reply-status {
                flex-shrink: 0;
            }

            .user-avatar i {
                font-size: 2.5rem;
                color: rgba(255, 255, 255, 0.6);
            }

            .card-content {
                padding: 2rem;
            }

            /* Info Grid */
            .info-grid {
                display: grid;
                gap: 1.5rem;
            }

            .info-item {
                display: flex;
                flex-direction: column;
                gap: 0.5rem;
                padding: 1rem;
                background: var(--glass-bg);
                border: 1px solid var(--glass-border);
                border-radius: 15px;
                transition: all 0.3s ease;
            }

            .info-item:hover {
                background: var(--glass-bg-light);
                transform: translateY(-2px);
            }

            .info-label {
                color: rgba(255, 255, 255, 0.7);
                font-size: 0.9rem;
                font-weight: 600;
                display: flex;
                align-items: center;
            }

            .info-value {
                color: var(--white);
                font-size: 1rem;
                font-weight: 500;
            }

            .price-value {
                font-family: 'Poppins', sans-serif;
                font-weight: 700;
                font-size: 1.1rem;
                color: #4facfe;
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

            .status-text.available {
                color: #34d399;
                font-weight: 600;
            }

            .status-text.unavailable {
                color: #ef4444;
                font-weight: 600;
            }

            /* Message Bubbles */
            .message-bubble {
                background: var(--glass-bg);
                border: 1px solid var(--glass-border);
                border-radius: 20px;
                padding: 1.5rem;
                position: relative;
            }

            .original-message {
                border-left: 4px solid #f59e0b;
            }

            .reply-message {
                border-left: 4px solid #34d399;
            }

            .message-bubble p {
                color: var(--white);
                font-size: 1rem;
                line-height: 1.6;
                margin: 0;
            }

            /* Form Elements */
            .glass-label {
                color: var(--white);
                font-weight: 600;
                font-size: 0.95rem;
                margin-bottom: 0.75rem;
                display: block;
                font-family: 'Inter', sans-serif;
            }

            .glass-textarea-wrapper {
                position: relative;
            }

            .glass-textarea {
                background: var(--glass-bg);
                backdrop-filter: blur(20px);
                border: 1px solid var(--glass-border);
                border-radius: 15px;
                color: var(--white);
                padding: 1rem;
                font-size: 0.95rem;
                width: 100%;
                resize: vertical;
                min-height: 120px;
                transition: all 0.3s ease;
                font-family: 'Inter', sans-serif;
            }

            .glass-textarea:focus {
                background: var(--glass-bg-light);
                border-color: rgba(255, 255, 255, 0.5);
                box-shadow: 0 0 25px rgba(255, 255, 255, 0.2);
                color: var(--white);
                outline: none;
                transform: translateY(-2px);
            }

            .glass-textarea::placeholder {
                color: rgba(255, 255, 255, 0.6);
            }

            .character-count {
                position: absolute;
                bottom: 0.75rem;
                right: 1rem;
                font-size: 0.8rem;
                color: rgba(255, 255, 255, 0.6);
                background: var(--glass-bg);
                padding: 0.25rem 0.5rem;
                border-radius: 8px;
                backdrop-filter: blur(10px);
            }

            .glass-select-wrapper {
                position: relative;
                margin-bottom: 1rem;
            }

            .glass-select {
                background: var(--glass-bg);
                backdrop-filter: blur(20px);
                border: 1px solid var(--glass-border);
                border-radius: 15px;
                color: var(--white);
                padding: 1rem;
                font-size: 0.95rem;
                width: 100%;
                transition: all 0.3s ease;
                font-family: 'Inter', sans-serif;
                cursor: pointer;
                appearance: none;
                -webkit-appearance: none;
                -moz-appearance: none;
            }

            .glass-select:focus {
                background: var(--glass-bg-light);
                border-color: rgba(255, 255, 255, 0.5);
                box-shadow: 0 0 25px rgba(255, 255, 255, 0.2);
                color: var(--white);
                outline: none;
                transform: translateY(-2px);
            }

            .glass-select option {
                background: var(--dark-color);
                color: var(--white);
                padding: 0.5rem;
            }

            .select-icon {
                position: absolute;
                right: 1rem;
                top: 50%;
                transform: translateY(-50%);
                color: rgba(255, 255, 255, 0.6);
                font-size: 0.9rem;
                pointer-events: none;
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

            /* Error Messages */
            .glass-error {
                color: #fecaca;
                font-size: 0.85rem;
                font-weight: 500;
                margin-top: 0.5rem;
                padding: 0.5rem 0.75rem;
                background: rgba(239, 68, 68, 0.1);
                border: 1px solid rgba(239, 68, 68, 0.3);
                border-radius: 10px;
                display: flex;
                align-items: center;
            }

            /* Status Card */
            .status-card {
                padding: 0;
                position: sticky;
                top: 100px;
            }

            .current-status-section {
                margin-bottom: 2rem;
                padding-bottom: 2rem;
                border-bottom: 1px solid var(--glass-border);
            }

            .status-item {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 1.5rem;
                padding: 1rem;
                background: var(--glass-bg);
                border: 1px solid var(--glass-border);
                border-radius: 15px;
                transition: all 0.3s ease;
            }

            .status-item:hover {
                background: var(--glass-bg-light);
            }

            .status-label {
                color: rgba(255, 255, 255, 0.8);
                font-weight: 600;
                font-size: 0.9rem;
                display: flex;
                align-items: center;
            }

            .status-value {
                flex-shrink: 0;
            }

            .status-forms-section {
                margin-bottom: 2rem;
            }

            .status-form-group {
                margin-bottom: 2rem;
            }

            .form-section-title {
                color: var(--white);
                font-family: 'Poppins', sans-serif;
                font-size: 1rem;
                font-weight: 600;
                margin-bottom: 1rem;
                display: flex;
                align-items: center;
            }

            .form-group {
                margin-bottom: 1.5rem;
            }

            /* Quick Actions */
            .quick-actions-section {
                padding-top: 2rem;
                border-top: 1px solid var(--glass-border);
            }

            .quick-actions-grid {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 0.75rem;
            }

            .quick-action-btn {
                padding: 0.75rem;
                border-radius: 15px;
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 0.5rem;
                font-size: 0.85rem;
                transition: all 0.3s ease;
            }

            .quick-action-btn i {
                font-size: 1.2rem;
            }

            .quick-action-btn.whatsapp-btn:hover {
                background: rgba(37, 211, 102, 0.1);
                border-color: rgba(37, 211, 102, 0.3);
                color: #25d366;
            }

            .quick-action-btn span {
                font-size: 0.8rem;
                font-weight: 500;
            }

            /* Sticky Card */
            .sticky-card {
                position: sticky;
                top: 100px;
            }

            /* Form Actions */
            .form-actions {
                margin-top: 1.5rem;
            }

            .reply-btn {
                padding: 1rem 2rem;
                font-size: 1rem;
                min-width: 180px;
            }

            /* Loading State */
            .btn-loading {
                opacity: 0.8;
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

                .sticky-card {
                    position: static;
                }

                .quick-actions-grid {
                    grid-template-columns: 1fr;
                }

                .d-flex.justify-content-between {
                    flex-direction: column;
                    gap: 1rem;
                }

                .info-grid {
                    gap: 1rem;
                }

                .status-forms-section {
                    margin-bottom: 1.5rem;
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

                .message-bubble {
                    padding: 1rem;
                }

                .quick-action-btn {
                    padding: 0.5rem;
                    font-size: 0.8rem;
                }

                .quick-action-btn i {
                    font-size: 1rem;
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
            .glass-textarea:focus,
            .glass-select:focus,
            .glass-btn:focus,
            .enhanced-badge:focus {
                outline: 2px solid rgba(255, 255, 255, 0.5);
                outline-offset: 2px;
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            // Character Counter
            document.getElementById('balasan_pemilik').addEventListener('input', function () {
                const count = this.value.length;
                const counter = document.getElementById('charCount');
                counter.textContent = count;

                if (count > 500) {
                    counter.style.color = '#ef4444';
                } else if (count > 400) {
                    counter.style.color = '#f59e0b';
                } else {
                    counter.style.color = 'rgba(255, 255, 255, 0.6)';
                }
            });

            // Form Submission Loading State
            document.querySelector('.reply-form').addEventListener('submit', function () {
                const submitBtn = this.querySelector('.reply-btn');
                const btnText = submitBtn.querySelector('.btn-text');
                const btnLoading = submitBtn.querySelector('.btn-loading');

                btnText.style.display = 'none';
                btnLoading.style.display = 'inline-flex';
                submitBtn.disabled = true;
            });

            // Status Form Loading States
            document.querySelectorAll('.status-form').forEach(form => {
                form.addEventListener('submit', function () {
                    const submitBtn = this.querySelector('button[type="submit"]');
                    const originalText = submitBtn.innerHTML;

                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memperbarui...';
                    submitBtn.disabled = true;

                    // Re-enable after 5 seconds (in case of error)
                    setTimeout(() => {
                        submitBtn.innerHTML = originalText;
                        submitBtn.disabled = false;
                    }, 5000);
                });
            });

            // Auto-save draft functionality
            let autoSaveTimer;
            document.getElementById('balasan_pemilik').addEventListener('input', function () {
                clearTimeout(autoSaveTimer);
                autoSaveTimer = setTimeout(() => {
                    saveDraft(this.value);
                }, 2000);
            });

            function saveDraft(content) {
                const messageId = '{{ $message->id }}';
                // Note: localStorage not available in Claude.ai environment
                try {
                    localStorage.setItem(`reply_draft_${messageId}`, content);
                    console.log('Draft saved automatically');
                } catch (e) {
                    console.log('LocalStorage not available');
                }
            }

            // Load draft on page load
            window.addEventListener('load', function () {
                const messageId = '{{ $message->id }}';
                const textarea = document.getElementById('balasan_pemilik');

                try {
                    const draft = localStorage.getItem(`reply_draft_${messageId}`);
                    if (draft && !textarea.value) {
                        if (confirm('Ditemukan draft balasan yang belum terkirim. Ingin melanjutkan?')) {
                            textarea.value = draft;
                            // Update character count
                            document.getElementById('charCount').textContent = draft.length;
                        }
                    }
                } catch (e) {
                    console.log('LocalStorage not available');
                }
            });

            // Clear draft on successful submission
            document.querySelector('.reply-form').addEventListener('submit', function () {
                const messageId = '{{ $message->id }}';
                try {
                    localStorage.removeItem(`reply_draft_${messageId}`);
                } catch (e) {
                    console.log('LocalStorage not available');
                }
            });

            // Enhanced quick action interactions
            document.querySelectorAll('.quick-action-btn').forEach(btn => {
                btn.addEventListener('click', function (e) {
                    // Add click animation
                    this.style.transform = 'scale(0.95)';
                    setTimeout(() => {
                        this.style.transform = '';
                    }, 150);

                    // Track action (you can add analytics here)
                    const action = this.textContent.trim();
                    console.log(`Quick action clicked: ${action}`);
                });
            });

            // Enhanced badge interactions
            document.querySelectorAll('.enhanced-badge').forEach(badge => {
                badge.addEventListener('mouseenter', function () {
                    this.style.boxShadow = '0 20px 50px rgba(0, 0, 0, 0.3)';
                });

                badge.addEventListener('mouseleave', function () {
                    this.style.boxShadow = '';
                });
            });

            // Status change confirmation
            document.querySelectorAll('.glass-select').forEach(select => {
                const originalValue = select.value;

                select.addEventListener('change', function () {
                    const form = this.closest('form');
                    const submitBtn = form.querySelector('button[type="submit"]');

                    if (this.value !== originalValue) {
                        submitBtn.style.background = 'var(--gradient-accent)';
                        submitBtn.style.boxShadow = '0 4px 20px rgba(245, 158, 11, 0.4)';

                        // Add pulse animation
                        submitBtn.style.animation = 'pulse 2s infinite';
                    } else {
                        submitBtn.style.background = 'var(--gradient-primary)';
                        submitBtn.style.boxShadow = '0 4px 20px rgba(102, 126, 234, 0.4)';
                        submitBtn.style.animation = 'none';
                    }
                });
            });

            // Add pulse animation to CSS
            const pulseAnimation = `
                @keyframes pulse {
                    0%, 100% {
                        transform: scale(1);
                    }
                    50% {
                        transform: scale(1.05);
                    }
                }
            `;

            const style = document.createElement('style');
            style.textContent = pulseAnimation;
            document.head.appendChild(style);

            // WhatsApp link formatter
            document.querySelectorAll('a[href*="wa.me"]').forEach(link => {
                link.addEventListener('click', function (e) {
                    // Show confirmation before opening WhatsApp
                    if (!confirm('Membuka WhatsApp untuk menghubungi penyewa?')) {
                        e.preventDefault();
                    }
                });
            });

            // Copy contact info to clipboard
            document.querySelectorAll('.email-link, .phone-link').forEach(link => {
                link.addEventListener('contextmenu', function (e) {
                    e.preventDefault();
                    const text = this.textContent;
                    if (navigator.clipboard) {
                        navigator.clipboard.writeText(text).then(() => {
                            showNotification(`${text} disalin ke clipboard`, 'success');
                        });
                    } else {
                        // Fallback for browsers without clipboard API
                        const textArea = document.createElement('textarea');
                        textArea.value = text;
                        document.body.appendChild(textArea);
                        textArea.select();
                        document.execCommand('copy');
                        document.body.removeChild(textArea);
                        showNotification(`${text} disalin ke clipboard`, 'success');
                    }
                });
            });

            // Notification system
            function showNotification(message, type = 'info') {
                // Remove existing notification
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

                .notification-info {
                    border-color: rgba(59, 130, 246, 0.3);
                    background: rgba(59, 130, 246, 0.1);
                }
            `;

            const styleSheet = document.createElement('style');
            styleSheet.textContent = notificationStyles;
            document.head.appendChild(styleSheet);

            // Keyboard shortcuts
            document.addEventListener('keydown', function (e) {
                if (e.ctrlKey || e.metaKey) {
                    switch (e.key) {
                        case 's':
                            e.preventDefault();
                            const textarea = document.getElementById('balasan_pemilik');
                            saveDraft(textarea.value);
                            showNotification('Draft tersimpan', 'success');
                            break;
                        case 'Enter':
                            if (e.shiftKey) {
                                // Allow Shift+Enter for new line
                                return;
                            }
                            e.preventDefault();
                            document.querySelector('.reply-form').submit();
                            break;
                    }
                }
            });

            // Add ripple effect to buttons and badges
            document.querySelectorAll('.glass-btn, .enhanced-badge').forEach(element => {
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

            // Performance optimization: Intersection Observer for animations
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

            // Observe all cards for entrance animations
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

                .enhanced-badge {
                    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                }
            `;

            const entranceStyleSheet = document.createElement('style');
            entranceStyleSheet.textContent = entranceStyles;
            document.head.appendChild(entranceStyleSheet);

            // Textarea auto-resize
            const textarea = document.getElementById('balasan_pemilik');
            if (textarea) {
                textarea.addEventListener('input', function () {
                    this.style.height = 'auto';
                    this.style.height = (this.scrollHeight) + 'px';
                });
            }

            // Status badge tooltip functionality
            document.querySelectorAll('.enhanced-badge').forEach(badge => {
                badge.setAttribute('title', badge.querySelector('.badge-title').textContent + ' - ' + badge.querySelector('.badge-subtitle').textContent);
            });

            // Enhanced form validation
            document.querySelector('.reply-form').addEventListener('submit', function (e) {
                const textarea = document.getElementById('balasan_pemilik');
                const value = textarea.value.trim();

                if (value.length === 0) {
                    e.preventDefault();
                    showNotification('Balasan tidak boleh kosong', 'info');
                    textarea.focus();
                    return;
                }

                if (value.length > 500) {
                    e.preventDefault();
                    showNotification('Balasan terlalu panjang (maksimal 500 karakter)', 'info');
                    textarea.focus();
                    return;
                }
            });

            // Initialize tooltips and animations
            window.addEventListener('load', function () {
                // Trigger entrance animations after a short delay
                setTimeout(() => {
                    document.querySelectorAll('.glass-card').forEach(card => {
                        card.classList.add('visible');
                    });
                }, 300);

                // Show welcome notification
                setTimeout(() => {
                    showNotification('Detail pesan dimuat', 'success');
                }, 1000);
            });

            console.log('Enhanced Detail Messages Interface Loaded Successfully!');
        </script>
    @endpush
@endsection
