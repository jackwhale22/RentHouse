@extends('layouts.app')

@section('title', 'Cari Kos - Kos Finder')

@section('content')
    <div class="container-fluid glassmorphism-browse">
        <div class="container py-5">
            <!-- Page Header -->
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h1 class="page-title mb-3">
                        <span class="gradient-text">Cari</span> Kos Impian Anda
                    </h1>
                    <p class="page-subtitle">Temukan kos yang sesuai dengan kebutuhan dan budget Anda</p>
                </div>
            </div>

            <!-- Search Filters -->
            <div class="row mb-5">
                <div class="col-12">
                    <div class="glass-card filter-card">
                        <div class="card-icon">
                            <i class="fas fa-filter"></i>
                        </div>
                        <h5 class="card-title mb-4">
                            <i class="fas fa-search me-2"></i>Filter Pencarian
                        </h5>

                        <form method="GET" action="{{ route('search') }}" class="filter-form">
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <div class="glass-input-group">
                                        <label for="search" class="glass-label">
                                            <i class="fas fa-search me-2"></i>Pencarian
                                        </label>
                                        <input type="text" class="glass-input" id="search" name="search"
                                            value="{{ request('search') }}" placeholder="Nama kos atau lokasi...">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="glass-input-group">
                                        <label for="lokasi" class="glass-label">
                                            <i class="fas fa-map-marker-alt me-2"></i>Lokasi
                                        </label>
                                        <input type="text" class="glass-input" id="lokasi" name="lokasi"
                                            value="{{ request('lokasi') }}" placeholder="Lokasi spesifik...">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="glass-input-group">
                                        <label for="min_price" class="glass-label">
                                            <i class="fas fa-money-bill-wave me-2"></i>Harga Min
                                        </label>
                                        <input type="number" class="glass-input" id="min_price" name="min_price"
                                            value="{{ request('min_price') }}" placeholder="0" step="100000">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="glass-input-group">
                                        <label for="max_price" class="glass-label">
                                            <i class="fas fa-money-bill-wave me-2"></i>Harga Max
                                        </label>
                                        <input type="number" class="glass-input" id="max_price" name="max_price"
                                            value="{{ request('max_price') }}" placeholder="10.000.000" step="100000">
                                    </div>
                                </div>

                                <div class="col-md-1">
                                    <div class="glass-input-group">
                                        <label class="glass-label">&nbsp;</label>
                                        <div class="d-grid">
                                            <button type="submit" class="glass-btn glass-btn-primary search-btn">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if(request()->hasAny(['search', 'lokasi', 'min_price', 'max_price']))
                                <div class="mt-4 text-center">
                                    <a href="{{ route('search') }}" class="glass-btn glass-btn-outline">
                                        <i class="fas fa-times me-2"></i>Hapus Filter
                                    </a>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>

            <!-- Search Results Header -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="glass-card results-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="results-title mb-1">
                                    @if(request()->hasAny(['search', 'lokasi', 'min_price', 'max_price']))
                                        <i class="fas fa-search-plus me-2"></i>Hasil Pencarian
                                        <span class="badge glass-badge ms-2">{{ $kosList->total() }} ditemukan</span>
                                    @else
                                        <i class="fas fa-home me-2"></i>Semua Kos Tersedia
                                        <span class="badge glass-badge ms-2">{{ $kosList->total() }} kos</span>
                                    @endif
                                </h5>
                            </div>

                            @if($kosList->total() > 0)
                                <div class="results-info">
                                    <small class="text-info">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Menampilkan {{ $kosList->firstItem() }}-{{ $kosList->lastItem() }} dari
                                        {{ $kosList->total() }} hasil
                                    </small>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            @if($kosList->count() > 0)
                <!-- Kos Cards Grid -->
                <div class="row g-4 mb-5">
                    @foreach($kosList as $kos)
                        <div class="col-lg-4 col-md-6">
                            <div class="glass-card kos-card h-100">
                                <div class="kos-image-container">
                                    @if($kos->foto)
                                        <img src="{{ asset($kos->foto) }}" class="kos-image" alt="{{ $kos->nama_kos }}">
                                    @else
                                        <div class="kos-image-placeholder">
                                            <i class="fas fa-home"></i>
                                        </div>
                                    @endif

                                    <div class="image-overlay">
                                        <span class="verified-badge">
                                            <i class="fas fa-check-circle me-1"></i>Terverifikasi
                                        </span>
                                        <div class="price-badge">
                                            <span class="price-amount">Rp {{ number_format($kos->harga, 0, ',', '.') }}</span>
                                            <span class="price-period">/bulan</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="kos-content">
                                    <h5 class="kos-title">{{ $kos->nama_kos }}</h5>

                                    <div class="kos-location mb-3">
                                        <i class="fas fa-map-marker-alt me-2"></i>
                                        <span>{{ $kos->lokasi }}</span>
                                    </div>

                                    @if($kos->fasilitas)
                                        <div class="kos-facilities mb-3">
                                            <i class="fas fa-star me-2"></i>
                                            <small><strong>Fasilitas:</strong> {{ Str::limit($kos->fasilitas, 50) }}</small>
                                        </div>
                                    @endif

                                    @if($kos->deskripsi)
                                        <div class="kos-description mb-3">
                                            <i class="fas fa-info-circle me-2"></i>
                                            <small>{{ Str::limit($kos->deskripsi, 80) }}</small>
                                        </div>
                                    @endif

                                    <div class="kos-owner">
                                        <i class="fas fa-user me-2"></i>
                                        <small>{{ $kos->pemilik->name }}</small>
                                    </div>
                                </div>

                                <div class="kos-footer">
                                    <a href="{{ route('kos.show', $kos->id) }}" class="glass-btn glass-btn-primary w-100">
                                        <i class="fas fa-eye me-2"></i>Lihat Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="row">
                    <div class="col-12">
                        <div class="glass-card pagination-card text-center">
                            <div class="pagination-wrapper">
                                {{ $kosList->appends(request()->query())->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- No Results -->
                <div class="row">
                    <div class="col-12">
                        <div class="glass-card no-results-card text-center">
                            <div class="no-results-icon">
                                <i class="fas fa-search"></i>
                            </div>
                            <h4 class="no-results-title">Tidak Ada Kos Ditemukan</h4>
                            @if(request()->hasAny(['search', 'lokasi', 'min_price', 'max_price']))
                                <p class="no-results-text mb-4">
                                    Coba sesuaikan kriteria pencarian Anda atau hapus filter untuk melihat semua kos yang tersedia.
                                </p>
                                <a href="{{ route('search') }}" class="glass-btn glass-btn-primary">
                                    <i class="fas fa-times me-2"></i>Hapus Filter
                                </a>
                            @else
                                <p class="no-results-text mb-4">
                                    Tidak ada kos terverifikasi yang tersedia saat ini. Silakan cek kembali nanti.
                                </p>
                                <a href="{{ route('dashboard') }}" class="glass-btn glass-btn-primary">
                                    <i class="fas fa-home me-2"></i>Kembali ke Dashboard
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            <!-- Quick Search Tips -->
            <div class="row mt-5">
                <div class="col-12">
                    <div class="glass-card tips-card">
                        <div class="tips-header">
                            <div class="tips-icon">
                                <i class="fas fa-lightbulb"></i>
                            </div>
                            <h5 class="tips-title">Tips Pencarian</h5>
                        </div>
                        <div class="tips-content">
                            <div class="row g-4">
                                <div class="col-md-3">
                                    <div class="tip-item">
                                        <div class="tip-icon primary">
                                            <i class="fas fa-search"></i>
                                        </div>
                                        <h6 class="tip-title">Kata Kunci</h6>
                                        <p class="tip-description">Gunakan kata kunci spesifik seperti nama kos atau area
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="tip-item">
                                        <div class="tip-icon success">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                        <h6 class="tip-title">Lokasi</h6>
                                        <p class="tip-description">Masukkan lokasi yang dekat dengan aktivitas Anda</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="tip-item">
                                        <div class="tip-icon warning">
                                            <i class="fas fa-money-bill-wave"></i>
                                        </div>
                                        <h6 class="tip-title">Budget</h6>
                                        <p class="tip-description">Atur range harga sesuai kemampuan finansial Anda</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="tip-item">
                                        <div class="tip-icon info">
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <h6 class="tip-title">Fasilitas</h6>
                                        <p class="tip-description">Perhatikan fasilitas yang disediakan setiap kos</p>
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
                --gradient-background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #4facfe 100%);
            }

            .glassmorphism-browse {
                background: var(--gradient-background);
                min-height: 100vh;
                position: relative;
                overflow-x: hidden;
            }

            .glassmorphism-browse::before {
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
            .page-title {
                font-family: 'Poppins', sans-serif;
                font-size: clamp(2.5rem, 4vw, 3.5rem);
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

            .page-subtitle {
                font-size: 1.2rem;
                color: rgba(255, 255, 255, 0.8);
                margin: 0;
                font-weight: 400;
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

            /* Filter Card */
            .filter-card {
                position: relative;
                padding: 3rem;
            }

            .filter-card .card-icon {
                position: absolute;
                top: 2rem;
                right: 2rem;
                width: 60px;
                height: 60px;
                background: var(--gradient-primary);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.5rem;
                color: var(--white);
                opacity: 0.7;
            }

            .card-title {
                color: var(--white);
                font-family: 'Poppins', sans-serif;
                font-weight: 700;
                font-size: 1.5rem;
                margin-bottom: 2rem;
            }

            /* Glass Input Groups */
            .glass-input-group {
                margin-bottom: 1.5rem;
            }

            .glass-label {
                color: var(--white);
                font-weight: 600;
                font-size: 0.95rem;
                margin-bottom: 0.75rem;
                display: block;
            }

            .glass-input {
                background: var(--glass-bg);
                backdrop-filter: blur(15px);
                border: 1px solid var(--glass-border);
                border-radius: 15px;
                color: var(--white);
                padding: 0.875rem 1.25rem;
                font-size: 0.95rem;
                width: 100%;
                transition: all 0.3s ease;
                font-family: 'Inter', sans-serif;
            }

            .glass-input:focus {
                background: var(--glass-bg-light);
                border-color: rgba(255, 255, 255, 0.5);
                box-shadow: 0 0 20px rgba(255, 255, 255, 0.2);
                color: var(--white);
                outline: none;
            }

            .glass-input::placeholder {
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

            .search-btn {
                width: 50px;
                height: 50px;
                padding: 0;
                font-size: 1.1rem;
            }

            /* Results Header */
            .results-header {
                padding: 2rem;
                margin-bottom: 2rem;
            }

            .results-title {
                color: var(--white);
                font-family: 'Poppins', sans-serif;
                font-weight: 700;
                font-size: 1.3rem;
                margin: 0;
            }

            .glass-badge {
                background: var(--gradient-secondary);
                color: var(--white);
                padding: 0.4rem 0.8rem;
                border-radius: 15px;
                font-size: 0.8rem;
                font-weight: 600;
            }

            .results-info {
                color: rgba(255, 255, 255, 0.8);
                font-size: 0.9rem;
            }

            .text-info {
                color: rgba(255, 255, 255, 0.7) !important;
            }

            /* Kos Cards */
            .kos-card {
                padding: 0;
                overflow: hidden;
                background: var(--glass-bg);
                border-radius: 20px;
                transition: all 0.4s ease;
            }

            .kos-card:hover {
                transform: translateY(-10px) scale(1.02);
                box-shadow: var(--glass-shadow-hover);
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
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: linear-gradient(to bottom, rgba(0, 0, 0, 0.1) 0%, transparent 50%, rgba(0, 0, 0, 0.7) 100%);
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                padding: 1rem;
            }

            .verified-badge {
                background: var(--gradient-success);
                color: var(--white);
                padding: 0.4rem 0.8rem;
                border-radius: 20px;
                font-size: 0.8rem;
                font-weight: 600;
                align-self: flex-start;
                box-shadow: 0 4px 15px rgba(17, 153, 142, 0.4);
            }

            .price-badge {
                align-self: flex-end;
                text-align: right;
            }

            .price-amount {
                display: block;
                font-size: 1.5rem;
                font-weight: 800;
                color: var(--white);
                text-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
                font-family: 'Poppins', sans-serif;
            }

            .price-period {
                color: rgba(255, 255, 255, 0.9);
                font-size: 0.9rem;
                font-weight: 500;
            }

            .kos-content {
                padding: 2rem;
                flex-grow: 1;
            }

            .kos-title {
                color: var(--white);
                font-weight: 700;
                font-size: 1.3rem;
                margin-bottom: 1rem;
                font-family: 'Poppins', sans-serif;
            }

            .kos-location,
            .kos-facilities,
            .kos-description,
            .kos-owner {
                color: rgba(255, 255, 255, 0.8);
                font-size: 0.9rem;
                display: flex;
                align-items: flex-start;
                margin-bottom: 0.75rem;
            }

            .kos-location i,
            .kos-facilities i,
            .kos-description i,
            .kos-owner i {
                color: rgba(255, 255, 255, 0.6);
                width: 20px;
                margin-top: 2px;
                flex-shrink: 0;
            }

            .kos-footer {
                padding: 0 2rem 2rem;
            }

            /* No Results */
            .no-results-card {
                padding: 4rem 3rem;
                text-align: center;
            }

            .no-results-icon {
                width: 120px;
                height: 120px;
                background: var(--gradient-primary);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 2rem;
                font-size: 3rem;
                color: var(--white);
                opacity: 0.8;
            }

            .no-results-title {
                color: var(--white);
                font-family: 'Poppins', sans-serif;
                font-weight: 700;
                font-size: 2rem;
                margin-bottom: 1rem;
            }

            .no-results-text {
                color: rgba(255, 255, 255, 0.8);
                font-size: 1.1rem;
                line-height: 1.6;
                max-width: 500px;
                margin: 0 auto 2rem;
            }

            /* Tips Card */
            .tips-card {
                padding: 3rem;
                background: var(--glass-bg-light);
            }

            .tips-header {
                display: flex;
                align-items: center;
                gap: 1rem;
                margin-bottom: 2rem;
            }

            .tips-icon {
                width: 60px;
                height: 60px;
                background: var(--gradient-accent);
                border-radius: 15px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.5rem;
                color: var(--white);
            }

            .tips-title {
                color: var(--white);
                font-family: 'Poppins', sans-serif;
                font-weight: 700;
                font-size: 1.5rem;
                margin: 0;
            }

            .tip-item {
                text-align: center;
            }

            .tip-icon {
                width: 50px;
                height: 50px;
                border-radius: 12px;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 1rem;
                font-size: 1.2rem;
                color: var(--white);
            }

            .tip-icon.primary {
                background: var(--gradient-primary);
            }

            .tip-icon.success {
                background: var(--gradient-success);
            }

            .tip-icon.warning {
                background: var(--gradient-accent);
            }

            .tip-icon.info {
                background: var(--gradient-secondary);
            }

            .tip-title {
                color: var(--white);
                font-weight: 600;
                font-size: 1rem;
                margin-bottom: 0.5rem;
                font-family: 'Poppins', sans-serif;
            }

            .tip-description {
                color: rgba(255, 255, 255, 0.8);
                font-size: 0.85rem;
                line-height: 1.5;
                margin: 0;
            }

            /* Pagination */
            .pagination-card {
                padding: 2rem;
            }

            .pagination-wrapper .pagination {
                justify-content: center;
                margin: 0;
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

            /* Responsive Design */
            @media (max-width: 768px) {
                .page-title {
                    font-size: 2.5rem;
                    text-align: center;
                }

                .page-subtitle {
                    text-align: center;
                    font-size: 1rem;
                }

                .glass-card {
                    padding: 2rem;
                }

                .filter-card {
                    padding: 2rem;
                }

                .filter-card .card-icon {
                    display: none;
                }

                .kos-content {
                    padding: 1.5rem;
                }

                .kos-footer {
                    padding: 0 1.5rem 1.5rem;
                }

                .tips-card {
                    padding: 2rem;
                }

                .tip-item {
                    margin-bottom: 2rem;
                }

                .results-header {
                    padding: 1.5rem;
                }

                .d-flex.justify-content-between {
                    flex-direction: column;
                    gap: 1rem;
                }
            }

            @media (max-width: 576px) {
                .glass-card {
                    padding: 1.5rem;
                }

                .kos-image-container {
                    height: 220px;
                }

                .no-results-card,
                .tips-card {
                    padding: 3rem 2rem;
                }

                .no-results-icon {
                    width: 80px;
                    height: 80px;
                    font-size: 2rem;
                }

                .tips-header {
                    flex-direction: column;
                    text-align: center;
                }
            }

            /* Loading Animation */
            @keyframes shimmer {
                0% {
                    background-position: -468px 0;
                }

                100% {
                    background-position: 468px 0;
                }
            }

            .loading {
                animation: shimmer 1.5s ease-in-out infinite;
                background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
                background-size: 468px 100%;
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
            .glass-input:focus,
            .glass-btn:focus {
                outline: 2px solid rgba(255, 255, 255, 0.5);
                outline-offset: 2px;
            }
        </style>
    @endpush

    @push('scripts')
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

            // Enhanced kos card interactions
            document.querySelectorAll('.kos-card').forEach(card => {
                card.addEventListener('mouseenter', function () {
                    this.style.boxShadow = '0 25px 50px rgba(255, 255, 255, 0.15)';
                });

                card.addEventListener('mouseleave', function () {
                    this.style.boxShadow = '';
                });
            });

            // Form enhancement
            const form = document.querySelector('.filter-form');
            if (form) {
                form.addEventListener('submit', function () {
                    const submitBtn = this.querySelector('.search-btn');
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
                    submitBtn.disabled = true;
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