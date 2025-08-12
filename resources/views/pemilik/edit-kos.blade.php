@extends('layouts.app')

@section('title', 'Edit Kos - Kos Finder')

@section('content')
    <div class="container-fluid glassmorphism-edit-kos">
        <div class="container py-5">
            <!-- Page Header -->
            <div class="row mb-5">
                <div class="col-12">
                    <div class="glass-card page-header">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <div class="header-content">
                                <div class="header-icon">
                                    <i class="fas fa-edit"></i>
                                </div>
                                <div class="header-text">
                                    <h1 class="page-title">Edit Kos</h1>
                                    <p class="page-subtitle">Update detail dan informasi kos: {{ $kos->nama_kos }}</p>
                                </div>
                            </div>
                            <div class="header-actions">
                                <a href="{{ route('pemilik.my-kos') }}" class="glass-btn glass-btn-outline">
                                    <i class="fas fa-arrow-left me-2"></i>Kembali ke Kos Saya
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Success/Error Alerts -->
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

            @if(session('error'))
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="glass-alert glass-alert-error">
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

            <!-- Form Content -->
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="glass-card form-card">
                        <div class="form-header">
                            <h5 class="form-title">
                                <i class="fas fa-home me-2"></i>Informasi Kos
                            </h5>
                            <p class="form-subtitle">Perbarui detail kos Anda dengan informasi yang akurat dan menarik</p>
                        </div>

                        <div class="form-body">
                            <form action="{{ route('pemilik.kos.update', $kos->id) }}" method="POST" enctype="multipart/form-data" id="editKosForm">
                                @csrf
                                @method('PUT')
                                
                                <!-- Basic Information Section -->
                                <div class="form-section">
                                    <div class="section-header">
                                        <h6 class="section-title">
                                            <i class="fas fa-info-circle me-2"></i>Informasi Dasar
                                        </h6>
                                    </div>

                                    <div class="row g-4">
                                        <div class="col-12">
                                            <div class="glass-form-group">
                                                <label for="nama_kos" class="glass-label">
                                                    <i class="fas fa-home me-2"></i>Nama Kos
                                                    <span class="required-asterisk">*</span>
                                                </label>
                                                <div class="glass-input-wrapper">
                                                    <input type="text" 
                                                           class="glass-input @error('nama_kos') is-invalid @enderror" 
                                                           id="nama_kos" 
                                                           name="nama_kos" 
                                                           value="{{ old('nama_kos', $kos->nama_kos) }}"
                                                           placeholder="Masukkan nama kos yang menarik"
                                                           required>
                                                    <div class="input-icon">
                                                        <i class="fas fa-home"></i>
                                                    </div>
                                                </div>
                                                @error('nama_kos')
                                                    <div class="glass-error">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="glass-form-group">
                                                <label for="lokasi" class="glass-label">
                                                    <i class="fas fa-map-marker-alt me-2"></i>Lokasi
                                                    <span class="required-asterisk">*</span>
                                                </label>
                                                <div class="glass-input-wrapper">
                                                    <input type="text" 
                                                           class="glass-input @error('lokasi') is-invalid @enderror" 
                                                           id="lokasi" 
                                                           name="lokasi" 
                                                           value="{{ old('lokasi', $kos->lokasi) }}"
                                                           placeholder="Jl. Sudirman No. 123, Jakarta Pusat"
                                                           required>
                                                    <div class="input-icon">
                                                        <i class="fas fa-map-marker-alt"></i>
                                                    </div>
                                                </div>
                                                @error('lokasi')
                                                    <div class="glass-error">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Map Coordinates -->
                                        <div class="col-md-6">
                                            <div class="glass-form-group">
                                                <label for="latitude" class="glass-label">
                                                    <i class="fas fa-map-pin me-2"></i>Latitude
                                                </label>
                                                <div class="glass-input-wrapper">
                                                    <input type="number" 
                                                           step="any"
                                                           class="glass-input @error('latitude') is-invalid @enderror" 
                                                           id="latitude" 
                                                           name="latitude" 
                                                           value="{{ old('latitude', $kos->latitude) }}" 
                                                           placeholder="-6.2088">
                                                    <div class="input-icon">
                                                        <i class="fas fa-map-marker"></i>
                                                    </div>
                                                </div>
                                                @error('latitude')
                                                    <div class="glass-error">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="glass-form-group">
                                                <label for="longitude" class="glass-label">
                                                    <i class="fas fa-map-pin me-2"></i>Longitude
                                                </label>
                                                <div class="glass-input-wrapper">
                                                    <input type="number" 
                                                           step="any"
                                                           class="glass-input @error('longitude') is-invalid @enderror" 
                                                           id="longitude" 
                                                           name="longitude" 
                                                           value="{{ old('longitude', $kos->longitude) }}" 
                                                           placeholder="106.8456">
                                                    <div class="input-icon">
                                                        <i class="fas fa-map-marker"></i>
                                                    </div>
                                                </div>
                                                @error('longitude')
                                                    <div class="glass-error">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Map Preview -->
                                        <div class="col-12">
                                            <div class="glass-form-group">
                                                <label class="glass-label">
                                                    <i class="fas fa-map me-2"></i>Lokasi di Peta
                                                </label>
                                                <div id="map" style="height: 300px; border-radius: 15px; margin-top: 10px;"></div>
                                                <div class="input-help">
                                                    <i class="fas fa-lightbulb me-1"></i>
                                                    Klik pada peta untuk mengubah lokasi atau masukkan koordinat secara manual
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="glass-form-group">
                                                <label for="harga" class="glass-label">
                                                    <i class="fas fa-money-bill-wave me-2"></i>Harga per Bulan (Rp)
                                                    <span class="required-asterisk">*</span>
                                                </label>
                                                <div class="glass-input-wrapper">
                                                    <input type="number" 
                                                           class="glass-input @error('harga') is-invalid @enderror" 
                                                           id="harga" 
                                                           name="harga" 
                                                           value="{{ old('harga', $kos->harga) }}"
                                                           min="0"
                                                           step="1000"
                                                           placeholder="1500000"
                                                           required>
                                                    <div class="input-icon">
                                                        <i class="fas fa-money-bill-wave"></i>
                                                    </div>
                                                </div>
                                                @error('harga')
                                                    <div class="glass-error">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="glass-form-group">
                                                <label for="status_ketersediaan" class="glass-label">
                                                    <i class="fas fa-toggle-on me-2"></i>Status Ketersediaan
                                                    <span class="required-asterisk">*</span>
                                                </label>
                                                <div class="glass-select-wrapper">
                                                    <select class="glass-select @error('status_ketersediaan') is-invalid @enderror" 
                                                            id="status_ketersediaan" 
                                                            name="status_ketersediaan" 
                                                            required>
                                                        <option value="tersedia" {{ old('status_ketersediaan', $kos->status_ketersediaan) == 'tersedia' ? 'selected' : '' }}>
                                                            Tersedia
                                                        </option>
                                                        <option value="tidak_tersedia" {{ old('status_ketersediaan', $kos->status_ketersediaan) == 'tidak_tersedia' ? 'selected' : '' }}>
                                                            Tidak Tersedia
                                                        </option>
                                                    </select>
                                                    <div class="select-icon">
                                                        <i class="fas fa-chevron-down"></i>
                                                    </div>
                                                </div>
                                                @error('status_ketersediaan')
                                                    <div class="glass-error">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Detailed Information Section -->
                                <div class="form-section">
                                    <div class="section-header">
                                        <h6 class="section-title">
                                            <i class="fas fa-list-ul me-2"></i>Informasi Detail
                                        </h6>
                                    </div>

                                    <div class="row g-4">
                                        <div class="col-12">
                                            <div class="glass-form-group">
                                                <label for="fasilitas" class="glass-label">
                                                    <i class="fas fa-star me-2"></i>Fasilitas
                                                </label>
                                                <div class="glass-textarea-wrapper">
                                                    <textarea class="glass-textarea @error('fasilitas') is-invalid @enderror" 
                                                              id="fasilitas" 
                                                              name="fasilitas" 
                                                              rows="3"
                                                              placeholder="AC, WiFi, Kamar Mandi Dalam, Kasur, Lemari, Meja Belajar">{{ old('fasilitas', $kos->fasilitas) }}</textarea>
                                                    <div class="textarea-icon">
                                                        <i class="fas fa-star"></i>
                                                    </div>
                                                </div>
                                                @error('fasilitas')
                                                    <div class="glass-error">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="glass-form-group">
                                                <label for="deskripsi" class="glass-label">
                                                    <i class="fas fa-align-left me-2"></i>Deskripsi
                                                </label>
                                                <div class="glass-textarea-wrapper">
                                                    <textarea class="glass-textarea @error('deskripsi') is-invalid @enderror" 
                                                              id="deskripsi" 
                                                              name="deskripsi" 
                                                              rows="4"
                                                              placeholder="Deskripsikan kos Anda secara detail untuk menarik calon penyewa...">{{ old('deskripsi', $kos->deskripsi) }}</textarea>
                                                    <div class="textarea-icon">
                                                        <i class="fas fa-align-left"></i>
                                                    </div>
                                                </div>
                                                @error('deskripsi')
                                                    <div class="glass-error">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Photo Section -->
                                <div class="form-section">
                                    <div class="section-header">
                                        <h6 class="section-title">
                                            <i class="fas fa-camera me-2"></i>Foto Kos
                                        </h6>
                                    </div>

                                    <div class="photo-upload-section">
                                        <!-- Foto Utama -->
                                        <div class="main-photo-section mb-4">
                                            <h6 class="photo-section-title">Foto Utama</h6>
                                            @if($kos->mainPhoto)
                                                <div class="current-photo">
                                                    <div class="photo-container">
                                                        <img src="{{ url($kos->mainPhoto->foto_path) }}" 
                                                             alt="{{ $kos->nama_kos }}" 
                                                             class="current-photo-img"
                                                             id="currentMainPhoto">
                                                        <div class="photo-overlay">
                                                            <div class="photo-info">
                                                                <i class="fas fa-image"></i>
                                                                <span>Foto Utama Saat Ini</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                        <div class="glass-form-group">
                                            <label for="foto_utama" class="glass-label">
                                                <i class="fas fa-upload me-2"></i>Ganti Foto Utama
                                            </label>
                                            <div class="glass-file-wrapper">
                                                <input type="file" 
                                                       class="glass-file-input @error('foto_utama') is-invalid @enderror" 
                                                       id="foto_utama" 
                                                       name="foto_utama" 
                                                       accept="image/*"
                                                       onchange="previewMainPhoto(this)">
                                                <label for="foto_utama" class="glass-file-label">
                                                    <div class="file-upload-content">
                                                        <i class="fas fa-cloud-upload-alt file-icon"></i>
                                                        <div class="file-text">
                                                            <span class="file-main">Pilih foto utama baru</span>
                                                            <span class="file-sub">atau drag & drop di sini</span>
                                                        </div>
                                                    </div>
                                                </label>
                                                <div class="file-info">
                                                    Upload foto utama baru (max 2MB, format: JPEG, PNG, JPG, GIF)
                                                </div>
                                            </div>
                                            @error('foto_utama')
                                                <div class="glass-error">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Preview Foto Utama Baru -->
                                        <div class="photo-preview" id="mainPhotoPreview" style="display: none;">
                                            <div class="preview-container">
                                                <img id="mainPreviewImg" class="preview-img" alt="Preview Foto Utama">
                                                <div class="preview-overlay">
                                                    <div class="preview-info">
                                                        <i class="fas fa-eye"></i>
                                                        <span>Preview Foto Utama Baru</span>
                                                    </div>
                                                    <button type="button" class="remove-preview" onclick="removeMainPhotoPreview()">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Foto Tambahan -->
                                    <div class="additional-photos-section mb-4">
                                        <h6 class="photo-section-title">Foto Tambahan</h6>
                                        
                                        <!-- Foto Tambahan Yang Sudah Ada -->
                                        <div class="current-photos mb-3">
                                            <div class="photos-grid" id="currentPhotosGrid">
                                                @foreach($kos->photos->where('is_main', false) as $photo)
                                                    <div class="photo-item" data-photo-id="{{ $photo->id }}">
                                                        <img src="{{ url($photo->foto_path) }}" 
                                                             alt="Foto Tambahan" 
                                                             class="photo-img">
                                                        <div class="photo-overlay">
                                                            <button type="button" class="remove-photo" onclick="deleteExistingPhoto({{ $photo->id }})">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        <!-- Form Upload Foto Tambahan -->
                                        <div class="glass-form-group">
                                            <label for="foto" class="glass-label">
                                                <i class="fas fa-upload me-2"></i>Tambah Foto Lainnya
                                            </label>
                                            <div class="glass-file-wrapper">
                                                <input type="file" 
                                                       class="glass-file-input @error('foto.*') is-invalid @enderror" 
                                                       id="foto" 
                                                       name="foto[]" 
                                                       accept="image/*"
                                                       multiple
                                                       onchange="previewAdditionalPhotos(this)">
                                                <label for="foto" class="glass-file-label">
                                                    <div class="file-upload-content">
                                                        <i class="fas fa-images file-icon"></i>
                                                        <div class="file-text">
                                                            <span class="file-main">Pilih beberapa foto tambahan</span>
                                                            <span class="file-sub">atau drag & drop di sini (max 5 foto)</span>
                                                        </div>
                                                    </div>
                                                </label>
                                                <div class="file-info">
                                                    Upload foto tambahan (max 2MB per foto, format: JPEG, PNG, JPG, GIF)
                                                </div>
                                            </div>
                                            @error('foto.*')
                                                <div class="glass-error">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Preview Foto Tambahan -->
                                        <div class="photos-preview" id="additionalPhotosPreview">
                                            <!-- Preview foto tambahan akan ditampilkan di sini -->
                                        </div>

                                        <!-- Photo Preview -->
                                        <div class="photo-preview" id="photoPreview" style="display: none;">
                                            <div class="preview-container">
                                                <img id="previewImg" class="preview-img" alt="Preview">
                                                <div class="preview-overlay">
                                                    <div class="preview-info">
                                                        <i class="fas fa-eye"></i>
                                                        <span>Preview Foto Baru</span>
                                                    </div>
                                                    <button type="button" class="remove-preview" onclick="removePreview()">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Verification Status -->
                                @if(!$kos->is_verified)
                                    <div class="verification-notice">
                                        <div class="glass-alert glass-alert-warning">
                                            <div class="alert-icon">
                                                <i class="fas fa-exclamation-triangle"></i>
                                            </div>
                                            <div class="alert-content">
                                                <strong>Perhatian!</strong>
                                                <p>Kos ini masih menunggu verifikasi admin. Perubahan yang Anda buat juga akan perlu ditinjau ulang oleh tim admin kami.</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <!-- Form Actions -->
                                <div class="form-actions">
                                    <button type="submit" class="glass-btn glass-btn-primary btn-submit">
                                        <i class="fas fa-save me-2"></i>
                                        <span class="btn-text">Update Kos</span>
                                        <span class="btn-loading" style="display: none;">
                                            <i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...
                                        </span>
                                    </button>
                                    <a href="{{ route('pemilik.my-kos') }}" class="glass-btn glass-btn-outline">
                                        <i class="fas fa-times me-2"></i>Batal
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <!-- Leaflet CSS -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
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
                --gradient-warning: linear-gradient(135deg, #ffa726 0%, #fb8c00 100%);
            }

            .glassmorphism-edit-kos {
                background: var(--gradient-background);
                min-height: 100vh;
                position: relative;
                overflow-x: hidden;
            }

            .glassmorphism-edit-kos::before {
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

            /* Alert Styles */
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
                margin-bottom: 1rem;
            }

            .glass-alert-success {
                background: rgba(17, 153, 142, 0.1);
                border-color: rgba(17, 153, 142, 0.3);
            }

            .glass-alert-error {
                background: rgba(239, 68, 68, 0.1);
                border-color: rgba(239, 68, 68, 0.3);
            }

            .glass-alert-warning {
                background: rgba(245, 158, 11, 0.1);
                border-color: rgba(245, 158, 11, 0.3);
            }

            .alert-icon {
                flex-shrink: 0;
                width: 40px;
                height: 40px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                color: var(--white);
                font-size: 1.2rem;
            }

            .glass-alert-success .alert-icon {
                background: var(--gradient-success);
            }

            .glass-alert-error .alert-icon {
                background: var(--gradient-danger);
            }

            .glass-alert-warning .alert-icon {
                background: var(--gradient-warning);
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

            /* Form Card */
            .form-card {
                padding: 0;
                overflow: hidden;
            }

            .form-header {
                padding: 2.5rem 2.5rem 0;
                margin-bottom: 2rem;
                text-align: center;
            }

            .form-title {
                font-family: 'Poppins', sans-serif;
                font-size: 1.5rem;
                font-weight: 700;
                color: var(--white);
                margin-bottom: 0.5rem;
            }

            .form-subtitle {
                color: rgba(255, 255, 255, 0.8);
                font-size: 1rem;
                margin: 0;
            }

            .form-body {
                padding: 0 2.5rem 2.5rem;
            }

            /* Form Sections */
            .form-section {
                margin-bottom: 3rem;
            }

            .section-header {
                margin-bottom: 1.5rem;
                padding-bottom: 1rem;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            }

            .section-title {
                font-family: 'Poppins', sans-serif;
                font-size: 1.2rem;
                font-weight: 600;
                color: var(--white);
                margin: 0;
            }

            /* Glass Form Elements */
            .glass-form-group {
                margin-bottom: 1.5rem;
            }

            .glass-label {
                color: var(--white);
                font-weight: 600;
                font-size: 0.95rem;
                margin-bottom: 0.75rem;
                display: block;
                font-family: 'Inter', sans-serif;
            }

            .required-asterisk {
                color: #ff6b6b;
                margin-left: 0.25rem;
            }

            .glass-input-wrapper,
            .glass-select-wrapper,
            .glass-textarea-wrapper {
                position: relative;
            }

            .glass-input,
            .glass-select,
            .glass-textarea {
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
            }

            .glass-input {
                padding-left: 3rem;
            }

            .glass-textarea {
                padding-left: 3rem;
                resize: vertical;
                min-height: 120px;
            }

            .glass-input:focus,
            .glass-select:focus,
            .glass-textarea:focus {
                background: var(--glass-bg-light);
                border-color: rgba(102, 126, 234, 0.5);
                box-shadow: 0 0 25px rgba(102, 126, 234, 0.3);
                color: var(--white);
                outline: none;
                transform: translateY(-2px);
            }

            .glass-input::placeholder,
            .glass-textarea::placeholder {
                color: rgba(255, 255, 255, 0.6);
            }

            .glass-select {
                cursor: pointer;
                appearance: none;
                -webkit-appearance: none;
                -moz-appearance: none;
            }

            .glass-select option {
                background: var(--dark-color);
                color: var(--white);
                padding: 0.5rem;
            }

            .input-icon,
            .select-icon,
            .textarea-icon {
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                color: rgba(255, 255, 255, 0.6);
                font-size: 0.9rem;
                pointer-events: none;
                z-index: 2;
            }

            .input-icon,
            .textarea-icon {
                left: 1rem;
            }

            .select-icon {
                right: 1rem;
            }

            .textarea-icon {
                top: 1rem;
                transform: none;
            }

            .glass-error {
                color: #ff6b6b;
                font-size: 0.85rem;
                margin-top: 0.5rem;
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }

            .glass-error::before {
                content: '\f06a';
                font-family: 'Font Awesome 5 Free';
                font-weight: 900;
            }

            /* File Upload */
            .glass-file-wrapper {
                position: relative;
            }

            .glass-file-input {
                position: absolute;
                opacity: 0;
                width: 100%;
                height: 100%;
                cursor: pointer;
                z-index: 2;
            }

            .glass-file-label {
                background: var(--glass-bg);
                backdrop-filter: blur(20px);
                border: 2px dashed var(--glass-border);
                border-radius: 15px;
                padding: 2rem;
                display: block;
                cursor: pointer;
                transition: all 0.3s ease;
                text-align: center;
            }

            .glass-file-label:hover {
                background: var(--glass-bg-light);
                border-color: rgba(102, 126, 234, 0.5);
                transform: translateY(-2px);
            }

            .file-upload-content {
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 1rem;
            }

            .file-icon {
                font-size: 2.5rem;
                color: rgba(255, 255, 255, 0.6);
            }

            .file-text {
                text-align: center;
            }

            .file-main {
                display: block;
                color: var(--white);
                font-weight: 600;
                font-size: 1rem;
                margin-bottom: 0.25rem;
            }

            .file-sub {
                color: rgba(255, 255, 255, 0.6);
                font-size: 0.9rem;
            }

            .file-info {
                color: rgba(255, 255, 255, 0.7);
                font-size: 0.85rem;
                margin-top: 0.75rem;
                text-align: center;
            }

            /* Photo Upload Section */
            .photo-upload-section {
                margin-bottom: 2rem;
            }

            .photo-section-title {
                font-size: 1rem;
                color: var(--white);
                margin-bottom: 1rem;
                font-weight: 600;
            }

            .main-photo-section,
            .additional-photos-section {
                background: var(--glass-bg);
                border-radius: 15px;
                padding: 1.5rem;
                margin-bottom: 1.5rem;
            }

            .current-photo,
            .photo-preview {
                margin-bottom: 1.5rem;
            }

            .photo-container,
            .preview-container {
                position: relative;
                border-radius: 15px;
                overflow: hidden;
                max-width: 300px;
                margin: 0 auto;
            }

            /* Photos Grid */
            .photos-grid {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
                gap: 1rem;
                margin-bottom: 1.5rem;
            }

            .photo-item {
                position: relative;
                border-radius: 10px;
                overflow: hidden;
                aspect-ratio: 1;
                background: var(--glass-bg);
                border: 1px solid var(--glass-border);
            }

            .photo-item img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: transform 0.3s ease;
            }

            .photo-item:hover img {
                transform: scale(1.05);
            }

            .photo-item .photo-overlay {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: linear-gradient(to bottom, transparent, rgba(0, 0, 0, 0.7));
                display: flex;
                align-items: center;
                justify-content: center;
                opacity: 0;
                transition: opacity 0.3s ease;
            }

            .photo-item:hover .photo-overlay {
                opacity: 1;
            }

            .remove-photo {
                background: rgba(239, 68, 68, 0.9);
                border: none;
                border-radius: 50%;
                width: 35px;
                height: 35px;
                color: white;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                transition: all 0.3s ease;
                font-size: 1rem;
            }

            .remove-photo:hover {
                background: #dc2626;
                transform: scale(1.1);
            }

            .current-photo-img,
            .preview-img {
                width: 100%;
                height: 200px;
                object-fit: cover;
                display: block;
            }

            .photo-overlay,
            .preview-overlay {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: linear-gradient(to bottom, transparent, rgba(0, 0, 0, 0.7));
                display: flex;
                align-items: flex-end;
                justify-content: space-between;
                padding: 1rem;
                opacity: 0;
                transition: opacity 0.3s ease;
            }

            .photo-container:hover .photo-overlay,
            .preview-container:hover .preview-overlay {
                opacity: 1;
            }

            .photo-info,
            .preview-info {
                color: var(--white);
                font-size: 0.9rem;
                font-weight: 600;
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }

            .remove-preview {
                background: rgba(239, 68, 68, 0.8);
                border: none;
                border-radius: 50%;
                width: 30px;
                height: 30px;
                color: var(--white);
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: all 0.3s ease;
            }

            .remove-preview:hover {
                background: rgba(239, 68, 68, 1);
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
                min-width: 140px;
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

            /* Form Actions */
            .form-actions {
                display: flex;
                gap: 1rem;
                justify-content: center;
                padding-top: 2rem;
                border-top: 1px solid rgba(255, 255, 255, 0.1);
                margin-top: 2rem;
            }

            .btn-submit {
                position: relative;
            }

            .btn-loading {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
            }

            /* Verification Notice */
            .verification-notice {
                margin-bottom: 2rem;
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

                .form-header {
                    padding: 2rem 1.5rem 0;
                }

                .form-body {
                    padding: 0 1.5rem 1.5rem;
                }

                .form-actions {
                    flex-direction: column;
                }

                .glass-btn {
                    width: 100%;
                }

                .d-flex.justify-content-between {
                    flex-direction: column;
                    gap: 1rem;
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

                .form-header {
                    padding: 1.5rem 1rem 0;
                }

                .form-body {
                    padding: 0 1rem 1rem;
                }

                .glass-input,
                .glass-select,
                .glass-textarea {
                    font-size: 16px; /* Prevent zoom on iOS */
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
            .glass-input:focus,
            .glass-select:focus,
            .glass-textarea:focus,
            .glass-btn:focus {
                outline: 2px solid rgba(255, 255, 255, 0.5);
                outline-offset: 2px;
            }
        </style>
    @endpush

    @push('scripts')
        <!-- Leaflet JS -->
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
        <script src="/js/photo-upload.js"></script>
        <script>
            // Initialize Map
            let map;
            let marker;
            
            function initMap() {
                // Default center (Indonesia) or use existing coordinates
                const lat = document.getElementById('latitude').value || -6.2088;
                const lng = document.getElementById('longitude').value || 106.8456;
                
                // Create map
                map = L.map('map').setView([lat, lng], 13);
                
                // Add tile layer (OpenStreetMap)
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap contributors'
                }).addTo(map);
                
                // Add marker if coordinates exist
                if (lat && lng) {
                    setMarker([lat, lng]);
                }
                
                // Handle map click
                map.on('click', function(e) {
                    const lat = e.latlng.lat;
                    const lng = e.latlng.lng;
                    
                    // Update form inputs
                    document.getElementById('latitude').value = lat.toFixed(6);
                    document.getElementById('longitude').value = lng.toFixed(6);
                    
                    // Update marker
                    setMarker([lat, lng]);
                });
                
                // Handle coordinate input changes
                document.getElementById('latitude').addEventListener('input', updateMapFromInputs);
                document.getElementById('longitude').addEventListener('input', updateMapFromInputs);
            }
            
            function setMarker(latlng) {
                if (marker) {
                    marker.setLatLng(latlng);
                } else {
                    marker = L.marker(latlng).addTo(map);
                }
                map.setView(latlng);
            }
            
            function updateMapFromInputs() {
                const lat = parseFloat(document.getElementById('latitude').value);
                const lng = parseFloat(document.getElementById('longitude').value);
                
                if (!isNaN(lat) && !isNaN(lng)) {
                    setMarker([lat, lng]);
                }
            }

            // Initialize map after DOM loaded
            document.addEventListener('DOMContentLoaded', function() {
                initMap();
            });

            // Preview image function
            function previewImage(input) {
                const preview = document.getElementById('photoPreview');
                const previewImg = document.getElementById('previewImg');
                
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    
                    reader.onload = function(e) {
                        previewImg.src = e.target.result;
                        preview.style.display = 'block';
                        
                        // Add fade in animation
                        preview.style.opacity = '0';
                        setTimeout(() => {
                            preview.style.transition = 'opacity 0.3s ease';
                            preview.style.opacity = '1';
                        }, 10);
                    }
                    
                    reader.readAsDataURL(input.files[0]);
                } else {
                    preview.style.display = 'none';
                }
            }

            // Remove preview function
            function removePreview() {
                const preview = document.getElementById('photoPreview');
                const fileInput = document.getElementById('foto');
                
                preview.style.display = 'none';
                fileInput.value = '';
            }

            // Form submission with loading state
            document.getElementById('editKosForm').addEventListener('submit', function() {
                const submitBtn = document.querySelector('.btn-submit');
                const btnText = submitBtn.querySelector('.btn-text');
                const btnLoading = submitBtn.querySelector('.btn-loading');
                
                btnText.style.display = 'none';
                btnLoading.style.display = 'inline-flex';
                submitBtn.disabled = true;
                
                // Re-enable after 10 seconds (in case of error)
                setTimeout(() => {
                    btnText.style.display = 'inline-flex';
                    btnLoading.style.display = 'none';
                    submitBtn.disabled = false;
                }, 10000);
            });

            // File drag and drop functionality
            const fileLabel = document.querySelector('.glass-file-label');
            const fileInput = document.getElementById('foto');

            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                fileLabel.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            ['dragenter', 'dragover'].forEach(eventName => {
                fileLabel.addEventListener(eventName, highlight, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                fileLabel.addEventListener(eventName, unhighlight, false);
            });

            function highlight(e) {
                fileLabel.style.background = 'var(--glass-bg-light)';
                fileLabel.style.borderColor = 'rgba(102, 126, 234, 0.5)';
            }

            function unhighlight(e) {
                fileLabel.style.background = 'var(--glass-bg)';
                fileLabel.style.borderColor = 'var(--glass-border)';
            }

            fileLabel.addEventListener('drop', handleDrop, false);

            function handleDrop(e) {
                const dt = e.dataTransfer;
                const files = dt.files;
                
                if (files.length > 0) {
                    fileInput.files = files;
                    previewImage(fileInput);
                }
            }

            // Auto-format currency input
            const hargaInput = document.getElementById('harga');
            hargaInput.addEventListener('input', function(e) {
                let value = e.target.value.replace(/[^\d]/g, '');
                if (value) {
                    // Add thousand separators for display
                    const formatted = new Intl.NumberFormat('id-ID').format(value);
                    
                    // Update placeholder to show formatted version
                    if (value !== e.target.value) {
                        e.target.setAttribute('data-formatted', 'Rp ' + formatted);
                    }
                }
            });

            // Add floating label effect
            document.querySelectorAll('.glass-input, .glass-textarea, .glass-select').forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('focused');
                });
                
                input.addEventListener('blur', function() {
                    if (!this.value) {
                        this.parentElement.classList.remove('focused');
                    }
                });
                
                // Check initial value
                if (input.value) {
                    input.parentElement.classList.add('focused');
                }
            });

            // Add character counter for textarea
            document.querySelectorAll('.glass-textarea').forEach(textarea => {
                const counter = document.createElement('div');
                counter.className = 'character-counter';
                counter.style.cssText = `
                    position: absolute;
                    bottom: 0.5rem;
                    right: 1rem;
                    color: rgba(255, 255, 255, 0.6);
                    font-size: 0.75rem;
                    pointer-events: none;
                `;
                
                textarea.parentElement.appendChild(counter);
                
                function updateCounter() {
                    const current = textarea.value.length;
                    const maxLength = textarea.getAttribute('maxlength');
                    
                    if (maxLength) {
                        counter.textContent = `${current}/${maxLength}`;
                        if (current > maxLength * 0.9) {
                            counter.style.color = '#ff6b6b';
                        } else {
                            counter.style.color = 'rgba(255, 255, 255, 0.6)';
                        }
                    } else {
                        counter.textContent = `${current} karakter`;
                    }
                }
                
                textarea.addEventListener('input', updateCounter);
                updateCounter();
            });

            // Add ripple effect to buttons
            document.querySelectorAll('.glass-btn').forEach(button => {
                button.addEventListener('click', function(e) {
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

            console.log('Enhanced Edit Kos Interface Loaded Successfully!');
        </script>
    @endpush
@endsection