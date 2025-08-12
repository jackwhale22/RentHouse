@extends('layouts.app')

@section('title', $kos->nama_kos . ' - Kos Finder')

@section('content')
    <div class="container-fluid glassmorphism-detail">
        <div class="container py-5">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="glass-breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">
                            <i class="fas fa-tachometer-alt me-1"></i>Dashboard
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('search') }}">
                            <i class="fas fa-search me-1"></i>Cari Kos
                        </a>
                    </li>
                    <li class="breadcrumb-item active">{{ $kos->nama_kos }}</li>
                </ol>
            </nav>

            <div class="row g-4">
                <!-- Kos Details -->
                <div class="col-lg-8">
                    <div class="glass-card main-card">
                        <!-- Kos Image -->
                        <!-- Kos Image -->
                        <div class="kos-image-hero">
                            @if($kos->mainPhoto)
                                <img src="{{ asset($kos->mainPhoto->foto_path) }}" class="hero-image" alt="{{ $kos->nama_kos }}">
                            @else
                                <div class="hero-image-placeholder">
                                    <i class="fas fa-home"></i>
                                </div>
                            @endif

                            <div class="hero-overlay">
                                <div class="hero-badges">
                                    <span class="verified-badge">
                                        <i class="fas fa-check-circle me-1"></i>Terverifikasi
                                    </span>
                                </div>
                                <div class="hero-price">
                                    <span class="price-amount">Rp {{ number_format($kos->harga, 0, ',', '.') }}</span>
                                    <span class="price-period">/bulan</span>
                                </div>
                            </div>
                        </div>

                        <!-- Photo Gallery -->
                        @if($kos->photos && $kos->photos->where('is_main', 0)->count() > 0)
                        <div class="photo-gallery">
                            <div class="photos-grid">
                                @foreach($kos->photos->where('is_main', 0)->take(4) as $photo)
                                    <div class="gallery-item">
                                        <img src="{{ asset($photo->foto_path) }}" 
                                             alt="Foto {{ $kos->nama_kos }}"
                                             class="gallery-image"
                                             onclick="showFullImage('{{ asset($photo->foto_path) }}', '{{ $kos->nama_kos }}')">
                                    </div>
                                @endforeach
                            </div>
                            @if($kos->photos->where('is_main', 0)->count() > 4)
                                <div class="more-photos">
                                    <span>+{{ $kos->photos->where('is_main', 0)->count() - 4 }} foto lainnya</span>
                                </div>
                            @endif
                        </div>
                        @endif                        <!-- Kos Content -->
                        <div class="kos-main-content">
                            <div class="kos-header mb-4">
                                <h1 class="kos-title">{{ $kos->nama_kos }}</h1>
                                <div class="kos-meta">
                                    <span class="meta-item">
                                        <i class="fas fa-calendar-alt me-2"></i>
                                        Dipublikasi {{ $kos->created_at->format('d F Y') }}
                                    </span>
                                    <span class="meta-divider">•</span>
                                    <span class="meta-item">
                                        {{ $kos->created_at->diffForHumans() }}
                                    </span>
                                </div>
                            </div>

                            <!-- Location Section -->
                            <div class="detail-section">
                                <div class="section-header">
                                    <div class="section-icon location">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <h6 class="section-title">Lokasi</h6>
                                </div>
                                <div class="section-content">
                                    <p class="location-text">{{ $kos->lokasi }}</p>
                                </div>
                            </div>

                            <!-- Facilities Section -->
                            @if($kos->fasilitas)
                                <div class="detail-section">
                                    <div class="section-header">
                                        <div class="section-icon facilities">
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <h6 class="section-title">Fasilitas</h6>
                                    </div>
                                    <div class="section-content">
                                        @php
                                            $facilities = explode(',', $kos->fasilitas);
                                        @endphp
                                        <div class="facilities-grid">
                                            @foreach($facilities as $facility)
                                                <div class="facility-item">
                                                    <i class="fas fa-check-circle facility-check"></i>
                                                    <span>{{ trim($facility) }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Description Section -->
                            @if($kos->deskripsi)
                                <div class="detail-section">
                                    <div class="section-header">
                                        <div class="section-icon description">
                                            <i class="fas fa-info-circle"></i>
                                        </div>
                                        <h6 class="section-title">Deskripsi</h6>
                                    </div>
                                    <div class="section-content">
                                        <p class="description-text">{{ $kos->deskripsi }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Owner Info & Contact -->
                <div class="col-lg-4">
                    <!-- Owner Card -->
                    <div class="glass-card owner-card sticky-card">
                        <div class="owner-header">
                            <div class="owner-icon">
                                <i class="fas fa-user"></i>
                            </div>
                            <h5 class="card-title">Hubungi Pemilik</h5>
                        </div>

                        <div class="owner-profile">
                            <div class="owner-avatar">
                                <i class="fas fa-user-circle"></i>
                            </div>
                            <div class="owner-info">
                                <h6 class="owner-name">{{ $kos->pemilik->name }}</h6>
                                <span class="owner-badge">Pemilik Kos</span>
                            </div>
                        </div>

                        <div class="contact-info">
                            <div class="contact-item">
                                <i class="fas fa-envelope contact-icon"></i>
                                <span class="contact-text">{{ $kos->pemilik->email }}</span>
                            </div>
                            @if($kos->pemilik->phone)
                                <div class="contact-item">
                                    <i class="fas fa-phone contact-icon"></i>
                                    <span class="contact-text">{{ $kos->pemilik->phone }}</span>
                                </div>
                            @endif
                        </div>

                        @php
                            $existingContact = \App\Models\Transaksi::where('kos_id', $kos->id)
                                ->where('penyewa_id', auth()->id())
                                ->first();
                        @endphp

                        @if($existingContact)
                            <div class="contact-status">
                                <div class="status-icon">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div class="status-content">
                                    <strong>Sudah Menghubungi</strong>
                                    <p>Anda menghubungi pemilik pada {{ $existingContact->created_at->format('d M Y') }}</p>
                                    <div class="status-badge-wrapper">
                                        Status:
                                        <span class="status-badge status-{{ $existingContact->status_transaksi }}">
                                            {{ ucfirst($existingContact->status_transaksi) }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            @if($existingContact->status_transaksi == 'pending')
                                <form action="{{ route('transaksi.cancel', $existingContact->id) }}" method="POST"
                                    class="cancel-form">
                                    @csrf
                                    <button type="submit" class="glass-btn glass-btn-danger w-100"
                                        onclick="return confirm('Apakah Anda yakin ingin membatalkan kontak ini?')">
                                        <i class="fas fa-times me-2"></i>Batalkan Kontak
                                    </button>
                                </form>
                            @endif
                        @else
                            <form action="{{ route('kos.contact', $kos->id) }}" method="POST" class="contact-form">
                                @csrf
                                <div class="form-group">
                                    <label for="catatan" class="glass-label">
                                        <i class="fas fa-comment-dots me-2"></i>Pesan (Opsional)
                                    </label>
                                    <textarea class="glass-textarea" id="catatan" name="catatan" rows="3"
                                        placeholder="Halo, saya tertarik dengan kos Anda..."></textarea>
                                </div>

                                <button type="submit" class="glass-btn glass-btn-primary contact-btn w-100">
                                    <i class="fas fa-paper-plane me-2"></i>Hubungi Pemilik
                                </button>
                            </form>

                            <div class="contact-notice">
                                <div class="notice-icon">
                                    <i class="fas fa-info-circle"></i>
                                </div>
                                <div class="notice-content">
                                    <small>Dengan menghubungi pemilik, informasi Anda akan dibagikan kepada mereka.</small>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Quick Actions -->
                    <div class="glass-card quick-actions-card">
                        <h6 class="card-title">
                            <i class="fas fa-bolt me-2"></i>Aksi Cepat
                        </h6>
                        <div class="quick-actions">
                            <a href="{{ route('search') }}" class="glass-btn glass-btn-outline w-100 mb-2">
                                <i class="fas fa-search me-2"></i>Cari Kos Lainnya
                            </a>
                            <a href="{{ route('my-transaksi') }}" class="glass-btn glass-btn-outline w-100">
                                <i class="fas fa-list me-2"></i>Kontak Saya
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Map Section -->
            @if($kos->latitude && $kos->longitude)
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="glass-card">
                            <div class="card-body">
                                <h5 class="section-title mb-3">
                                    <i class="fas fa-map-marker-alt section-icon location"></i>
                                    Lokasi pada Peta
                                </h5>
                                <div id="map" style="height: 400px;" class="rounded"></div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Similar Kos -->
            @php
                $similarKos = \App\Models\Kos::verified()->available()
                    ->where('id', '!=', $kos->id)
                    ->where('lokasi', 'like', '%' . explode(',', $kos->lokasi)[0] . '%')
                    ->take(3)
                    ->get();
            @endphp

            @if($similarKos->count() > 0)
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="section-header-large mb-4">
                            <h4 class="section-title-large">
                                <span class="gradient-text">Kos Serupa</span> di Area Ini
                            </h4>
                            <p class="section-subtitle-large">Temukan pilihan lain yang mungkin Anda sukai</p>
                        </div>
                    </div>
                </div>

                <div class="row g-4">
                    @foreach($similarKos as $similar)
                        <div class="col-lg-4">
                            <div class="glass-card similar-card h-100">
                                <div class="similar-image-container">
                                    @if($similar->foto)
                                        <img src="{{ asset($similar->foto) }}" class="similar-image" alt="{{ $similar->nama_kos }}">
                                    @else
                                        <div class="similar-image-placeholder">
                                            <i class="fas fa-home"></i>
                                        </div>
                                    @endif

                                    <div class="similar-overlay">
                                        <div class="similar-price">
                                            <span class="price-amount">Rp {{ number_format($similar->harga, 0, ',', '.') }}</span>
                                            <span class="price-period">/bulan</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="similar-content">
                                    <h6 class="similar-title">{{ $similar->nama_kos }}</h6>
                                    <div class="similar-location">
                                        <i class="fas fa-map-marker-alt me-2"></i>
                                        <span>{{ Str::limit($similar->lokasi, 30) }}</span>
                                    </div>
                                </div>

                                <div class="similar-footer">
                                    <a href="{{ route('kos.show', $similar->id) }}" class="glass-btn glass-btn-primary w-100">
                                        <i class="fas fa-eye me-2"></i>Lihat Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
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
                --gradient-danger: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);
                --gradient-background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #4facfe 100%);
            }

            .glassmorphism-detail {
                background: var(--gradient-background);
                min-height: 100vh;
                position: relative;
                overflow-x: hidden;
            }

            .glassmorphism-detail::before {
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

            /* Breadcrumb */
            .glass-breadcrumb {
                background: var(--glass-bg);
                backdrop-filter: blur(15px);
                border: 1px solid var(--glass-border);
                border-radius: 50px;
                padding: 0.75rem 1.5rem;
                margin: 0;
                display: flex;
                flex-wrap: wrap;
                list-style: none;
            }

            .glass-breadcrumb .breadcrumb-item {
                display: flex;
                align-items: center;
            }

            .glass-breadcrumb .breadcrumb-item+.breadcrumb-item::before {
                content: "›";
                color: rgba(255, 255, 255, 0.6);
                padding: 0 0.75rem;
                font-weight: 600;
            }

            .glass-breadcrumb .breadcrumb-item a {
                color: rgba(255, 255, 255, 0.8);
                text-decoration: none;
                transition: all 0.3s ease;
                font-weight: 500;
            }

            .glass-breadcrumb .breadcrumb-item a:hover {
                color: var(--white);
                transform: translateX(3px);
            }

            .glass-breadcrumb .breadcrumb-item.active {
                color: var(--white);
                font-weight: 600;
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
            /* Map Styles */
            .map-section {
                margin-top: 2rem;
            }
            .map-container {
                border-radius: 15px;
                overflow: hidden;
                position: relative;
            }
            .map-container #map {
                width: 100%;
                height: 400px;
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

            /* Main Card */
            .main-card {
                padding: 0;
                overflow: hidden;
            }

            .kos-image-hero {
                position: relative;
                height: 450px;
                overflow: hidden;
            }

            .hero-image {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: transform 0.6s ease;
            }

            .main-card:hover .hero-image {
                transform: scale(1.05);
            }

            .hero-image-placeholder {
                width: 100%;
                height: 100%;
                background: var(--gradient-primary);
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 6rem;
                color: var(--white);
            }

            .hero-overlay {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: linear-gradient(to bottom, rgba(0, 0, 0, 0.3) 0%, transparent 50%, rgba(0, 0, 0, 0.7) 100%);
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                padding: 2rem;
            }

            .hero-badges {
                display: flex;
                justify-content: flex-start;
            }

            .verified-badge {
                background: var(--gradient-success);
                color: var(--white);
                padding: 0.5rem 1rem;
                border-radius: 25px;
                font-size: 0.9rem;
                font-weight: 600;
                box-shadow: 0 4px 15px rgba(17, 153, 142, 0.4);
            }

            .hero-price {
                text-align: right;
                margin-top: auto;
            }

            .price-amount {
                display: block;
                font-size: 2.5rem;
                font-weight: 900;
                color: var(--white);
                text-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
                font-family: 'Poppins', sans-serif;
                line-height: 1;
            }

            .price-period {
                color: rgba(255, 255, 255, 0.9);
                font-size: 1.1rem;
                font-weight: 500;
            }

            /* Kos Content */
            .kos-main-content {
                padding: 3rem;
            }

            .kos-header {
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
                padding-bottom: 2rem;
            }

            .kos-title {
                font-family: 'Poppins', sans-serif;
                font-size: 2.5rem;
                font-weight: 800;
                color: var(--white);
                margin-bottom: 1rem;
                line-height: 1.2;
            }

            .kos-meta {
                display: flex;
                align-items: center;
                gap: 0.75rem;
                color: rgba(255, 255, 255, 0.7);
                font-size: 0.95rem;
            }

            .meta-item {
                display: flex;
                align-items: center;
            }

            .meta-divider {
                color: rgba(255, 255, 255, 0.4);
                font-weight: 600;
            }

            /* Detail Sections */
            .detail-section {
                margin-bottom: 2.5rem;
                padding-bottom: 2rem;
                border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            }

            .detail-section:last-child {
                border-bottom: none;
                margin-bottom: 0;
            }

            .section-header {
                display: flex;
                align-items: center;
                margin-bottom: 1.5rem;
            }

            .section-icon {
                width: 50px;
                height: 50px;
                border-radius: 15px;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-right: 1rem;
                font-size: 1.3rem;
                color: var(--white);
            }

            .section-icon.location {
                background: var(--gradient-primary);
            }

            .section-icon.facilities {
                background: var(--gradient-success);
            }

            .section-icon.description {
                background: var(--gradient-secondary);
            }

            .section-title {
                font-family: 'Poppins', sans-serif;
                font-size: 1.4rem;
                font-weight: 700;
                color: var(--white);
                margin: 0;
            }

            .section-content {
                margin-left: 66px;
            }

            .location-text,
            .description-text {
                color: rgba(255, 255, 255, 0.9);
                font-size: 1.1rem;
                line-height: 1.6;
                margin: 0;
            }

            /* Facilities Grid */
            .facilities-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                gap: 1rem;
            }

            .facility-item {
                display: flex;
                align-items: center;
                background: var(--glass-bg);
                border: 1px solid var(--glass-border);
                border-radius: 15px;
                padding: 1rem;
                transition: all 0.3s ease;
            }

            .facility-item:hover {
                background: var(--glass-bg-light);
                transform: translateX(5px);
            }

            .facility-check {
                color: #34d399;
                margin-right: 0.75rem;
                flex-shrink: 0;
            }

            .facility-item span {
                color: rgba(255, 255, 255, 0.9);
                font-weight: 500;
            }

            /* Owner Card */
            .owner-card {
                padding: 2.5rem;
                position: sticky;
                top: 100px;
            }

            .owner-header {
                display: flex;
                align-items: center;
                margin-bottom: 2rem;
                padding-bottom: 1rem;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            }

            .owner-icon {
                width: 50px;
                height: 50px;
                background: var(--gradient-primary);
                border-radius: 15px;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-right: 1rem;
                font-size: 1.3rem;
                color: var(--white);
            }

            .card-title {
                font-family: 'Poppins', sans-serif;
                font-size: 1.3rem;
                font-weight: 700;
                color: var(--white);
                margin: 0;
            }

            .owner-profile {
                display: flex;
                align-items: center;
                margin-bottom: 2rem;
            }

            .owner-avatar {
                width: 60px;
                height: 60px;
                background: var(--gradient-secondary);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-right: 1rem;
                font-size: 1.8rem;
                color: var(--white);
            }

            .owner-name {
                font-family: 'Poppins', sans-serif;
                font-size: 1.2rem;
                font-weight: 700;
                color: var(--white);
                margin-bottom: 0.25rem;
            }

            .owner-badge {
                background: var(--gradient-success);
                color: var(--white);
                padding: 0.25rem 0.75rem;
                border-radius: 15px;
                font-size: 0.8rem;
                font-weight: 600;
            }

            /* Contact Info */
            .contact-info {
                margin-bottom: 2rem;
            }

            .contact-item {
                display: flex;
                align-items: center;
                margin-bottom: 1rem;
                padding: 0.75rem;
                background: var(--glass-bg);
                border: 1px solid var(--glass-border);
                border-radius: 12px;
            }

            .contact-icon {
                color: rgba(255, 255, 255, 0.6);
                margin-right: 0.75rem;
                width: 20px;
                flex-shrink: 0;
            }

            .contact-text {
                color: rgba(255, 255, 255, 0.9);
                font-weight: 500;
                word-break: break-all;
            }

            /* Glass Form Elements */
            .glass-label {
                color: var(--white);
                font-weight: 600;
                font-size: 0.95rem;
                margin-bottom: 0.75rem;
                display: block;
            }

            .glass-textarea {
                background: var(--glass-bg);
                backdrop-filter: blur(15px);
                border: 1px solid var(--glass-border);
                border-radius: 15px;
                color: var(--white);
                padding: 1rem;
                font-size: 0.95rem;
                width: 100%;
                resize: vertical;
                min-height: 100px;
                transition: all 0.3s ease;
                font-family: 'Inter', sans-serif;
            }

            .glass-textarea:focus {
                background: var(--glass-bg-light);
                border-color: rgba(255, 255, 255, 0.5);
                box-shadow: 0 0 20px rgba(255, 255, 255, 0.2);
                color: var(--white);
                outline: none;
            }

            .glass-textarea::placeholder {
                color: rgba(255, 255, 255, 0.6);
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

            .contact-btn {
                padding: 1rem 2rem;
                font-size: 1.1rem;
                font-weight: 700;
            }

            /* Contact Status */
            .contact-status {
                background: var(--glass-bg-light);
                border: 1px solid var(--glass-border);
                border-radius: 15px;
                padding: 1.5rem;
                margin-bottom: 2rem;
                display: flex;
                align-items: flex-start;
            }

            .status-icon {
                width: 40px;
                height: 40px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-right: 1rem;
                flex-shrink: 0;
                font-size: 1.1rem;
                color: var(--white);
                background: var(--gradient-success);
            }

            .status-content {
                flex-grow: 1;
            }

            .status-content strong {
                color: var(--white);
                font-family: 'Poppins', sans-serif;
                font-weight: 700;
                display: block;
                margin-bottom: 0.5rem;
            }

            .status-content p {
                color: rgba(255, 255, 255, 0.8);
                margin: 0;
                line-height: 1.5;
            }

            .status-badge-wrapper {
                margin-top: 0.75rem;
                color: rgba(255, 255, 255, 0.8);
            }

            .status-badge {
                padding: 0.25rem 0.75rem;
                border-radius: 12px;
                font-size: 0.8rem;
                font-weight: 600;
                color: var(--white);
            }

            .status-badge.status-pending {
                background: var(--gradient-accent);
            }

            .status-badge.status-selesai {
                background: var(--gradient-success);
            }

            .status-badge.status-dibatalkan {
                background: var(--gradient-danger);
            }

            /* Contact Notice */
            .contact-notice {
                background: var(--glass-bg-light);
                border: 1px solid var(--glass-border);
                border-radius: 15px;
                padding: 1rem;
                margin-top: 1rem;
                display: flex;
                align-items: flex-start;
            }

            .notice-icon {
                width: 30px;
                height: 30px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-right: 0.75rem;
                flex-shrink: 0;
                font-size: 0.9rem;
                color: var(--white);
                background: var(--gradient-secondary);
            }

            .notice-content {
                flex-grow: 1;
            }

            .notice-content small {
                color: rgba(255, 255, 255, 0.8);
                line-height: 1.4;
            }

            /* Quick Actions */
            .quick-actions-card {
                padding: 2rem;
                margin-top: 1.5rem;
            }

            .quick-actions {
                display: flex;
                flex-direction: column;
            }

            /* Section Headers */
            .section-header-large {
                text-align: center;
                margin-bottom: 3rem;
            }

            .section-title-large {
                font-family: 'Poppins', sans-serif;
                font-size: clamp(2rem, 4vw, 2.5rem);
                font-weight: 800;
                color: var(--white);
                margin-bottom: 1rem;
            }

            .gradient-text {
                background: var(--gradient-secondary);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            .section-subtitle-large {
                color: rgba(255, 255, 255, 0.8);
                font-size: 1.1rem;
                margin: 0;
            }

            /* Similar Kos Cards */
            .similar-card {
                padding: 0;
                overflow: hidden;
                transition: all 0.4s ease;
            }

            .similar-card:hover {
                transform: translateY(-8px) scale(1.02);
                box-shadow: var(--glass-shadow-hover);
            }

            .similar-image-container {
                position: relative;
                height: 220px;
                overflow: hidden;
            }

            .similar-image {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: transform 0.4s ease;
            }

            .similar-card:hover .similar-image {
                transform: scale(1.1);
            }

            .similar-image-placeholder {
                width: 100%;
                height: 100%;
                background: var(--gradient-primary);
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 3rem;
                color: var(--white);
            }

            .similar-overlay {
                position: absolute;
                bottom: 0;
                right: 0;
                padding: 1rem;
                background: linear-gradient(to top left, rgba(0, 0, 0, 0.7), transparent);
            }

            .similar-price .price-amount {
                font-size: 1.3rem;
                font-weight: 800;
                color: var(--white);
                text-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
                font-family: 'Poppins', sans-serif;
                line-height: 1;
            }

            .similar-price .price-period {
                font-size: 0.8rem;
                color: rgba(255, 255, 255, 0.9);
            }

            .similar-content {
                padding: 1.5rem;
            }

            .similar-title {
                font-family: 'Poppins', sans-serif;
                font-size: 1.1rem;
                font-weight: 700;
                color: var(--white);
                margin-bottom: 0.75rem;
            }

            .similar-location {
                color: rgba(255, 255, 255, 0.8);
                font-size: 0.9rem;
                display: flex;
                align-items: center;
            }

            .similar-location i {
                color: rgba(255, 255, 255, 0.6);
                width: 16px;
            }

            .similar-footer {
                padding: 0 1.5rem 1.5rem;
            }

            /* Photo Gallery */
            .photo-gallery {
                padding: 1.5rem;
                background: var(--glass-bg-dark);
            }

            .photos-grid {
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                gap: 1rem;
            }

            .gallery-item {
                position: relative;
                padding-bottom: 75%; /* 4:3 aspect ratio */
                overflow: hidden;
                border-radius: 12px;
                cursor: pointer;
                transition: transform 0.3s ease;
            }

            .gallery-item:hover {
                transform: scale(1.05);
            }

            .gallery-image {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .more-photos {
                margin-top: 1rem;
                text-align: center;
                color: var(--white);
                font-weight: 600;
                padding: 0.5rem;
                background: var(--glass-bg);
                border-radius: 8px;
            }

            /* Modal Styles */
            .photo-modal {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.9);
                z-index: 9999;
                padding: 2rem;
                overflow: auto;
            }

            .modal-content {
                position: relative;
                max-width: 90%;
                margin: 0 auto;
                text-align: center;
            }

            .modal-image {
                max-width: 100%;
                max-height: 90vh;
                margin: 0 auto;
                border-radius: 8px;
                box-shadow: 0 0 30px rgba(0, 0, 0, 0.5);
            }

            .close-modal {
                position: absolute;
                top: 1rem;
                right: 1rem;
                background: rgba(255, 255, 255, 0.2);
                border: none;
                color: white;
                width: 40px;
                height: 40px;
                border-radius: 50%;
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: all 0.3s ease;
            }

            .close-modal:hover {
                background: rgba(255, 255, 255, 0.3);
                transform: scale(1.1);
            }

            .modal-caption {
                color: white;
                margin-top: 1rem;
                font-size: 1.1rem;
            }

            /* Form Group */
            .form-group {
                margin-bottom: 1.5rem;
            }

            .contact-form {
                margin-bottom: 1.5rem;
            }

            .cancel-form {
                margin-top: 1rem;
            }

            /* Responsive Design */
            @media (max-width: 768px) {
                .glassmorphism-detail .container {
                    padding-left: 1rem;
                    padding-right: 1rem;
                }

                .kos-main-content {
                    padding: 2rem;
                }

                .kos-title {
                    font-size: 2rem;
                }

                .price-amount {
                    font-size: 2rem;
                }

                .hero-overlay {
                    padding: 1.5rem;
                }

                .section-content {
                    margin-left: 0;
                    margin-top: 1rem;
                }

                .section-header {
                    flex-direction: column;
                    align-items: flex-start;
                    gap: 0.5rem;
                }

                .section-icon {
                    margin-right: 0;
                }

                .facilities-grid {
                    grid-template-columns: 1fr;
                }

                .owner-card {
                    padding: 2rem;
                    position: static;
                }

                .kos-image-hero {
                    height: 300px;
                }

                .owner-profile {
                    flex-direction: column;
                    text-align: center;
                    gap: 1rem;
                }

                .owner-avatar {
                    margin-right: 0;
                }

                .glass-breadcrumb {
                    padding: 0.5rem 1rem;
                    font-size: 0.9rem;
                }
            }

            @media (max-width: 576px) {
                .kos-main-content {
                    padding: 1.5rem;
                }

                .owner-card,
                .quick-actions-card {
                    padding: 1.5rem;
                }

                .similar-content {
                    padding: 1rem;
                }

                .similar-footer {
                    padding: 0 1rem 1rem;
                }

                .glass-breadcrumb {
                    flex-direction: column;
                    align-items: flex-start;
                    gap: 0.5rem;
                }

                .glass-breadcrumb .breadcrumb-item+.breadcrumb-item::before {
                    display: none;
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

    <!-- Photo Modal -->
    <div id="photoModal" class="photo-modal">
        <button class="close-modal" onclick="closeModal()">
            <i class="fas fa-times"></i>
        </button>
        <div class="modal-content">
            <img id="modalImage" class="modal-image" src="" alt="">
            <div id="modalCaption" class="modal-caption"></div>
        </div>
    </div>

    @push('scripts')
    <!-- Leaflet JS -->
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        @if($kos->latitude && $kos->longitude)
            // Initialize map
            const map = L.map('map').setView([{{ $kos->latitude }}, {{ $kos->longitude }}], 15);

            // Add tile layer (OpenStreetMap)
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            // Add marker for kos location
            const marker = L.marker([{{ $kos->latitude }}, {{ $kos->longitude }}])
                .addTo(map)
                .bindPopup("<strong>{{ $kos->nama_kos }}</strong><br>{{ $kos->lokasi }}")
                .openPopup();

            // Make map responsive
            window.addEventListener('resize', function() {
                map.invalidateSize();
            });
        @endif
    });
</script>
        <script>
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

            // Form loading states
            document.querySelectorAll('.contact-form, .cancel-form').forEach(form => {
                form.addEventListener('submit', function () {
                    const submitBtn = this.querySelector('button[type="submit"]');
                    const originalHtml = submitBtn.innerHTML;

                    if (this.classList.contains('contact-form')) {
                        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Mengirim...';
                    } else {
                        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Membatalkan...';
                    }

                    submitBtn.disabled = true;

                    // Re-enable button after 5 seconds (in case of error)
                    setTimeout(() => {
                        submitBtn.innerHTML = originalHtml;
                        submitBtn.disabled = false;
                    }, 5000);
                });
            });

            // Enhanced card interactions
            document.querySelectorAll('.similar-card').forEach(card => {
                card.addEventListener('mouseenter', function () {
                    this.style.boxShadow = '0 25px 50px rgba(255, 255, 255, 0.15)';
                });

                card.addEventListener('mouseleave', function () {
                    this.style.boxShadow = '';
                });
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

            // Photo Modal Functions
            window.showFullImage = function(src, caption) {
                const modal = document.getElementById('photoModal');
                const modalImg = document.getElementById('modalImage');
                const modalCaption = document.getElementById('modalCaption');
                
                modal.style.display = 'block';
                modalImg.src = src;
                modalCaption.textContent = caption;
                
                document.body.style.overflow = 'hidden';
            }

            window.closeModal = function() {
                const modal = document.getElementById('photoModal');
                modal.style.display = 'none';
                document.body.style.overflow = 'auto';
            }

            // Close modal when clicking outside the image
            document.getElementById('photoModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeModal();
                }
            });

            // Close modal with escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeModal();
                }
            });
        </script>
    @endpush
@endsection