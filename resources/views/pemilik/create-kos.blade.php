@extends('layouts.app')

@section('title', 'Tambah Kos Baru - Kos Finder')

@section('content')
    <div class="container-fluid glassmorphism-add-kos">
        <div class="container py-5">
            <!-- Page Header -->
            <div class="row mb-5">
                <div class="col-12">
                    <div class="glass-card page-header">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <div class="header-content">
                                <div class="header-icon">
                                    <i class="fas fa-plus-circle"></i>
                                </div>
                                <div class="header-text">
                                    <h1 class="page-title">Tambah Kos Baru</h1>
                                    <p class="page-subtitle">Buat listing kos baru dan jangkau ribuan calon penyewa</p>
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

            <!-- Form Section -->
            <div class="row justify-content-center">
                <div class="col-lg-8 col-xl-7">
                    <div class="glass-card form-card">
                        <div class="form-header">
                            <div class="form-progress">
                                <div class="progress-step active">
                                    <div class="step-number">1</div>
                                    <span class="step-label">Informasi Dasar</span>
                                </div>
                                <div class="progress-line"></div>
                                <div class="progress-step">
                                    <div class="step-number">2</div>
                                    <span class="step-label">Detail & Media</span>
                                </div>
                                <div class="progress-line"></div>
                                <div class="progress-step">
                                    <div class="step-number">3</div>
                                    <span class="step-label">Review</span>
                                </div>
                            </div>
                        </div>

                        <form action="{{ route('pemilik.kos.store') }}" method="POST" enctype="multipart/form-data" class="kos-form">
                            @csrf

                            <!-- Step 1: Basic Information -->
                            <div class="form-step active" id="step1">
                                <div class="step-header">
                                    <h4 class="step-title">
                                        <i class="fas fa-info-circle me-2"></i>Informasi Dasar
                                    </h4>
                                    <p class="step-subtitle">Masukkan informasi dasar tentang kos Anda</p>
                                </div>

                                <div class="form-group">
                                    <label for="nama_kos" class="glass-label required">
                                        <i class="fas fa-home me-2"></i>Nama Kos
                                    </label>
                                    <div class="glass-input-wrapper">
                                        <input type="text" 
                                               class="glass-input @error('nama_kos') is-invalid @enderror" 
                                               id="nama_kos" 
                                               name="nama_kos" 
                                               value="{{ old('nama_kos') }}" 
                                               placeholder="Contoh: Kos Mawar Indah"
                                               required>
                                        <div class="input-icon">
                                            <i class="fas fa-home"></i>
                                        </div>
                                    </div>
                                    @error('nama_kos')
                                        <div class="glass-error">
                                            <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                        </div>
                                    @enderror
                                    <div class="input-help">
                                        <i class="fas fa-lightbulb me-1"></i>
                                        Gunakan nama yang menarik dan mudah diingat
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="lokasi" class="glass-label required">
                                        <i class="fas fa-map-marker-alt me-2"></i>Lokasi Lengkap
                                    </label>
                                    <div class="glass-input-wrapper">
                                        <input type="text" 
                                               class="glass-input @error('lokasi') is-invalid @enderror" 
                                               id="lokasi" 
                                               name="lokasi" 
                                               value="{{ old('lokasi') }}" 
                                               placeholder="Jl. Sudirman No. 123, Jakarta Pusat"
                                               required>
                                        <div class="input-icon">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                    </div>
                                    @error('lokasi')
                                        <div class="glass-error">
                                            <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                        </div>
                                    @enderror
                                    <div class="input-help">
                                        <i class="fas fa-lightbulb me-1"></i>
                                        Sertakan alamat lengkap dengan nama jalan dan kota
                                    </div>
                                </div>

                                <!-- Map Coordinates -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="latitude" class="glass-label">
                                                <i class="fas fa-map-pin me-2"></i>Latitude
                                            </label>
                                            <div class="glass-input-wrapper">
                                                <input type="number" 
                                                       step="any"
                                                       class="glass-input @error('latitude') is-invalid @enderror" 
                                                       id="latitude" 
                                                       name="latitude" 
                                                       value="{{ old('latitude') }}" 
                                                       placeholder="-6.2088">
                                                <div class="input-icon">
                                                    <i class="fas fa-map-marker"></i>
                                                </div>
                                            </div>
                                            @error('latitude')
                                                <div class="glass-error">
                                                    <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="longitude" class="glass-label">
                                                <i class="fas fa-map-pin me-2"></i>Longitude
                                            </label>
                                            <div class="glass-input-wrapper">
                                                <input type="number" 
                                                       step="any"
                                                       class="glass-input @error('longitude') is-invalid @enderror" 
                                                       id="longitude" 
                                                       name="longitude" 
                                                       value="{{ old('longitude') }}" 
                                                       placeholder="106.8456">
                                                <div class="input-icon">
                                                    <i class="fas fa-map-marker"></i>
                                                </div>
                                            </div>
                                            @error('longitude')
                                                <div class="glass-error">
                                                    <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Map Preview -->
                                <div class="form-group">
                                    <label class="glass-label">
                                        <i class="fas fa-map me-2"></i>Preview Lokasi di Peta
                                    </label>
                                    <div id="map" style="height: 300px; border-radius: 15px; margin-top: 10px;"></div>
                                    <div class="input-help">
                                        <i class="fas fa-lightbulb me-1"></i>
                                        Klik pada peta untuk mengatur lokasi atau masukkan koordinat secara manual
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="harga" class="glass-label required">
                                        <i class="fas fa-money-bill-wave me-2"></i>Harga per Bulan (Rp)
                                    </label>
                                    <div class="glass-input-wrapper">
                                        <input type="number" 
                                               class="glass-input @error('harga') is-invalid @enderror" 
                                               id="harga" 
                                               name="harga" 
                                               value="{{ old('harga') }}" 
                                               min="0"
                                               step="50000"
                                               placeholder="1500000"
                                               required>
                                        <div class="input-icon">
                                            <i class="fas fa-money-bill-wave"></i>
                                        </div>
                                        <div class="input-currency">Rp</div>
                                    </div>
                                    @error('harga')
                                        <div class="glass-error">
                                            <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                        </div>
                                    @enderror
                                    <div class="price-preview" id="pricePreview"></div>
                                    <div class="input-help">
                                        <i class="fas fa-lightbulb me-1"></i>
                                        Tentukan harga yang kompetitif sesuai fasilitas yang ditawarkan
                                    </div>
                                </div>

                                <div class="step-navigation">
                                    <button type="button" class="glass-btn glass-btn-primary next-step">
                                        Selanjutnya
                                        <i class="fas fa-arrow-right ms-2"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Step 2: Details & Media -->
                            <div class="form-step" id="step2">
                                <div class="step-header">
                                    <h4 class="step-title">
                                        <i class="fas fa-clipboard-list me-2"></i>Detail & Media
                                    </h4>
                                    <p class="step-subtitle">Tambahkan fasilitas, deskripsi, dan foto kos</p>
                                </div>

                                <div class="form-group">
                                    <label for="fasilitas" class="glass-label">
                                        <i class="fas fa-star me-2"></i>Fasilitas
                                    </label>
                                    <div class="glass-textarea-wrapper">
                                        <textarea class="glass-textarea @error('fasilitas') is-invalid @enderror" 
                                                  id="fasilitas" 
                                                  name="fasilitas" 
                                                  rows="4"
                                                  placeholder="AC, WiFi, Kamar Mandi Dalam, Kasur, Lemari, Meja Belajar">{{ old('fasilitas') }}</textarea>
                                    </div>
                                    @error('fasilitas')
                                        <div class="glass-error">
                                            <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                        </div>
                                    @enderror
                                    <div class="facility-suggestions">
                                        <p class="suggestions-title">
                                            <i class="fas fa-magic me-1"></i>Saran fasilitas:
                                        </p>
                                        <div class="suggestion-tags">
                                            <span class="suggestion-tag" onclick="addFacility('AC')">AC</span>
                                            <span class="suggestion-tag" onclick="addFacility('WiFi')">WiFi</span>
                                            <span class="suggestion-tag" onclick="addFacility('Kamar Mandi Dalam')">Kamar Mandi Dalam</span>
                                            <span class="suggestion-tag" onclick="addFacility('Kasur')">Kasur</span>
                                            <span class="suggestion-tag" onclick="addFacility('Lemari')">Lemari</span>
                                            <span class="suggestion-tag" onclick="addFacility('Meja Belajar')">Meja Belajar</span>
                                            <span class="suggestion-tag" onclick="addFacility('Kursi')">Kursi</span>
                                            <span class="suggestion-tag" onclick="addFacility('Parkir Motor')">Parkir Motor</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="deskripsi" class="glass-label">
                                        <i class="fas fa-align-left me-2"></i>Deskripsi
                                    </label>
                                    <div class="glass-textarea-wrapper">
                                        <textarea class="glass-textarea @error('deskripsi') is-invalid @enderror" 
                                                  id="deskripsi" 
                                                  name="deskripsi" 
                                                  rows="5"
                                                  placeholder="Deskripsikan kos Anda secara detail, lingkungan sekitar, dan keunggulan yang ditawarkan...">{{ old('deskripsi') }}</textarea>
                                        <div class="character-count">
                                            <span id="charCount">0</span>/500 karakter
                                        </div>
                                    </div>
                                    @error('deskripsi')
                                        <div class="glass-error">
                                            <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                        </div>
                                    @enderror
                                    <div class="input-help">
                                        <i class="fas fa-lightbulb me-1"></i>
                                        Deskripsi yang detail akan menarik lebih banyak calon penyewa
                                    </div>
                                </div>

                                <!-- Foto Utama -->
                                <div class="form-group">
                                    <label class="glass-label required">
                                        <i class="fas fa-camera me-2"></i>Foto Utama Kos
                                    </label>
                                    <div class="glass-file-upload" id="mainPhotoUpload">
                                        <input type="file" 
                                               class="file-input @error('foto_utama') is-invalid @enderror" 
                                               id="fotoUtama" 
                                               name="foto_utama" 
                                               accept="image/*"
                                               required>
                                        <div class="upload-area">
                                            <div class="upload-icon">
                                                <i class="fas fa-cloud-upload-alt"></i>
                                            </div>
                                            <div class="upload-text">
                                                <p class="upload-title">Klik atau seret foto utama ke sini</p>
                                                <p class="upload-subtitle">Format: JPEG, PNG, JPG, GIF (Maks. 2MB)</p>
                                            </div>
                                        </div>
                                        <div class="image-preview" id="mainImagePreview" style="display: none;">
                                            <img id="mainPreviewImg" src="" alt="Preview">
                                            <span class="main-photo-badge">Foto Utama</span>
                                            <button type="button" class="remove-image" onclick="removeMainPhoto()">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                    @error('foto_utama')
                                        <div class="glass-error">
                                            <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                        </div>
                                    @enderror
                                    <div class="input-help">
                                        <i class="fas fa-lightbulb me-1"></i>
                                        Foto utama akan menjadi foto yang pertama dilihat oleh calon penyewa
                                    </div>
                                </div>

                                <!-- Foto Tambahan -->
                                <div class="form-group">
                                    <label class="glass-label">
                                        <i class="fas fa-images me-2"></i>Foto Tambahan
                                    </label>
                                    <div class="glass-file-upload" id="additionalPhotosUpload">
                                        <input type="file" 
                                               class="file-input @error('foto.*') is-invalid @enderror" 
                                               id="fotoTambahan" 
                                               name="foto[]" 
                                               accept="image/*"
                                               multiple>
                                        <div class="upload-area">
                                            <div class="upload-icon">
                                                <i class="fas fa-plus"></i>
                                            </div>
                                            <div class="upload-text">
                                                <p class="upload-title">Tambahkan foto lainnya</p>
                                                <p class="upload-subtitle">Pilih beberapa foto sekaligus (Maks. 5 foto)</p>
                                            </div>
                                        </div>
                                        <div class="photos-preview" id="additionalPhotosPreview">
                                            <!-- Preview foto tambahan akan ditampilkan di sini -->
                                        </div>
                                    </div>
                                    @error('foto.*')
                                        <div class="glass-error">
                                            <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                        </div>
                                    @enderror
                                    <div class="input-help">
                                        <i class="fas fa-lightbulb me-1"></i>
                                        Tambahkan beberapa foto dari sudut berbeda untuk memberikan gambaran lebih lengkap
                                    </div>
                                </div>

                                <div class="step-navigation">
                                    <button type="button" class="glass-btn glass-btn-outline prev-step">
                                        <i class="fas fa-arrow-left me-2"></i>Sebelumnya
                                    </button>
                                    <button type="button" class="glass-btn glass-btn-primary next-step">
                                        Selanjutnya
                                        <i class="fas fa-arrow-right ms-2"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Step 3: Review -->
                            <div class="form-step" id="step3">
                                <div class="step-header">
                                    <h4 class="step-title">
                                        <i class="fas fa-check-circle me-2"></i>Review & Submit
                                    </h4>
                                    <p class="step-subtitle">Periksa kembali informasi kos sebelum menyimpan</p>
                                </div>

                                <div class="review-card">
                                    <div class="review-header">
                                        <h5>Preview Listing Kos Anda</h5>
                                    </div>
                                    <div class="review-content">
                                        <div class="review-image">
                                            <div id="reviewImageContainer">
                                                <div class="placeholder-image">
                                                    <i class="fas fa-image"></i>
                                                    <span>Foto akan muncul di sini</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="review-details">
                                            <div class="review-item">
                                                <label>Nama Kos:</label>
                                                <span id="reviewNama">-</span>
                                            </div>
                                            <div class="review-item">
                                                <label>Lokasi:</label>
                                                <span id="reviewLokasi">-</span>
                                            </div>
                                            <div class="review-item">
                                                <label>Harga:</label>
                                                <span id="reviewHarga">-</span>
                                            </div>
                                            <div class="review-item">
                                                <label>Fasilitas:</label>
                                                <span id="reviewFasilitas">-</span>
                                            </div>
                                            <div class="review-item">
                                                <label>Deskripsi:</label>
                                                <span id="reviewDeskripsi">-</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="info-notice">
                                    <div class="notice-icon">
                                        <i class="fas fa-info-circle"></i>
                                    </div>
                                    <div class="notice-content">
                                        <h6>Catatan Penting:</h6>
                                        <ul>
                                            <li>Listing kos Anda akan direview oleh tim admin sebelum ditampilkan</li>
                                            <li>Proses verifikasi biasanya memakan waktu 1-2 hari kerja</li>
                                            <li>Pastikan semua informasi yang dimasukkan sudah benar</li>
                                            <li>Anda akan mendapat notifikasi via email saat listing disetujui</li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="step-navigation">
                                    <button type="button" class="glass-btn glass-btn-outline prev-step">
                                        <i class="fas fa-arrow-left me-2"></i>Sebelumnya
                                    </button>
                                    <button type="submit" class="glass-btn glass-btn-primary submit-btn">
                                        <i class="fas fa-save me-2"></i>
                                        <span class="btn-text">Simpan Kos</span>
                                        <span class="btn-loading" style="display: none;">
                                            <i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Help Panel -->
            <div class="row mt-4">
                <div class="col-lg-8 col-xl-7 mx-auto">
                    <div class="glass-card help-panel">
                        <div class="help-header">
                            <h6><i class="fas fa-question-circle me-2"></i>Butuh Bantuan?</h6>
                        </div>
                        <div class="help-content">
                            <div class="help-item">
                                <i class="fas fa-lightbulb help-icon"></i>
                                <div>
                                    <strong>Tips Membuat Listing Menarik:</strong>
                                    <p>Gunakan foto berkualitas baik, tulis deskripsi yang jelas, dan cantumkan semua fasilitas yang tersedia.</p>
                                </div>
                            </div>
                            <div class="help-item">
                                <i class="fas fa-clock help-icon"></i>
                                <div>
                                    <strong>Waktu Verifikasi:</strong>
                                    <p>Tim admin akan memverifikasi listing Anda dalam 1-2 hari kerja. Pastikan semua informasi akurat.</p>
                                </div>
                            </div>
                            <div class="help-item">
                                <i class="fas fa-envelope help-icon"></i>
                                <div>
                                    <strong>Kontak Support:</strong>
                                    <p>Jika mengalami kesulitan, hubungi tim support kami di support@kosfinder.com</p>
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

            .glassmorphism-add-kos {
                background: var(--gradient-background);
                min-height: 100vh;
                position: relative;
                overflow-x: hidden;
            }

            .glassmorphism-add-kos::before {
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

            /* Form Card */
            .form-card {
                padding: 0;
                overflow: visible;
            }

            /* Form Progress */
            .form-header {
                padding: 2.5rem 2.5rem 0;
                margin-bottom: 3rem;
            }

            .form-progress {
                display: flex;
                align-items: center;
                justify-content: center;
                margin-bottom: 2rem;
            }

            .progress-step {
                display: flex;
                flex-direction: column;
                align-items: center;
                position: relative;
            }

            .step-number {
                width: 50px;
                height: 50px;
                border-radius: 50%;
                background: var(--glass-bg);
                border: 2px solid var(--glass-border);
                display: flex;
                align-items: center;
                justify-content: center;
                font-weight: 700;
                color: rgba(255, 255, 255, 0.6);
                margin-bottom: 0.5rem;
                transition: all 0.3s ease;
            }

            .progress-step.active .step-number {
                background: var(--gradient-primary);
                border-color: transparent;
                color: var(--white);
                box-shadow: 0 4px 20px rgba(102, 126, 234, 0.4);
            }

            .step-label {
                font-size: 0.85rem;
                color: rgba(255, 255, 255, 0.7);
                text-align: center;
                font-weight: 500;
            }

            .progress-step.active .step-label {
                color: var(--white);
                font-weight: 600;
            }

            .progress-line {
                width: 80px;
                height: 2px;
                background: var(--glass-border);
                margin: 0 1rem;
                margin-top: -25px;
            }

            .progress-step.active + .progress-line {
                background: var(--gradient-primary);
            }

            /* Form Steps */
            .form-step {
                display: none;
                padding: 0 2.5rem 2.5rem;
            }

            .form-step.active {
                display: block;
                animation: slideIn 0.5s ease;
            }

            @keyframes slideIn {
                from {
                    opacity: 0;
                    transform: translateX(50px);
                }
                to {
                    opacity: 1;
                    transform: translateX(0);
                }
            }

            .step-header {
                margin-bottom: 2rem;
            }

            .step-title {
                font-family: 'Poppins', sans-serif;
                font-size: 1.5rem;
                font-weight: 700;
                color: var(--white);
                margin-bottom: 0.5rem;
            }

            .step-subtitle {
                color: rgba(255, 255, 255, 0.8);
                font-size: 1rem;
                margin: 0;
            }

            /* Form Groups */
            .form-group {
                margin-bottom: 2rem;
            }

            .glass-label {
                color: var(--white);
                font-weight: 600;
                font-size: 0.95rem;
                margin-bottom: 0.75rem;
                display: block;
                font-family: 'Inter', sans-serif;
            }

            .glass-label.required::after {
                content: '*';
                color: #ef4444;
                margin-left: 0.25rem;
            }

            /* Input Wrapper */
            .glass-input-wrapper {
                position: relative;
            }

            .glass-input {
                background: var(--glass-bg);
                backdrop-filter: blur(20px);
                border: 1px solid var(--glass-border);
                border-radius: 15px;
                color: var(--white);
                padding: 1rem 1rem 1rem 3rem;
                font-size: 0.95rem;
                width: 100%;
                transition: all 0.3s ease;
                font-family: 'Inter', sans-serif;
            }

            .glass-input:focus {
                background: var(--glass-bg-light);
                border-color: rgba(255, 255, 255, 0.5);
                box-shadow: 0 0 25px rgba(255, 255, 255, 0.2);
                color: var(--white);
                outline: none;
                transform: translateY(-2px);
            }

            .glass-input::placeholder {
                color: rgba(255, 255, 255, 0.6);
            }

            .glass-input.is-invalid {
                border-color: rgba(239, 68, 68, 0.8);
                box-shadow: 0 0 15px rgba(239, 68, 68, 0.3);
            }

            .input-icon {
                position: absolute;
                left: 1rem;
                top: 50%;
                transform: translateY(-50%);
                color: rgba(255, 255, 255, 0.6);
                font-size: 0.9rem;
                pointer-events: none;
                z-index: 2;
            }

            .input-currency {
                position: absolute;
                right: 1rem;
                top: 50%;
                transform: translateY(-50%);
                color: rgba(255, 255, 255, 0.8);
                font-weight: 600;
                font-size: 0.9rem;
                pointer-events: none;
            }

            /* Price Preview */
            .price-preview {
                margin-top: 0.5rem;
                font-size: 0.9rem;
                color: rgba(255, 255, 255, 0.8);
                font-weight: 500;
            }

            /* Textarea */
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

            /* Facility Suggestions */
            .facility-suggestions {
                margin-top: 1rem;
            }

            .suggestions-title {
                font-size: 0.9rem;
                color: rgba(255, 255, 255, 0.8);
                margin-bottom: 0.75rem;
            }

            .suggestion-tags {
                display: flex;
                flex-wrap: wrap;
                gap: 0.5rem;
            }

            .suggestion-tag {
                background: var(--glass-bg);
                border: 1px solid var(--glass-border);
                border-radius: 20px;
                padding: 0.4rem 0.8rem;
                font-size: 0.8rem;
                color: rgba(255, 255, 255, 0.8);
                cursor: pointer;
                transition: all 0.3s ease;
                user-select: none;
            }

            .suggestion-tag:hover {
                background: var(--glass-bg-light);
                border-color: rgba(255, 255, 255, 0.4);
                color: var(--white);
                transform: translateY(-2px);
            }

            /* File Upload */
            .glass-file-upload {
                position: relative;
            }

            .file-input {
                position: absolute;
                width: 100%;
                height: 100%;
                opacity: 0;
                cursor: pointer;
                z-index: 2;
            }

            .upload-area {
                background: var(--glass-bg);
                border: 2px dashed var(--glass-border);
                border-radius: 15px;
                padding: 3rem 2rem;
                text-align: center;
                transition: all 0.3s ease;
                cursor: pointer;
            }

            .upload-area:hover,
            .upload-area.drop-zone {
                background: var(--glass-bg-light);
                border-color: rgba(255, 255, 255, 0.4);
                transform: translateY(-2px);
            }

            .upload-icon {
                font-size: 3rem;
                color: rgba(255, 255, 255, 0.6);
                margin-bottom: 1rem;
            }

            .upload-title {
                font-size: 1.1rem;
                color: var(--white);
                font-weight: 600;
                margin-bottom: 0.5rem;
            }

            .upload-subtitle {
                font-size: 0.9rem;
                color: rgba(255, 255, 255, 0.7);
                margin: 0;
            }

            .image-preview {
                position: relative;
                border-radius: 15px;
                overflow: hidden;
                background: var(--glass-bg);
                border: 1px solid var(--glass-border);
                margin-top: 1rem;
            }

            .image-preview img {
                width: 100%;
                height: 200px;
                object-fit: cover;
            }

            /* Foto Utama Badge */
            .main-photo-badge {
                position: absolute;
                top: 10px;
                left: 10px;
                background: rgba(59, 130, 246, 0.9);
                color: white;
                padding: 0.5rem 1rem;
                border-radius: 20px;
                font-size: 0.8rem;
                font-weight: 600;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            }

            /* Photos Preview Grid */
            .photos-preview {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
                gap: 1rem;
                margin-top: 1rem;
            }

            .photo-item {
                position: relative;
                border-radius: 10px;
                overflow: hidden;
                background: var(--glass-bg);
                border: 1px solid var(--glass-border);
                aspect-ratio: 1;
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

            .remove-photo {
                position: absolute;
                top: 10px;
                right: 10px;
                width: 25px;
                height: 25px;
                border-radius: 50%;
                background: rgba(239, 68, 68, 0.9);
                color: var(--white);
                border: none;
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: all 0.3s ease;
                z-index: 2;
            }

            .remove-photo:hover {
                background: #dc2626;
                transform: scale(1.1);
            }

            /* Responsive Design for Photos */
            @media (max-width: 768px) {
                .photos-preview {
                    grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
                    gap: 0.5rem;
                }

                .main-photo-badge {
                    font-size: 0.7rem;
                    padding: 0.3rem 0.8rem;
                }
            }

            /* Input Help */
            .input-help {
                margin-top: 0.5rem;
                font-size: 0.85rem;
                color: rgba(255, 255, 255, 0.7);
                display: flex;
                align-items: center;
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

            /* Step Navigation */
            .step-navigation {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-top: 3rem;
                gap: 1rem;
            }

            .step-navigation .glass-btn {
                min-width: 150px;
            }

            /* Review Card */
            .review-card {
                background: var(--glass-bg);
                border: 1px solid var(--glass-border);
                border-radius: 20px;
                overflow: hidden;
                margin-bottom: 2rem;
            }

            .review-header {
                background: var(--glass-bg-light);
                padding: 1.5rem;
                border-bottom: 1px solid var(--glass-border);
            }

            .review-header h5 {
                color: var(--white);
                margin: 0;
                font-family: 'Poppins', sans-serif;
                font-weight: 600;
            }

            .review-content {
                padding: 2rem;
            }

            .review-image {
                margin-bottom: 2rem;
            }

            .placeholder-image {
                background: var(--glass-bg);
                border: 2px dashed var(--glass-border);
                border-radius: 15px;
                height: 200px;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                color: rgba(255, 255, 255, 0.6);
                font-size: 1rem;
            }

            .placeholder-image i {
                font-size: 3rem;
                margin-bottom: 1rem;
            }

            .review-details {
                display: grid;
                gap: 1rem;
            }

            .review-item {
                display: flex;
                flex-direction: column;
                gap: 0.5rem;
            }

            .review-item label {
                font-weight: 600;
                color: rgba(255, 255, 255, 0.8);
                font-size: 0.9rem;
            }

            .review-item span {
                color: var(--white);
                font-size: 1rem;
                padding: 0.75rem;
                background: var(--glass-bg);
                border: 1px solid var(--glass-border);
                border-radius: 10px;
            }

            /* Info Notice */
            .info-notice {
                background: rgba(14, 165, 233, 0.1);
                border: 1px solid rgba(14, 165, 233, 0.3);
                border-radius: 15px;
                padding: 1.5rem;
                margin-bottom: 2rem;
                display: flex;
                gap: 1rem;
            }

            .notice-icon {
                flex-shrink: 0;
                width: 40px;
                height: 40px;
                background: rgba(14, 165, 233, 0.2);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                color: #0ea5e9;
                font-size: 1.2rem;
            }

            .notice-content h6 {
                color: var(--white);
                margin-bottom: 1rem;
                font-family: 'Poppins', sans-serif;
            }

            .notice-content ul {
                margin: 0;
                padding-left: 1.5rem;
                color: rgba(255, 255, 255, 0.8);
            }

            .notice-content li {
                margin-bottom: 0.5rem;
                line-height: 1.5;
            }

            /* Help Panel */
            .help-panel {
                padding: 2rem;
            }

            .help-header h6 {
                color: var(--white);
                margin-bottom: 1.5rem;
                font-family: 'Poppins', sans-serif;
                font-size: 1.1rem;
            }

            .help-content {
                display: grid;
                gap: 1.5rem;
            }

            .help-item {
                display: flex;
                gap: 1rem;
                align-items: flex-start;
            }

            .help-icon {
                flex-shrink: 0;
                width: 40px;
                height: 40px;
                background: var(--gradient-secondary);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                color: var(--white);
                font-size: 1rem;
            }

            .help-item strong {
                color: var(--white);
                display: block;
                margin-bottom: 0.5rem;
                font-family: 'Poppins', sans-serif;
            }

            .help-item p {
                color: rgba(255, 255, 255, 0.8);
                margin: 0;
                line-height: 1.5;
                font-size: 0.9rem;
            }

            /* Loading State */
            .btn-loading {
                opacity: 0.8;
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

                .form-step {
                    padding: 0 1.5rem 1.5rem;
                }

                .form-progress {
                    flex-direction: column;
                    gap: 1rem;
                }

                .progress-line {
                    width: 2px;
                    height: 40px;
                    margin: 0;
                    margin-left: 24px;
                }

                .step-navigation {
                    flex-direction: column;
                }

                .step-navigation .glass-btn {
                    width: 100%;
                }

                .upload-area {
                    padding: 2rem 1rem;
                }

                .help-panel {
                    padding: 1.5rem;
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

                .glass-input {
                    padding: 0.875rem 0.875rem 0.875rem 2.75rem;
                }

                .input-icon {
                    left: 0.875rem;
                }

                .input-currency {
                    right: 0.875rem;
                }

                .suggestion-tags {
                    gap: 0.25rem;
                }

                .suggestion-tag {
                    font-size: 0.75rem;
                    padding: 0.3rem 0.6rem;
                }

                .help-content {
                    gap: 1rem;
                }

                .help-item {
                    flex-direction: column;
                    text-align: center;
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
            .glass-input:focus,
            .glass-textarea:focus,
            .glass-btn:focus {
                outline: 2px solid rgba(255, 255, 255, 0.5);
                outline-offset: 2px;
            }
        </style>
    @endpush

    @push('styles')
        <!-- Leaflet CSS -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    @endpush

    @push('scripts')
        <!-- Leaflet JS -->
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
        <script>
            let currentStep = 1;
            const totalSteps = 3;

            // Step Navigation
            document.querySelectorAll('.next-step').forEach(btn => {
                btn.addEventListener('click', function() {
                    if (validateCurrentStep()) {
                        nextStep();
                    }
                });
            });

            document.querySelectorAll('.prev-step').forEach(btn => {
                btn.addEventListener('click', function() {
                    prevStep();
                });
            });

            function nextStep() {
                if (currentStep < totalSteps) {
                    document.getElementById(`step${currentStep}`).classList.remove('active');
                    document.querySelector(`.progress-step:nth-child(${currentStep * 2 - 1})`).classList.remove('active');

                    currentStep++;
                    document.getElementById(`step${currentStep}`).classList.add('active');
                    document.querySelector(`.progress-step:nth-child(${currentStep * 2 - 1})`).classList.add('active');

                    if (currentStep === 3) {
                        updateReview();
                    }
                }
            }

            function prevStep() {
                if (currentStep > 1) {
                    document.getElementById(`step${currentStep}`).classList.remove('active');
                    document.querySelector(`.progress-step:nth-child(${currentStep * 2 - 1})`).classList.remove('active');

                    currentStep--;
                    document.getElementById(`step${currentStep}`).classList.add('active');
                    document.querySelector(`.progress-step:nth-child(${currentStep * 2 - 1})`).classList.add('active');
                }
            }

            function validateCurrentStep() {
                if (currentStep === 1) {
                    const namaKos = document.getElementById('nama_kos').value.trim();
                    const lokasi = document.getElementById('lokasi').value.trim();
                    const harga = document.getElementById('harga').value.trim();

                    if (!namaKos || !lokasi || !harga) {
                        alert('Mohon lengkapi semua field yang wajib diisi');
                        return false;
                    }
                }
                return true;
            }

            // Price Formatter
            document.getElementById('harga').addEventListener('input', function() {
                const value = parseInt(this.value);
                const preview = document.getElementById('pricePreview');

                if (value && value > 0) {
                    const formatted = new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        minimumFractionDigits: 0
                    }).format(value);
                    preview.innerHTML = `<i class="fas fa-info-circle me-1"></i>Preview: ${formatted} per bulan`;
                    preview.style.color = '#4facfe';
                } else {
                    preview.innerHTML = '';
                }
            });

            // Character Counter
            document.getElementById('deskripsi').addEventListener('input', function() {
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

            // Facility Suggestions
            function addFacility(facility) {
                const textarea = document.getElementById('fasilitas');
                const currentValue = textarea.value.trim();

                if (currentValue === '') {
                    textarea.value = facility;
                } else {
                    // Check if facility already exists
                    const facilities = currentValue.split(',').map(f => f.trim().toLowerCase());
                    if (!facilities.includes(facility.toLowerCase())) {
                        textarea.value = currentValue + ', ' + facility;
                    }
                }

                // Add visual feedback
                event.target.style.background = 'var(--gradient-success)';
                event.target.style.color = 'var(--white)';
                setTimeout(() => {
                    event.target.style.background = 'var(--glass-bg)';
                    event.target.style.color = 'rgba(255, 255, 255, 0.8)';
                }, 1000);
            }

            // Foto Utama Upload
            const fotoUtama = document.getElementById('fotoUtama');
            const mainPhotoUpload = document.getElementById('mainPhotoUpload');
            const mainImagePreview = document.getElementById('mainImagePreview');
            const mainPreviewImg = document.getElementById('mainPreviewImg');

            fotoUtama.addEventListener('change', handleMainPhotoSelect);
            mainPhotoUpload.querySelector('.upload-area').addEventListener('dragover', handleMainDragOver);
            mainPhotoUpload.querySelector('.upload-area').addEventListener('dragleave', handleMainDragLeave);
            mainPhotoUpload.querySelector('.upload-area').addEventListener('drop', handleMainDrop);
            mainPhotoUpload.querySelector('.upload-area').addEventListener('click', () => fotoUtama.click());

            function handleMainPhotoSelect(e) {
                const file = e.target.files[0];
                if (file) {
                    displayMainPhoto(file);
                }
            }

            function handleMainDragOver(e) {
                e.preventDefault();
                e.target.classList.add('drop-zone');
            }

            function handleMainDragLeave(e) {
                e.preventDefault();
                e.target.classList.remove('drop-zone');
            }

            function handleMainDrop(e) {
                e.preventDefault();
                e.target.classList.remove('drop-zone');
                const file = e.dataTransfer.files[0];
                if (file && file.type.startsWith('image/')) {
                    fotoUtama.files = e.dataTransfer.files;
                    displayMainPhoto(file);
                }
            }

            function displayMainPhoto(file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    mainPreviewImg.src = e.target.result;
                    mainPhotoUpload.querySelector('.upload-area').style.display = 'none';
                    mainImagePreview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }

            function removeMainPhoto() {
                fotoUtama.value = '';
                mainPhotoUpload.querySelector('.upload-area').style.display = 'block';
                mainImagePreview.style.display = 'none';
                mainPreviewImg.src = '';
            }

            // Foto Tambahan Upload
            const fotoTambahan = document.getElementById('fotoTambahan');
            const additionalPhotosUpload = document.getElementById('additionalPhotosUpload');
            const additionalPhotosPreview = document.getElementById('additionalPhotosPreview');

            fotoTambahan.addEventListener('change', handleAdditionalPhotosSelect);
            additionalPhotosUpload.querySelector('.upload-area').addEventListener('dragover', handleAdditionalDragOver);
            additionalPhotosUpload.querySelector('.upload-area').addEventListener('dragleave', handleAdditionalDragLeave);
            additionalPhotosUpload.querySelector('.upload-area').addEventListener('drop', handleAdditionalDrop);
            additionalPhotosUpload.querySelector('.upload-area').addEventListener('click', () => fotoTambahan.click());

            function handleFileSelect(e) {
                const file = e.target.files[0];
                if (file) {
                    displayImage(file);
                }
            }

            function handleAdditionalPhotosSelect(e) {
                const files = Array.from(e.target.files);
                if (files.length > 5) {
                    alert('Maksimal 5 foto tambahan yang diperbolehkan');
                    fotoTambahan.value = '';
                    return;
                }
                handleAdditionalPhotos(files);
            }

            function handleAdditionalDragOver(e) {
                e.preventDefault();
                e.target.classList.add('drop-zone');
            }

            function handleAdditionalDragLeave(e) {
                e.preventDefault();
                e.target.classList.remove('drop-zone');
            }

            function handleAdditionalDrop(e) {
                e.preventDefault();
                e.target.classList.remove('drop-zone');
                const files = Array.from(e.dataTransfer.files).filter(file => file.type.startsWith('image/'));
                if (files.length > 5) {
                    alert('Maksimal 5 foto tambahan yang diperbolehkan');
                    return;
                }
                fotoTambahan.files = e.dataTransfer.files;
                handleAdditionalPhotos(files);
            }

            function handleAdditionalPhotos(files) {
                additionalPhotosPreview.innerHTML = ''; // Clear existing previews
                files.forEach((file, index) => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const photoDiv = document.createElement('div');
                        photoDiv.className = 'photo-item';
                        photoDiv.innerHTML = `
                            <img src="${e.target.result}" alt="Preview ${index + 1}">
                            <button type="button" class="remove-photo" onclick="removeAdditionalPhoto(this)">
                                <i class="fas fa-times"></i>
                            </button>
                        `;
                        additionalPhotosPreview.appendChild(photoDiv);
                    };
                    reader.readAsDataURL(file);
                });
            }

            function removeAdditionalPhoto(button) {
                const photoItem = button.closest('.photo-item');
                photoItem.remove();
                
                // Reset file input if all photos are removed
                if (additionalPhotosPreview.children.length === 0) {
                    fotoTambahan.value = '';
                }
            }

            // Update Review
            function updateReview() {
                document.getElementById('reviewNama').textContent = 
                    document.getElementById('nama_kos').value || '-';

                document.getElementById('reviewLokasi').textContent = 
                    document.getElementById('lokasi').value || '-';

                const harga = document.getElementById('harga').value;
                if (harga) {
                    const formatted = new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        minimumFractionDigits: 0
                    }).format(parseInt(harga));
                    document.getElementById('reviewHarga').textContent = formatted + ' per bulan';
                } else {
                    document.getElementById('reviewHarga').textContent = '-';
                }

                document.getElementById('reviewFasilitas').textContent = 
                    document.getElementById('fasilitas').value || '-';

                document.getElementById('reviewDeskripsi').textContent = 
                    document.getElementById('deskripsi').value || '-';

                // Update image preview
                const reviewImageContainer = document.getElementById('reviewImageContainer');
                if (previewImg.src) {
                    reviewImageContainer.innerHTML = `<img src="${previewImg.src}" style="width: 100%; height: 200px; object-fit: cover; border-radius: 15px;">`;
                } else {
                    reviewImageContainer.innerHTML = `
                        <div class="placeholder-image">
                            <i class="fas fa-image"></i>
                            <span>Foto akan muncul di sini</span>
                        </div>
                    `;
                }
            }

            // Form Submission
            document.querySelector('.kos-form').addEventListener('submit', function(e) {
                const submitBtn = document.querySelector('.submit-btn');
                const btnText = submitBtn.querySelector('.btn-text');
                const btnLoading = submitBtn.querySelector('.btn-loading');

                btnText.style.display = 'none';
                btnLoading.style.display = 'inline-flex';
                submitBtn.disabled = true;

                // Show progress
                let progress = 0;
                const progressInterval = setInterval(() => {
                    progress += 10;
                    if (progress >= 90) {
                        clearInterval(progressInterval);
                    }
                }, 200);
            });

            // Real-time validation
            document.querySelectorAll('.glass-input, .glass-textarea').forEach(input => {
                input.addEventListener('blur', function() {
                    if (this.hasAttribute('required') && !this.value.trim()) {
                        this.classList.add('is-invalid');
                    } else {
                        this.classList.remove('is-invalid');
                    }
                });

                input.addEventListener('input', function() {
                    if (this.classList.contains('is-invalid') && this.value.trim()) {
                        this.classList.remove('is-invalid');
                    }
                });
            });

            // Auto-save draft (optional)
            let autoSaveTimer;
            document.querySelectorAll('.glass-input, .glass-textarea').forEach(input => {
                input.addEventListener('input', function() {
                    clearTimeout(autoSaveTimer);
                    autoSaveTimer = setTimeout(() => {
                        saveDraft();
                    }, 2000);
                });
            });

            function saveDraft() {
                const formData = {
                    nama_kos: document.getElementById('nama_kos').value,
                    lokasi: document.getElementById('lokasi').value,
                    harga: document.getElementById('harga').value,
                    fasilitas: document.getElementById('fasilitas').value,
                    deskripsi: document.getElementById('deskripsi').value,
                    timestamp: new Date().getTime()
                };

                localStorage.setItem('kosDraft', JSON.stringify(formData));
                console.log('Draft saved automatically');
            }

            // Initialize Map
            let map;
            let marker;
            
            function initMap() {
                // Default center (Indonesia)
                const defaultLat = -6.2088;
                const defaultLng = 106.8456;
                
                // Create map
                map = L.map('map').setView([defaultLat, defaultLng], 13);
                
                // Add tile layer (OpenStreetMap)
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap contributors'
                }).addTo(map);
                
                // Add marker if coordinates exist
                const lat = document.getElementById('latitude').value;
                const lng = document.getElementById('longitude').value;
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

            // Load draft on page load
            window.addEventListener('load', function() {
                const draft = localStorage.getItem('kosDraft');
                if (draft) {
                    const data = JSON.parse(draft);
                    // Only load if draft is less than 24 hours old
                    if (new Date().getTime() - data.timestamp < 24 * 60 * 60 * 1000) {
                        if (confirm('Ditemukan draft yang belum selesai. Apakah ingin melanjutkan?')) {
                            document.getElementById('nama_kos').value = data.nama_kos || '';
                            document.getElementById('lokasi').value = data.lokasi || '';
                            document.getElementById('harga').value = data.harga || '';
                            document.getElementById('fasilitas').value = data.fasilitas || '';
                            document.getElementById('deskripsi').value = data.deskripsi || '';

                            // Update character count
                            document.getElementById('charCount').textContent = data.deskripsi ? data.deskripsi.length : 0;
                        }
                    }
                }
            });

            // Clear draft on successful submission
            window.addEventListener('beforeunload', function() {
                // Only clear if form was submitted successfully
                if (document.querySelector('.submit-btn').disabled) {
                    localStorage.removeItem('kosDraft');
                }
            });

            // Enhanced form interactions
            document.querySelectorAll('.glass-input, .glass-textarea').forEach(input => {
                input.addEventListener('focus', function() {
                    this.closest('.glass-input-wrapper, .glass-textarea-wrapper').classList.add('focused');
                });

                input.addEventListener('blur', function() {
                    this.closest('.glass-input-wrapper, .glass-textarea-wrapper').classList.remove('focused');
                });
            });

            // Smooth scroll to top when changing steps
            function scrollToTop() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            }

            // Add scroll to step navigation
            document.querySelectorAll('.next-step, .prev-step').forEach(btn => {
                btn.addEventListener('click', function() {
                    setTimeout(scrollToTop, 100);
                });
            });

            // Keyboard navigation
            document.addEventListener('keydown', function(e) {
                if (e.ctrlKey || e.metaKey) {
                    switch(e.key) {
                        case 'Enter':
                            if (currentStep < totalSteps) {
                                e.preventDefault();
                                if (validateCurrentStep()) {
                                    nextStep();
                                }
                            }
                            break;
                        case 's':
                            e.preventDefault();
                            saveDraft();
                            // Show save notification
                            showNotification('Draft tersimpan', 'success');
                            break;
                    }
                }
            });

            // Notification system
            function showNotification(message, type = 'info') {
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
                        document.body.removeChild(notification);
                    }, 300);
                }, 3000);
            }

            // Add notification styles
            const notificationStyles = `
                .notification {
                    position: fixed;
                    top: 100px;
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
                }

                .notification.show {
                    transform: translateX(0);
                }

                .notification-success {
                    border-color: rgba(34, 197, 94, 0.3);
                    background: rgba(34, 197, 94, 0.1);
                }

                .notification-info {
                    border-color: rgba(14, 165, 233, 0.3);
                    background: rgba(14, 165, 233, 0.1);
                }
            `;

            const styleSheet = document.createElement('style');
            styleSheet.textContent = notificationStyles;
            document.head.appendChild(styleSheet);
        </script>
    @endpush
@endsection