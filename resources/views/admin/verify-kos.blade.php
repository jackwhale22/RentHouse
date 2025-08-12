@extends('layouts.app')

@section('title', 'Verifikasi Kos - Dashboard Admin')

@section('content')
    <div class="container-fluid glassmorphism-verification">
        <div class="container py-5">
            <!-- Page Header -->
            <div class="row mb-5">
                <div class="col-12">
                    <div class="glass-card page-header">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <div class="header-content">
                                <div class="header-icon">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div class="header-text">
                                    <h1 class="page-title">Verifikasi Kos</h1>
                                    <p class="page-subtitle">Tinjau dan verifikasi listing kos yang menunggu persetujuan
                                        ({{ $pendingKos->total() }} menunggu)</p>
                                </div>
                            </div>
                            <div class="header-stats">
                                <div class="stat-item">
                                    <span class="stat-number">{{ $pendingKos->total() }}</span>
                                    <span class="stat-label">Menunggu</span>
                                </div>
                                <div class="stat-divider"></div>
                                <div class="stat-item">
                                    <span
                                        class="stat-number">{{ \App\Models\Kos::where('is_verified', true)->whereDate('updated_at', today())->count() }}</span>
                                    <span class="stat-label">Hari Ini</span>
                                </div>
                                <div class="stat-divider"></div>
                                <div class="header-actions-group">
                                    <button type="button" class="glass-btn glass-btn-outline" onclick="showReportModal()">
                                        <i class="fas fa-print me-2"></i>Cetak Laporan
                                    </button>
                                    <a href="{{ route('admin.dashboard') }}" class="glass-btn glass-btn-outline">
                                        <i class="fas fa-arrow-left me-2"></i>Dashboard
                                    </a>
                                </div>
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

            <!-- Error Alert -->
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

            <!-- Filter & Search -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="glass-card filter-card">
                        <div class="filter-header">
                            <h5 class="filter-title">
                                <i class="fas fa-filter me-2"></i>Filter & Pencarian
                            </h5>
                        </div>

                        <div class="filter-controls">
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <label class="glass-label">
                                        <i class="fas fa-check-circle me-2"></i>Status Verifikasi
                                    </label>
                                    <div class="glass-select-wrapper">
                                        <select class="glass-select" id="statusFilter">
                                            <option value="">Semua Status</option>
                                            <option value="pending">Menunggu</option>
                                            <option value="verified">Terverifikasi</option>
                                        </select>
                                        <div class="select-icon">
                                            <i class="fas fa-chevron-down"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label class="glass-label">
                                        <i class="fas fa-search me-2"></i>Cari Kos
                                    </label>
                                    <div class="glass-input-wrapper">
                                        <input type="text" class="glass-input" id="searchInput"
                                            placeholder="Cari berdasarkan nama kos atau pemilik...">
                                        <div class="input-icon">
                                            <i class="fas fa-search"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label class="glass-label">
                                        <i class="fas fa-sort me-2"></i>Urutkan
                                    </label>
                                    <div class="glass-select-wrapper">
                                        <select class="glass-select" id="sortFilter">
                                            <option value="newest">Terbaru</option>
                                            <option value="oldest">Terlama</option>
                                            <option value="name_asc">Nama A-Z</option>
                                            <option value="name_desc">Nama Z-A</option>
                                            <option value="price_asc">Harga Terendah</option>
                                            <option value="price_desc">Harga Tertinggi</option>
                                        </select>
                                        <div class="select-icon">
                                            <i class="fas fa-chevron-down"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <label class="glass-label">&nbsp;</label>
                                    <button type="button" class="glass-btn glass-btn-outline w-100"
                                        onclick="resetFilters()">
                                        <i class="fas fa-refresh me-2"></i>Reset
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
                    <div class="glass-card kos-card">
                        @if($pendingKos->count() > 0)
                            <!-- View Toggle -->
                            <div class="view-toggle-wrapper">
                                <div class="btn-group view-toggle" role="group">
                                    <button type="button" class="glass-btn-sm active" data-view="cards" title="Tampilan Card">
                                        <i class="fas fa-th-large"></i>
                                    </button>
                                    <button type="button" class="glass-btn-sm" data-view="table" title="Tampilan Tabel">
                                        <i class="fas fa-list"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Card View -->
                            <div class="kos-view" id="cardsView">
                                <div class="kos-grid">
                                    @foreach($pendingKos as $kos)
                                        <div class="kos-card-item" data-status="{{ $kos->is_verified ? 'verified' : 'pending' }}"
                                            data-kos-id="{{ $kos->id }}" data-kos-name="{{ $kos->nama_kos }}"
                                            data-kos-location="{{ $kos->lokasi }}" data-kos-price="{{ $kos->harga }}"
                                            data-kos-description="{{ $kos->deskripsi ?? '' }}"
                                            data-kos-facilities="{{ $kos->fasilitas ?? '' }}"
                                            data-kos-photo="{{ $kos->mainPhoto ? asset($kos->mainPhoto->foto_path) : '' }}"
                                            data-kos-verified="{{ $kos->is_verified ? 'true' : 'false' }}"
                                            data-kos-created="{{ $kos->created_at->format('Y-m-d H:i:s') }}"
                                            data-owner-name="{{ $kos->pemilik->name }}"
                                            data-owner-email="{{ $kos->pemilik->email }}"
                                            data-owner-phone="{{ $kos->pemilik->phone ?? '' }}"
                                            data-owner-joined="{{ $kos->pemilik->created_at->format('Y-m-d H:i:s') }}">
                                            <div class="glass-kos-card">
                                                <!-- Kos Image -->
                                                <div class="kos-image-container">
                                    @if($kos->mainPhoto)
                                        <img src="{{ asset($kos->mainPhoto->foto_path) }}" alt="{{ $kos->nama_kos }}" class="kos-image">
                                    @else
                                        <div class="kos-image-placeholder">
                                            <i class="fas fa-home placeholder-icon"></i>
                                            <p class="placeholder-text">Tidak Ada Gambar</p>
                                        </div>
                                    @endif                                                    <!-- Status Badge -->
                                                    <div class="status-badge-container">
                                                        @if($kos->is_verified)
                                                            <div class="enhanced-badge enhanced-badge-sm status-verified">
                                                                <div class="badge-icon">
                                                                    <i class="fas fa-check"></i>
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
                                                    </div>
                                                </div>

                                                <!-- Kos Content -->
                                                <div class="kos-content">
                                                    <!-- Kos Header -->
                                                    <div class="kos-header">
                                                        <div class="kos-date">
                                                            <i class="fas fa-calendar-alt me-1"></i>
                                                            {{ $kos->created_at->format('d/m/Y H:i') }}
                                                        </div>
                                                    </div>

                                                    <!-- Kos Info -->
                                                    <div class="kos-info">
                                                        <h6 class="kos-name">{{ $kos->nama_kos }}</h6>
                                                        <div class="kos-location">
                                                            <i class="fas fa-map-marker-alt me-2"></i>
                                                            <span>{{ Str::limit($kos->lokasi, 40) }}</span>
                                                        </div>
                                                        <div class="kos-price">
                                                            <i class="fas fa-money-bill-wave me-2"></i>
                                                            <strong>Rp {{ number_format($kos->harga, 0, ',', '.') }}</strong>
                                                            <small>/bulan</small>
                                                        </div>

                                                        @if($kos->fasilitas)
                                                            <div class="kos-facilities">
                                                                <i class="fas fa-star me-2"></i>
                                                                <span>{{ Str::limit($kos->fasilitas, 50) }}</span>
                                                            </div>
                                                        @endif

                                                        @if($kos->deskripsi)
                                                            <div class="kos-description">
                                                                <i class="fas fa-align-left me-2"></i>
                                                                <span>{{ Str::limit($kos->deskripsi, 80) }}</span>
                                                            </div>
                                                        @endif
                                                    </div>

                                                    <!-- Owner Info -->
                                                    <div class="owner-info">
                                                        <div class="owner-avatar">
                                                            <i class="fas fa-user"></i>
                                                        </div>
                                                        <div class="owner-details">
                                                            <h6 class="owner-name">{{ $kos->pemilik->name }}</h6>
                                                            <div class="owner-contact">
                                                                <small>
                                                                    <i class="fas fa-envelope me-1"></i>{{ $kos->pemilik->email }}
                                                                </small>
                                                                @if($kos->pemilik->phone)
                                                                    <br>
                                                                    <small>
                                                                        <i class="fas fa-phone me-1"></i>{{ $kos->pemilik->phone }}
                                                                    </small>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Action Buttons -->
                                                    <div class="kos-actions">
                                                        @if(!$kos->is_verified)
                                                            <form action="{{ route('admin.kos.approve', $kos->id) }}" method="POST"
                                                                class="d-inline approve-form">
                                                                @csrf
                                                                <button type="submit" class="glass-btn glass-btn-success action-btn"
                                                                    onclick="return confirm('Apakah Anda yakin ingin menyetujui kos ini?')">
                                                                    <i class="fas fa-check me-2"></i>Setujui
                                                                </button>
                                                            </form>

                                                            <button type="button" class="glass-btn glass-btn-danger action-btn"
                                                                onclick="rejectKos({{ $kos->id }}, '{{ $kos->nama_kos }}')">
                                                                <i class="fas fa-times me-2"></i>Tolak
                                                            </button>
                                                        @endif

                                                        <button type="button" class="glass-btn glass-btn-outline action-btn"
                                                            onclick="viewKosDetails(this)">
                                                            <i class="fas fa-info-circle me-2"></i>Detail
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Table View -->
                            <div class="kos-view" id="tableView" style="display: none;">
                                <div class="glass-table-wrapper">
                                    <div class="table-responsive">
                                        <table class="glass-table">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <i class="fas fa-calendar-alt me-2"></i>Tanggal
                                                    </th>
                                                    <th>
                                                        <i class="fas fa-home me-2"></i>Kos
                                                    </th>
                                                    <th>
                                                        <i class="fas fa-user me-2"></i>Pemilik
                                                    </th>
                                                    <th>
                                                        <i class="fas fa-money-bill-wave me-2"></i>Harga
                                                    </th>
                                                    <th>
                                                        <i class="fas fa-map-marker-alt me-2"></i>Lokasi
                                                    </th>
                                                    <th>
                                                        <i class="fas fa-check-circle me-2"></i>Status
                                                    </th>
                                                    <th>
                                                        <i class="fas fa-cogs me-2"></i>Aksi
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($pendingKos as $kos)
                                                    <tr class="table-row"
                                                        data-status="{{ $kos->is_verified ? 'verified' : 'pending' }}"
                                                        data-kos-id="{{ $kos->id }}" data-kos-name="{{ $kos->nama_kos }}"
                                                        data-kos-location="{{ $kos->lokasi }}" data-kos-price="{{ $kos->harga }}"
                                                        data-kos-description="{{ $kos->deskripsi ?? '' }}"
                                                        data-kos-facilities="{{ $kos->fasilitas ?? '' }}"
                                                        data-kos-photo="{{ $kos->mainPhoto ? asset($kos->mainPhoto->foto_path) : '' }}"
                                                        data-kos-verified="{{ $kos->is_verified ? 'true' : 'false' }}"
                                                        data-kos-created="{{ $kos->created_at->format('Y-m-d H:i:s') }}"
                                                        data-owner-name="{{ $kos->pemilik->name }}"
                                                        data-owner-email="{{ $kos->pemilik->email }}"
                                                        data-owner-phone="{{ $kos->pemilik->phone ?? '' }}"
                                                        data-owner-joined="{{ $kos->pemilik->created_at->format('Y-m-d H:i:s') }}">
                                                        <td>
                                                            <div class="date-info">
                                                                <div class="date-primary">
                                                                    {{ $kos->created_at->format('d/m/Y') }}
                                                                </div>
                                                                <div class="date-secondary">
                                                                    {{ $kos->created_at->format('H:i') }}
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="kos-table-info">
                                                                <div class="kos-table-name">{{ $kos->nama_kos }}</div>
                                                                @if($kos->fasilitas)
                                                                    <div class="kos-table-facilities">
                                                                        <small>{{ Str::limit($kos->fasilitas, 30) }}</small>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="owner-table-info">
                                                                <div class="owner-table-name">{{ $kos->pemilik->name }}</div>
                                                                <div class="owner-table-contact">
                                                                    <small>{{ $kos->pemilik->email }}</small>
                                                                    @if($kos->pemilik->phone)
                                                                        <br><small>{{ $kos->pemilik->phone }}</small>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="price-info">
                                                                <div class="price-amount">Rp
                                                                    {{ number_format($kos->harga, 0, ',', '.') }}
                                                                </div>
                                                                <div class="price-period">/bulan</div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="location-preview">
                                                                {{ Str::limit($kos->lokasi, 30) }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            @if($kos->is_verified)
                                                                <div class="enhanced-badge enhanced-badge-xs status-verified">
                                                                    <div class="badge-icon">
                                                                        <i class="fas fa-check"></i>
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
                                                                @if(!$kos->is_verified)
                                                                    <form action="{{ route('admin.kos.approve', $kos->id) }}"
                                                                        method="POST" class="d-inline">
                                                                        @csrf
                                                                        <button type="submit" class="glass-btn-sm glass-btn-success"
                                                                            title="Setujui"
                                                                            onclick="return confirm('Apakah Anda yakin ingin menyetujui kos ini?')">
                                                                            <i class="fas fa-check"></i>
                                                                        </button>
                                                                    </form>
                                                                    <button type="button" class="glass-btn-sm glass-btn-danger"
                                                                        title="Tolak"
                                                                        onclick="rejectKos({{ $kos->id }}, '{{ $kos->nama_kos }}')">
                                                                        <i class="fas fa-times"></i>
                                                                    </button>
                                                                @endif
                                                                <button type="button" class="glass-btn-sm glass-btn-primary"
                                                                    title="Detail" onclick="viewKosDetails(this)">
                                                                    <i class="fas fa-eye"></i>
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
                                        {{ $pendingKos->links() }}
                                    </div>
                                </div>
                            </div>
                        @else
                            <!-- Empty State -->
                            <div class="empty-state">
                                <div class="empty-icon">
                                    <i class="fas fa-check-double"></i>
                                </div>
                                <h4 class="empty-title">Semua Sudah Diverifikasi!</h4>
                                <p class="empty-description">
                                    Tidak ada kos yang menunggu verifikasi saat ini. Semua listing telah ditinjau dan
                                    diverifikasi.
                                </p>
                                <div class="empty-actions">
                                    <a href="{{ route('admin.dashboard') }}" class="glass-btn glass-btn-primary">
                                        <i class="fas fa-arrow-left me-2"></i>Kembali ke Dashboard
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Kos Details Modal -->
    <div class="modal fade" id="kosDetailsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content glass-modal">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-home text-primary me-2"></i>
                        Detail Kos
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body" id="kosDetailsContent">
                    <!-- Kos details will be loaded here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="glass-btn glass-btn-outline" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Reject Confirmation Modal -->
    <div class="modal fade" id="rejectKosModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content glass-modal">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-exclamation-triangle text-warning me-2"></i>
                        Konfirmasi Penolakan
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <p class="modal-text">Apakah Anda yakin ingin menolak kos <strong id="rejectKosName"></strong>?</p>
                    <p class="modal-warning">
                        <i class="fas fa-info-circle me-2"></i>
                        Tindakan ini akan menghapus listing kos secara permanen dan tidak dapat dibatalkan. Pemilik perlu
                        mengajukan ulang jika ingin mendaftarkan properti ini kembali.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="glass-btn glass-btn-outline" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Batal
                    </button>
                    <form id="rejectKosForm" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="glass-btn glass-btn-danger">
                            <i class="fas fa-times me-2"></i>Ya, Tolak
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Report Modal -->
    <div class="modal fade" id="reportModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content glass-modal">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-print text-primary me-2"></i>
                        Cetak Laporan Verifikasi
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <form id="reportForm" method="POST" action="{{ route('admin.verification.print-report') }}"
                        target="_blank">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="glass-label">
                                    <i class="fas fa-calendar me-2"></i>Tanggal Mulai
                                </label>
                                <input type="date" class="glass-input" name="start_date" id="startDate"
                                    value="{{ \Carbon\Carbon::now()->startOfMonth()->format('Y-m-d') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="glass-label">
                                    <i class="fas fa-calendar me-2"></i>Tanggal Akhir
                                </label>
                                <input type="date" class="glass-input" name="end_date" id="endDate"
                                    value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required>
                            </div>
                            <div class="col-md-12">
                                <label class="glass-label">
                                    <i class="fas fa-check-circle me-2"></i>Status Verifikasi
                                </label>
                                <div class="glass-select-wrapper">
                                    <select class="glass-select" name="status">
                                        <option value="">Semua Status</option>
                                        <option value="pending">Menunggu</option>
                                        <option value="verified">Terverifikasi</option>
                                    </select>
                                    <div class="select-icon">
                                        <i class="fas fa-chevron-down"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="report-preview mt-4">
                            <div class="preview-header">
                                <h6 class="preview-title">
                                    <i class="fas fa-eye me-2"></i>Preview Laporan
                                </h6>
                            </div>
                            <div class="preview-content" id="reportPreview">
                                <div class="preview-placeholder">
                                    <i class="fas fa-chart-bar"></i>
                                    <p>Pilih rentang tanggal untuk melihat preview</p>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="glass-btn glass-btn-outline" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Batal
                    </button>
                    <div class="btn-group report-actions">
                        <button type="button" class="glass-btn glass-btn-primary" onclick="printReport()">
                            <i class="fas fa-print me-2"></i>Cetak
                        </button>
                        <button type="button" class="glass-btn glass-btn-info" onclick="exportPDF()">
                            <i class="fas fa-file-pdf me-2"></i>PDF
                        </button>
                        <button type="button" class="glass-btn glass-btn-success" onclick="exportExcel()">
                            <i class="fas fa-file-excel me-2"></i>Excel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            /* Same base styles as messages page */
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

            .glassmorphism-verification {
                background: var(--gradient-background);
                min-height: 100vh;
                position: relative;
                overflow-x: hidden;
            }

            .glassmorphism-verification::before {
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

            .header-stats {
                display: flex;
                align-items: center;
                gap: 1.5rem;
                flex-wrap: wrap;
            }

            .header-actions-group {
                display: flex;
                gap: 0.75rem;
            }

            .stat-item {
                display: flex;
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .stat-number {
                font-family: 'Poppins', sans-serif;
                font-size: 1.8rem;
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
                height: 40px;
                background: linear-gradient(to bottom, transparent, rgba(255, 255, 255, 0.3), transparent);
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
            }

            .glass-alert-success {
                background: rgba(17, 153, 142, 0.1);
                border-color: rgba(17, 153, 142, 0.3);
            }

            .glass-alert-error {
                background: rgba(239, 68, 68, 0.1);
                border-color: rgba(239, 68, 68, 0.3);
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

            /* Filter Card */
            .filter-card {
                padding: 2.5rem;
            }

            .filter-header {
                margin-bottom: 2rem;
            }

            .filter-title {
                font-family: 'Poppins', sans-serif;
                font-size: 1.3rem;
                font-weight: 700;
                color: var(--white);
                margin: 0;
            }

            .filter-controls {
                margin-bottom: 1rem;
            }

            .glass-label {
                color: var(--white);
                font-weight: 600;
                font-size: 0.9rem;
                margin-bottom: 0.75rem;
                display: block;
                font-family: 'Inter', sans-serif;
            }

            /* Glass Form Elements */
            .glass-input-wrapper,
            .glass-select-wrapper {
                position: relative;
            }

            .glass-input,
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
            }

            .glass-input {
                padding-left: 3rem;
            }

            .glass-input:focus,
            .glass-select:focus {
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
            .select-icon {
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                color: rgba(255, 255, 255, 0.6);
                font-size: 0.9rem;
                pointer-events: none;
                z-index: 2;
            }

            .input-icon {
                left: 1rem;
            }

            .select-icon {
                right: 1rem;
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

            .glass-btn-success {
                background: var(--gradient-success);
                color: var(--white);
                border: none;
                box-shadow: 0 4px 20px rgba(17, 153, 142, 0.4);
            }

            .glass-btn-success:hover {
                box-shadow: 0 8px 30px rgba(17, 153, 142, 0.6);
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

            .glass-btn-info {
                background: var(--gradient-secondary);
                color: var(--white);
                border: none;
                box-shadow: 0 4px 20px rgba(79, 172, 254, 0.4);
            }

            .glass-btn-info:hover {
                box-shadow: 0 8px 30px rgba(79, 172, 254, 0.6);
                color: var(--white);
                transform: translateY(-2px);
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

            /* Kos Card */
            .kos-card {
                padding: 2.5rem;
                position: relative;
            }

            /* View Toggle */
            .view-toggle-wrapper {
                position: absolute;
                top: 2rem;
                right: 2.5rem;
                z-index: 10;
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

            /* Kos Grid (Card View) */
            .kos-grid {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
                gap: 2rem;
                margin-top: 3rem;
            }

            .kos-card-item {
                transition: all 0.3s ease;
            }

            .glass-kos-card {
                background: var(--glass-bg);
                border: 1px solid var(--glass-border);
                border-radius: 20px;
                padding: 0;
                transition: all 0.4s ease;
                display: flex;
                flex-direction: column;
                overflow: hidden;
                height: 100%;
            }

            .glass-kos-card:hover {
                transform: translateY(-5px);
                box-shadow: var(--glass-shadow-hover);
                background: var(--glass-bg-light);
            }

            /* Kos Image */
            .kos-image-container {
                position: relative;
                height: 200px;
                overflow: hidden;
            }

            .kos-image {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: transform 0.3s ease;
            }

            .glass-kos-card:hover .kos-image {
                transform: scale(1.05);
            }

            .kos-image-placeholder {
                width: 100%;
                height: 100%;
                background: var(--glass-bg-light);
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                color: rgba(255, 255, 255, 0.6);
            }

            .placeholder-icon {
                font-size: 3rem;
                margin-bottom: 0.5rem;
            }

            .placeholder-text {
                font-size: 0.9rem;
                margin: 0;
            }

            /* Status Badge Container */
            .status-badge-container {
                position: absolute;
                top: 1rem;
                right: 1rem;
                z-index: 10;
            }

            /* Kos Content */
            .kos-content {
                padding: 1.5rem;
                flex-grow: 1;
                display: flex;
                flex-direction: column;
            }

            .kos-header {
                margin-bottom: 1rem;
            }

            .kos-date {
                color: rgba(255, 255, 255, 0.8);
                font-size: 0.85rem;
                font-weight: 500;
            }

            .kos-info {
                margin-bottom: 1.5rem;
                flex-grow: 1;
            }

            .kos-name {
                font-family: 'Poppins', sans-serif;
                font-size: 1.2rem;
                font-weight: 700;
                color: var(--white);
                margin-bottom: 1rem;
                line-height: 1.3;
            }

            .kos-location,
            .kos-price,
            .kos-facilities,
            .kos-description {
                display: flex;
                align-items: flex-start;
                gap: 0.5rem;
                margin-bottom: 0.75rem;
                color: rgba(255, 255, 255, 0.9);
                font-size: 0.9rem;
                line-height: 1.4;
            }

            .kos-price strong {
                color: var(--white);
                font-size: 1rem;
            }

            .kos-price small {
                color: rgba(255, 255, 255, 0.6);
            }

            /* Owner Info */
            .owner-info {
                display: flex;
                align-items: center;
                gap: 1rem;
                margin-bottom: 1.5rem;
                background: var(--glass-bg-dark);
                border: 1px solid var(--glass-border);
                border-radius: 12px;
                padding: 1rem;
            }

            .owner-avatar {
                width: 50px;
                height: 50px;
                background: var(--gradient-secondary);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                color: var(--white);
                font-size: 1.2rem;
                flex-shrink: 0;
            }

            .owner-name {
                font-family: 'Poppins', sans-serif;
                font-size: 1.1rem;
                font-weight: 700;
                color: var(--white);
                margin-bottom: 0.25rem;
            }

            .owner-contact {
                color: rgba(255, 255, 255, 0.7);
                font-size: 0.85rem;
                line-height: 1.4;
            }

            /* Action Buttons */
            .kos-actions {
                display: flex;
                flex-wrap: wrap;
                gap: 0.75rem;
                margin-top: auto;
            }

            .action-btn {
                flex: 1;
                min-width: 100px;
                padding: 0.75rem 1rem;
                font-size: 0.85rem;
                text-align: center;
            }

            /* Table View Styles */
            .glass-table-wrapper {
                background: var(--glass-bg);
                border: 1px solid var(--glass-border);
                border-radius: 15px;
                overflow: hidden;
                margin-top: 3rem;
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

            .date-info .date-primary {
                color: var(--white);
                font-weight: 600;
                font-size: 0.95rem;
            }

            .date-info .date-secondary {
                color: rgba(255, 255, 255, 0.7);
                font-size: 0.8rem;
            }

            .kos-table-info .kos-table-name {
                color: var(--white);
                font-weight: 600;
                font-size: 0.95rem;
                margin-bottom: 0.25rem;
            }

            .kos-table-facilities {
                color: rgba(255, 255, 255, 0.7);
                font-size: 0.8rem;
            }

            .owner-table-info .owner-table-name {
                color: var(--white);
                font-weight: 600;
                font-size: 0.95rem;
                margin-bottom: 0.25rem;
            }

            .owner-table-contact {
                color: rgba(255, 255, 255, 0.7);
                font-size: 0.8rem;
                line-height: 1.3;
            }

            .price-info .price-amount {
                color: var(--white);
                font-weight: 600;
                font-size: 0.95rem;
            }

            .price-info .price-period {
                color: rgba(255, 255, 255, 0.7);
                font-size: 0.8rem;
            }

            .location-preview {
                color: rgba(255, 255, 255, 0.9);
                font-size: 0.9rem;
                line-height: 1.4;
            }

            .action-buttons {
                display: flex;
                gap: 0.5rem;
            }

            .glass-btn-sm.glass-btn-success {
                background: var(--gradient-success);
                color: var(--white);
                border: none;
                width: 36px;
                height: 36px;
                border-radius: 10px;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: all 0.3s ease;
                font-size: 0.9rem;
                text-decoration: none;
            }

            .glass-btn-sm.glass-btn-success:hover {
                background: var(--gradient-success);
                color: var(--white);
                transform: scale(1.1);
                box-shadow: 0 4px 15px rgba(17, 153, 142, 0.4);
            }

            .glass-btn-sm.glass-btn-danger {
                background: var(--gradient-danger);
                color: var(--white);
                border: none;
                width: 36px;
                height: 36px;
                border-radius: 10px;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: all 0.3s ease;
                font-size: 0.9rem;
                text-decoration: none;
            }

            .glass-btn-sm.glass-btn-danger:hover {
                background: var(--gradient-danger);
                color: var(--white);
                transform: scale(1.1);
                box-shadow: 0 4px 15px rgba(239, 68, 68, 0.4);
            }

            .glass-btn-sm.glass-btn-primary {
                background: var(--gradient-primary);
                color: var(--white);
                border: none;
                width: 36px;
                height: 36px;
                border-radius: 10px;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: all 0.3s ease;
                font-size: 0.9rem;
                text-decoration: none;
            }

            .glass-btn-sm.glass-btn-primary:hover {
                background: var(--gradient-primary);
                color: var(--white);
                transform: scale(1.1);
                box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
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
                display: flex;
                justify-content: center;
                gap: 1rem;
                flex-wrap: wrap;
            }

            /* Modal Styling */
            .glass-modal {
                background: var(--glass-bg);
                backdrop-filter: blur(25px);
                border: 1px solid var(--glass-border);
                border-radius: 20px;
                box-shadow: var(--glass-shadow);
                color: var(--white);
            }

            .glass-modal .modal-header {
                border-bottom: 1px solid var(--glass-border);
                background: var(--glass-bg-light);
                padding: 1.5rem;
            }

            .glass-modal .modal-body {
                padding: 1.5rem;
            }

            .glass-modal .modal-footer {
                border-top: 1px solid var(--glass-border);
                background: var(--glass-bg-light);
                padding: 1.5rem;
            }

            .glass-modal .modal-title {
                color: var(--white);
                font-family: 'Poppins', sans-serif;
                font-weight: 700;
            }

            .btn-close {
                filter: brightness(0) invert(1);
                opacity: 0.8;
            }

            .btn-close:hover {
                opacity: 1;
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

            /* Enhanced Modal Styles for Details */
            .kos-details-container {
                font-family: 'Inter', sans-serif;
            }

            .kos-details-header {
                background: var(--glass-bg-light);
                border: 1px solid var(--glass-border);
                border-radius: 15px;
                padding: 2rem;
                margin-bottom: 2rem;
            }

            .kos-title {
                font-family: 'Poppins', sans-serif;
                font-weight: 800;
                color: var(--white);
                font-size: 1.8rem;
                margin-bottom: 1rem;
            }

            .kos-meta {
                display: flex;
                flex-direction: column;
                gap: 0.75rem;
            }

            .meta-item {
                display: flex;
                align-items: center;
                color: rgba(255, 255, 255, 0.9);
                font-size: 0.95rem;
            }

            .kos-price-display {
                text-align: right;
                background: var(--gradient-primary);
                padding: 1.5rem;
                border-radius: 15px;
                color: white;
            }

            .price-label {
                display: block;
                font-size: 0.8rem;
                opacity: 0.9;
                margin-bottom: 0.5rem;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            .price-amount {
                display: block;
                font-family: 'Poppins', sans-serif;
                font-size: 1.5rem;
                font-weight: 800;
                line-height: 1.2;
            }

            .price-period {
                font-size: 0.85rem;
                opacity: 0.8;
            }

            .section-title {
                font-family: 'Poppins', sans-serif;
                font-weight: 700;
                color: var(--white);
                font-size: 1.1rem;
                margin-bottom: 1.5rem;
                padding-bottom: 0.75rem;
                border-bottom: 1px solid var(--glass-border);
            }

            .description-text {
                color: rgba(255, 255, 255, 0.9);
                line-height: 1.7;
                font-size: 0.95rem;
            }

            .description-text p {
                margin-bottom: 1rem;
            }

            .kos-gallery {
                margin-bottom: 1rem;
            }

            .main-image {
                width: 100%;
                height: auto;
                max-height: 400px;
                object-fit: cover;
                border-radius: 15px;
                cursor: pointer;
                transition: all 0.3s ease;
            }

            .main-image:hover {
                transform: scale(1.02);
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            }

            .no-image-placeholder {
                text-align: center;
                padding: 3rem;
                color: rgba(255, 255, 255, 0.5);
                background: var(--glass-bg-dark);
                border: 2px dashed var(--glass-border);
                border-radius: 15px;
            }

            .no-image-placeholder i {
                font-size: 3rem;
                margin-bottom: 1rem;
                display: block;
            }

            .facilities-grid {
                display: flex;
                flex-wrap: wrap;
                gap: 0.75rem;
            }

            .facility-badge {
                background: var(--glass-bg-light);
                border: 1px solid var(--glass-border);
                color: var(--white);
                padding: 0.5rem 1rem;
                border-radius: 25px;
                font-size: 0.85rem;
                font-weight: 500;
                display: inline-flex;
                align-items: center;
                transition: all 0.3s ease;
            }

            .facility-badge:hover {
                background: var(--gradient-primary);
                border-color: transparent;
                transform: translateY(-2px);
                box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
            }

            .owner-details-card {
                background: var(--glass-bg-light);
                border: 1px solid var(--glass-border);
                border-radius: 15px;
                padding: 2rem;
            }

            .owner-header {
                display: flex;
                align-items: center;
                gap: 1.5rem;
                margin-bottom: 2rem;
            }

            .owner-avatar-large {
                width: 80px;
                height: 80px;
                background: var(--gradient-secondary);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 2rem;
                color: white;
                flex-shrink: 0;
            }

            .owner-name-large {
                font-family: 'Poppins', sans-serif;
                font-weight: 700;
                color: var(--white);
                font-size: 1.4rem;
                margin-bottom: 0.25rem;
            }

            .owner-role {
                color: rgba(255, 255, 255, 0.7);
                font-size: 0.9rem;
                margin-bottom: 1rem;
            }

            .owner-contacts {
                display: flex;
                flex-direction: column;
                gap: 1rem;
            }

            .contact-item {
                display: flex;
                align-items: center;
                gap: 1rem;
                padding: 1rem;
                background: var(--glass-bg);
                border: 1px solid var(--glass-border);
                border-radius: 10px;
            }

            .contact-icon {
                width: 40px;
                height: 40px;
                background: var(--gradient-primary);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                font-size: 1rem;
                flex-shrink: 0;
            }

            .contact-info {
                flex-grow: 1;
            }

            .contact-label {
                display: block;
                font-size: 0.8rem;
                color: rgba(255, 255, 255, 0.6);
                text-transform: uppercase;
                letter-spacing: 0.5px;
                margin-bottom: 0.25rem;
            }

            .contact-value {
                display: block;
                color: var(--white);
                font-weight: 600;
                font-size: 0.95rem;
            }

            /* Report Modal Specific Styles */
            .report-preview {
                background: var(--glass-bg);
                border: 1px solid var(--glass-border);
                border-radius: 15px;
                padding: 1.5rem;
                margin-top: 1rem;
            }

            .preview-header {
                margin-bottom: 1rem;
                padding-bottom: 0.75rem;
                border-bottom: 1px solid var(--glass-border);
            }

            .preview-title {
                color: var(--white);
                font-family: 'Poppins', sans-serif;
                font-weight: 600;
                margin: 0;
                font-size: 1rem;
            }

            .preview-content {
                min-height: 100px;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .preview-placeholder {
                text-align: center;
                color: rgba(255, 255, 255, 0.6);
            }

            .preview-placeholder i {
                font-size: 2rem;
                margin-bottom: 0.5rem;
                display: block;
            }

            .preview-stats {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
                gap: 1rem;
            }

            .preview-stat-item {
                background: var(--glass-bg);
                border: 1px solid var(--glass-border);
                border-radius: 10px;
                padding: 1rem;
                text-align: center;
            }

            .preview-stat-number {
                font-family: 'Poppins', sans-serif;
                font-size: 1.5rem;
                font-weight: 800;
                color: var(--white);
                display: block;
            }

            .preview-stat-label {
                font-size: 0.8rem;
                color: rgba(255, 255, 255, 0.7);
                text-transform: uppercase;
                letter-spacing: 0.5px;
                margin-top: 0.25rem;
            }

            .report-actions {
                display: flex;
                gap: 0.5rem;
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

                .header-stats {
                    justify-content: center;
                }

                .filter-card {
                    padding: 2rem;
                }

                .kos-card {
                    padding: 2rem;
                }

                .view-toggle-wrapper {
                    position: static;
                    text-align: center;
                    margin-bottom: 2rem;
                }

                .kos-grid {
                    grid-template-columns: 1fr;
                    margin-top: 1rem;
                }

                .glass-table-wrapper {
                    margin-top: 1rem;
                }

                .glass-table thead th,
                .glass-table tbody td {
                    padding: 1rem 0.75rem;
                    font-size: 0.85rem;
                }

                .empty-actions {
                    flex-direction: column;
                    align-items: center;
                }

                .glass-btn {
                    width: 100%;
                    max-width: 250px;
                }

                .d-flex.justify-content-between {
                    flex-direction: column;
                    gap: 1rem;
                }

                .kos-details-header {
                    padding: 1.5rem;
                }

                .kos-details-header .row {
                    text-align: center;
                }

                .kos-title {
                    font-size: 1.5rem;
                }

                .kos-meta {
                    align-items: center;
                }

                .kos-price-display {
                    text-align: center;
                    margin-top: 1rem;
                }

                .owner-header {
                    flex-direction: column;
                    text-align: center;
                }

                .facilities-grid {
                    justify-content: center;
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

                .filter-card,
                .kos-card {
                    padding: 1.5rem;
                }

                .glass-kos-card .kos-content {
                    padding: 1rem;
                }

                .owner-info {
                    flex-direction: column;
                    text-align: center;
                    gap: 0.75rem;
                }

                .kos-grid {
                    gap: 1rem;
                }

                .empty-state {
                    padding: 3rem 1rem;
                }

                .contact-item {
                    flex-direction: column;
                    text-align: center;
                    gap: 0.75rem;
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
                button.addEventListener('click', function () {
                    const view = this.dataset.view;

                    // Update active button
                    document.querySelectorAll('.view-toggle button').forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');

                    // Show/hide views
                    if (view === 'cards') {
                        document.getElementById('cardsView').style.display = 'block';
                        document.getElementById('tableView').style.display = 'none';
                    } else {
                        document.getElementById('cardsView').style.display = 'none';
                        document.getElementById('tableView').style.display = 'block';
                    }

                    // Save preference (optional, comment out if not needed)
                    try {
                        localStorage.setItem('kosViewPreference', view);
                    } catch (e) {
                        console.log('LocalStorage not available');
                    }
                });
            });

            // Load saved view preference (optional, comment out if not needed)
            try {
                const savedView = localStorage.getItem('kosViewPreference') || 'cards';
                if (savedView === 'table') {
                    document.querySelector('[data-view="table"]').click();
                }
            } catch (e) {
                console.log('LocalStorage not available');
            }

            // Enhanced View Kos Details Function - Using data from DOM
            function viewKosDetails(buttonElement) {
                const modal = new bootstrap.Modal(document.getElementById('kosDetailsModal'));
                const modalTitle = document.querySelector('#kosDetailsModal .modal-title');
                const modalContent = document.getElementById('kosDetailsContent');

                // Get the parent element that contains all data attributes
                let dataContainer = buttonElement.closest('[data-kos-id]');

                // If not found in parent, try to find it in the row or card
                if (!dataContainer) {
                    dataContainer = buttonElement.closest('.kos-card-item') ||
                        buttonElement.closest('.table-row');
                }

                if (!dataContainer) {
                    modalContent.innerHTML = `
                                <div class="text-center py-5">
                                    <div class="alert-icon mb-3">
                                        <i class="fas fa-exclamation-triangle text-warning" style="font-size: 3rem;"></i>
                                    </div>
                                    <h5 class="text-white mb-2">Data Tidak Ditemukan</h5>
                                    <p class="text-white-50">Tidak dapat menemukan data kos yang dipilih.</p>
                                </div>
                            `;
                    modal.show();
                    return;
                }

                // Extract data from data attributes
                const kosData = {
                    id: dataContainer.dataset.kosId,
                    name: dataContainer.dataset.kosName,
                    location: dataContainer.dataset.kosLocation,
                    price: parseInt(dataContainer.dataset.kosPrice),
                    description: dataContainer.dataset.kosDescription,
                    facilities: dataContainer.dataset.kosFacilities,
                    photo: dataContainer.dataset.kosPhoto,
                    verified: dataContainer.dataset.kosVerified === 'true',
                    created: dataContainer.dataset.kosCreated,
                    owner: {
                        name: dataContainer.dataset.ownerName,
                        email: dataContainer.dataset.ownerEmail,
                        phone: dataContainer.dataset.ownerPhone,
                        joined: dataContainer.dataset.ownerJoined
                    }
                };

                // Update modal title
                modalTitle.innerHTML = `
                            <i class="fas fa-home text-primary me-2"></i>
                            Detail Kos: ${kosData.name}
                        `;

                // Show loading state briefly
                modalContent.innerHTML = `
                            <div class="text-center py-3">
                                <div class="spinner-border text-primary mb-2" role="status" style="width: 2rem; height: 2rem;">
                                    <span class="visually-hidden">Memuat...</span>
                                </div>
                                <p class="text-white-50">Memuat detail kos...</p>
                            </div>
                        `;

                modal.show();

                // Simulate brief loading then display content
                setTimeout(() => {
                    displayKosDetails(kosData);
                }, 300);
            }

            function displayKosDetails(kosData) {
                // Format price
                const formattedPrice = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                }).format(kosData.price);

                // Format dates
                const createdDate = new Date(kosData.created).toLocaleDateString('id-ID', {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });

                const joinedDate = new Date(kosData.owner.joined).toLocaleDateString('id-ID', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });

                const joinedYear = new Date(kosData.owner.joined).getFullYear();

                // Process facilities
                const facilities = kosData.facilities ?
                    kosData.facilities.split(',').filter(f => f.trim().length > 0) : [];

                const facilitiesHtml = facilities.length > 0 ?
                    facilities.map(facility => `
                                <span class="facility-badge">
                                    <i class="fas fa-check me-1"></i>${facility.trim()}
                                </span>
                            `).join('') :
                    '<span class="text-white-50">Tidak ada fasilitas yang tercantum</span>';

                // Generate gallery HTML
                let galleryHtml = '';
                if (kosData.photo && kosData.photo.trim() !== '') {
                    galleryHtml = `
                                <div class="kos-gallery">
                                    <div class="single-image">
                                        <img src="${kosData.photo}" alt="${kosData.name}" class="main-image" onclick="openImageModal('${kosData.photo}', '${kosData.name}')">
                                    </div>
                                </div>
                            `;
                } else {
                    galleryHtml = `
                                <div class="no-image-placeholder">
                                    <i class="fas fa-image"></i>
                                    <p>Tidak ada foto tersedia</p>
                                </div>
                            `;
                }

                const modalContent = `
                            <div class="kos-details-container">
                                <!-- Kos Header -->
                                <div class="kos-details-header">
                                    <div class="row align-items-center">
                                        <div class="col-md-8">
                                            <h4 class="kos-title">${kosData.name}</h4>
                                            <div class="kos-meta">
                                                <div class="meta-item">
                                                    <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                                    <span>${kosData.location}</span>
                                                </div>
                                                <div class="meta-item">
                                                    <i class="fas fa-calendar-plus text-info me-2"></i>
                                                    <span>Didaftarkan: ${createdDate}</span>
                                                </div>
                                                ${kosData.verified ? `
                                                    <div class="meta-item">
                                                        <i class="fas fa-check-circle text-success me-2"></i>
                                                        <span>Status: Sudah Terverifikasi</span>
                                                    </div>
                                                ` : `
                                                    <div class="meta-item">
                                                        <i class="fas fa-clock text-warning me-2"></i>
                                                        <span>Status: Menunggu Verifikasi</span>
                                                    </div>
                                                `}
                                            </div>
                                        </div>
                                        <div class="col-md-4 text-end">
                                            <div class="kos-price-display">
                                                <span class="price-label">Harga Sewa</span>
                                                <span class="price-amount">${formattedPrice}</span>
                                                <span class="price-period">/bulan</span>
                                            </div>
                                            <div class="kos-status mt-2">
                                                <div class="enhanced-badge enhanced-badge-sm ${kosData.verified ? 'status-verified' : 'status-pending'}">
                                                    <div class="badge-icon">
                                                        <i class="fas fa-${kosData.verified ? 'check' : 'clock'}"></i>
                                                    </div>
                                                    <div class="badge-content">
                                                        <div class="badge-title">${kosData.verified ? 'VERIFIED' : 'PENDING'}</div>
                                                        <div class="badge-subtitle">${kosData.verified ? 'Terverifikasi' : 'Menunggu'}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Content Sections -->
                                <div class="row g-4">
                                    <!-- Description Section -->
                                    <div class="col-md-6">
                                        <div class="glass-card" style="padding: 2rem; height: 100%;">
                                            <h6 class="section-title">
                                                <i class="fas fa-align-left me-2"></i>Deskripsi Kos
                                            </h6>
                                            <div class="description-text">
                                                ${kosData.description && kosData.description.trim() !== '' ?
                        `<p>${kosData.description}</p>` :
                        '<p class="text-white-50">Tidak ada deskripsi tersedia untuk kos ini.</p>'
                    }
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Gallery Section -->
                                    <div class="col-md-6">
                                        <div class="glass-card" style="padding: 2rem; height: 100%;">
                                            <h6 class="section-title">
                                                <i class="fas fa-images me-2"></i>Galeri Foto
                                            </h6>
                                            ${galleryHtml}
                                        </div>
                                    </div>

                                    <!-- Facilities Section -->
                                    <div class="col-md-6">
                                        <div class="glass-card" style="padding: 2rem; height: 100%;">
                                            <h6 class="section-title">
                                                <i class="fas fa-list-check me-2"></i>Fasilitas Tersedia
                                            </h6>
                                            <div class="facilities-grid">
                                                ${facilitiesHtml}
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Owner Section -->
                                    <div class="col-md-6">
                                        <div class="glass-card" style="padding: 2rem; height: 100%;">
                                            <h6 class="section-title">
                                                <i class="fas fa-user me-2"></i>Informasi Pemilik
                                            </h6>
                                            <div class="owner-details-card">
                                                <div class="owner-header">
                                                    <div class="owner-avatar-large">
                                                        <i class="fas fa-user"></i>
                                                    </div>
                                                    <div class="owner-info">
                                                        <h5 class="owner-name-large">${kosData.owner.name}</h5>
                                                        <p class="owner-role">Pemilik Kos</p>
                                                        <div class="owner-stats">
                                                            <span class="stat-item">
                                                                <i class="fas fa-calendar me-1"></i>
                                                                Bergabung ${joinedYear}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="owner-contacts">
                                                    <div class="contact-item">
                                                        <div class="contact-icon">
                                                            <i class="fas fa-envelope"></i>
                                                        </div>
                                                        <div class="contact-info">
                                                            <span class="contact-label">Email</span>
                                                            <span class="contact-value">${kosData.owner.email}</span>
                                                        </div>
                                                    </div>
                                                    ${kosData.owner.phone && kosData.owner.phone.trim() !== '' ? `
                                                        <div class="contact-item">
                                                            <div class="contact-icon">
                                                                <i class="fas fa-phone"></i>
                                                            </div>
                                                            <div class="contact-info">
                                                                <span class="contact-label">Telepon</span>
                                                                <span class="contact-value">${kosData.owner.phone}</span>
                                                            </div>
                                                        </div>
                                                    ` : ''}
                                                    <div class="contact-item">
                                                        <div class="contact-icon">
                                                            <i class="fas fa-calendar-plus"></i>
                                                        </div>
                                                        <div class="contact-info">
                                                            <span class="contact-label">Bergabung</span>
                                                            <span class="contact-value">${joinedDate}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                ${!kosData.verified ? `
                                    <div class="modal-actions mt-4">
                                        <div class="d-flex gap-3 justify-content-center">
                                            <form action="/admin/kos/${kosData.id}/approve" method="POST" class="d-inline">
                                                <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''}">
                                                <button type="submit" class="glass-btn glass-btn-success" onclick="return confirm('Apakah Anda yakin ingin menyetujui kos ini?')">
                                                    <i class="fas fa-check me-2"></i>Setujui Kos
                                                </button>
                                            </form>
                                            <button type="button" class="glass-btn glass-btn-danger" onclick="rejectKos(${kosData.id}, '${kosData.name}')">
                                                <i class="fas fa-times me-2"></i>Tolak Kos
                                            </button>
                                        </div>
                                    </div>
                                ` : ''}
                            </div>
                        `;

                document.getElementById('kosDetailsContent').innerHTML = modalContent;
            }

            // Image modal function
            function openImageModal(imageSrc, altText) {
                // Create and show image modal
                const imageModal = `
                            <div class="modal fade" id="imageModal" tabindex="-1">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content glass-modal">
                                        <div class="modal-header">
                                            <h5 class="modal-title">
                                                <i class="fas fa-image me-2"></i>${altText}
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body text-center p-0">
                                            <img src="${imageSrc}" alt="${altText}" class="img-fluid" style="max-height: 70vh; width: auto;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;

                // Remove existing image modal if any
                const existingModal = document.getElementById('imageModal');
                if (existingModal) {
                    existingModal.remove();
                }

                // Add new modal to body
                document.body.insertAdjacentHTML('beforeend', imageModal);

                // Show modal
                const modal = new bootstrap.Modal(document.getElementById('imageModal'));
                modal.show();

                // Remove modal from DOM when hidden
                document.getElementById('imageModal').addEventListener('hidden.bs.modal', function () {
                    this.remove();
                });
            }

            // Filter Functions
            const statusFilter = document.getElementById('statusFilter');
            const searchInput = document.getElementById('searchInput');
            const sortFilter = document.getElementById('sortFilter');

            function filterKos() {
                const statusValue = statusFilter.value.toLowerCase();
                const searchValue = searchInput.value.toLowerCase();

                // Filter cards
                const kosCards = document.querySelectorAll('.kos-card-item');
                kosCards.forEach(card => {
                    const status = card.dataset.status.toLowerCase();
                    const cardText = card.textContent.toLowerCase();

                    const statusMatch = !statusValue ||
                        (statusValue === 'pending' && status === 'pending') ||
                        (statusValue === 'verified' && status === 'verified');
                    const searchMatch = !searchValue || cardText.includes(searchValue);

                    if (statusMatch && searchMatch) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });

                // Filter table rows
                const tableRows = document.querySelectorAll('.table-row');
                tableRows.forEach(row => {
                    const status = row.dataset.status.toLowerCase();
                    const rowText = row.textContent.toLowerCase();

                    const statusMatch = !statusValue ||
                        (statusValue === 'pending' && status === 'pending') ||
                        (statusValue === 'verified' && status === 'verified');
                    const searchMatch = !searchValue || rowText.includes(searchValue);

                    if (statusMatch && searchMatch) {
                        row.style.display = 'table-row';
                    } else {
                        row.style.display = 'none';
                    }
                });

                updateResultsCount();
            }

            function updateResultsCount() {
                const visibleCards = document.querySelectorAll('.kos-card-item[style=""], .kos-card-item:not([style*="none"])').length;
                console.log(`Showing ${visibleCards} kos listings`);
            }

            function resetFilters() {
                statusFilter.value = '';
                searchInput.value = '';
                sortFilter.value = 'newest';
                filterKos();
            }

            // Add event listeners
            statusFilter.addEventListener('change', filterKos);
            searchInput.addEventListener('input', debounce(filterKos, 300));
            sortFilter.addEventListener('change', sortKos);

            // Debounce function for search
            function debounce(func, wait) {
                let timeout;
                return function executedFunction(...args) {
                    const later = () => {
                        clearTimeout(timeout);
                        func(...args);
                    };
                    clearTimeout(timeout);
                    timeout = setTimeout(later, wait);
                };
            }

            // Sort function
            function sortKos() {
                const sortValue = sortFilter.value;
                const kosGrid = document.querySelector('.kos-grid');
                const kosCards = Array.from(document.querySelectorAll('.kos-card-item'));

                kosCards.sort((a, b) => {
                    const aName = a.querySelector('.kos-name').textContent;
                    const bName = b.querySelector('.kos-name').textContent;
                    const aPrice = parseInt(a.querySelector('.kos-price strong').textContent.replace(/[^\d]/g, ''));
                    const bPrice = parseInt(b.querySelector('.kos-price strong').textContent.replace(/[^\d]/g, ''));

                    switch (sortValue) {
                        case 'name_asc':
                            return aName.localeCompare(bName);
                        case 'name_desc':
                            return bName.localeCompare(aName);
                        case 'price_asc':
                            return aPrice - bPrice;
                        case 'price_desc':
                            return bPrice - aPrice;
                        case 'oldest':
                            return 1; // Reverse chronological
                        case 'newest':
                        default:
                            return -1; // Chronological
                    }
                });

                // Re-append sorted cards
                kosCards.forEach(card => kosGrid.appendChild(card));
            }

            // Reject kos confirmation
            function rejectKos(kosId, kosName) {
                document.getElementById('rejectKosName').textContent = kosName;
                document.getElementById('rejectKosForm').action = `/admin/kos/${kosId}/reject`;

                const modal = new bootstrap.Modal(document.getElementById('rejectKosModal'));
                modal.show();
            }

            // Add loading state to form submissions
            document.querySelectorAll('.approve-form').forEach(form => {
                form.addEventListener('submit', function (e) {
                    const submitBtn = this.querySelector('button[type="submit"]');
                    const originalHtml = submitBtn.innerHTML;

                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyetujui...';
                    submitBtn.disabled = true;

                    // Re-enable button after 5 seconds (in case of error)
                    setTimeout(() => {
                        submitBtn.innerHTML = originalHtml;
                        submitBtn.disabled = false;
                    }, 5000);
                });
            });

            document.getElementById('rejectKosForm').addEventListener('submit', function () {
                const submitBtn = this.querySelector('button[type="submit"]');
                const originalHtml = submitBtn.innerHTML;

                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menolak...';
                submitBtn.disabled = true;

                setTimeout(() => {
                    submitBtn.innerHTML = originalHtml;
                    submitBtn.disabled = false;
                }, 5000);
            });

            // Report Modal Functions
            function showReportModal() {
                const modal = new bootstrap.Modal(document.getElementById('reportModal'));
                modal.show();
                updateReportPreview();
            }

            function updateReportPreview() {
                const startDate = document.getElementById('startDate').value;
                const endDate = document.getElementById('endDate').value;

                if (startDate && endDate) {
                    document.getElementById('reportPreview').innerHTML = `
                                <div class="preview-placeholder">
                                    <i class="fas fa-spinner fa-spin"></i>
                                    <p>Memuat preview...</p>
                                </div>
                            `;

                    setTimeout(() => {
                        const previewHtml = `
                                    <div class="preview-stats">
                                        <div class="preview-stat-item">
                                            <span class="preview-stat-number">{{ $pendingKos->total() }}</span>
                                            <span class="preview-stat-label">Total Kos</span>
                                        </div>
                                        <div class="preview-stat-item">
                                            <span class="preview-stat-number">{{ $pendingKos->where('is_verified', false)->count() }}</span>
                                            <span class="preview-stat-label">Menunggu</span>
                                        </div>
                                        <div class="preview-stat-item">
                                            <span class="preview-stat-number">{{ \App\Models\Kos::where('is_verified', true)->whereDate('updated_at', today())->count() }}</span>
                                            <span class="preview-stat-label">Hari Ini</span>
                                        </div>
                                        <div class="preview-stat-item">
                                            <span class="preview-stat-number">{{ \App\Models\Kos::where('is_verified', true)->count() }}</span>
                                            <span class="preview-stat-label">Terverifikasi</span>
                                        </div>
                                    </div>
                                `;
                        document.getElementById('reportPreview').innerHTML = previewHtml;
                    }, 1000);
                }
            }

            function printReport() {
                const form = document.getElementById('reportForm');
                const startDate = document.getElementById('startDate').value;
                const endDate = document.getElementById('endDate').value;

                if (!startDate || !endDate) {
                    alert('Silakan pilih tanggal mulai dan akhir');
                    return;
                }

                if (new Date(startDate) > new Date(endDate)) {
                    alert('Tanggal mulai tidak boleh lebih besar dari tanggal akhir');
                    return;
                }

                form.action = "{{ route('admin.verification.print-report') }}";
                form.submit();
            }

            function exportPDF() {
                const startDate = document.getElementById('startDate').value;
                const endDate = document.getElementById('endDate').value;
                const status = document.querySelector('select[name="status"]').value;

                if (!startDate || !endDate) {
                    alert('Silakan pilih tanggal mulai dan akhir');
                    return;
                }

                if (new Date(startDate) > new Date(endDate)) {
                    alert('Tanggal mulai tidak boleh lebih besar dari tanggal akhir');
                    return;
                }

                const params = new URLSearchParams({
                    start_date: startDate,
                    end_date: endDate,
                    status: status
                });

                window.open("{{ route('admin.verification.export-pdf') }}?" + params.toString(), '_blank');
            }

            function exportExcel() {
                const startDate = document.getElementById('startDate').value;
                const endDate = document.getElementById('endDate').value;
                const status = document.querySelector('select[name="status"]').value;

                if (!startDate || !endDate) {
                    alert('Silakan pilih tanggal mulai dan akhir');
                    return;
                }

                if (new Date(startDate) > new Date(endDate)) {
                    alert('Tanggal mulai tidak boleh lebih besar dari tanggal akhir');
                    return;
                }

                const params = new URLSearchParams({
                    start_date: startDate,
                    end_date: endDate,
                    status: status
                });

                window.location.href = "{{ route('admin.verification.export-excel') }}?" + params.toString();
            }

            // Add event listeners for date changes
            document.getElementById('startDate').addEventListener('change', updateReportPreview);
            document.getElementById('endDate').addEventListener('change', updateReportPreview);

            // Add CSRF token to head if not present
            if (!document.querySelector('meta[name="csrf-token"]')) {
                const csrfToken = document.createElement('meta');
                csrfToken.name = 'csrf-token';
                csrfToken.content = '{{ csrf_token() }}';
                document.head.appendChild(csrfToken);
            }

            console.log('Enhanced Verification Interface Loaded Successfully!');
        </script>
    @endpush
@endsection