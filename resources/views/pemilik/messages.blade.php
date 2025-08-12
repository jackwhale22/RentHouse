@extends('layouts.app')

@section('title', 'Kelola Pesan - Kos Finder')

@section('content')
    <div class="container-fluid glassmorphism-messages">
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
                                    <h1 class="page-title">Kelola Pesan</h1>
                                    <p class="page-subtitle">Kelola dan balas pesan dari calon penyewa kos Anda</p>
                                </div>
                            </div>
                            <div class="header-stats">
                                <div class="stat-item">
                                    <span
                                        class="stat-number">{{ $messages->where('status_kontak', 'pending')->count() }}</span>
                                    <span class="stat-label">Belum Dibaca</span>
                                </div>
                                <div class="stat-divider"></div>
                                <div class="stat-item">
                                    <span class="stat-number">{{ $messages->total() }}</span>
                                    <span class="stat-label">Total Pesan</span>
                                </div>
                                <div class="stat-divider"></div>
                                <div class="header-actions-group">
                                    <button type="button" class="glass-btn glass-btn-outline" onclick="showReportModal()">
                                        <i class="fas fa-print me-2"></i>Cetak Laporan
                                    </button>
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
                                        <i class="fas fa-eye me-2"></i>Status Kontak
                                    </label>
                                    <div class="glass-select-wrapper">
                                        <select class="glass-select" id="statusFilter">
                                            <option value="">Semua Status</option>
                                            <option value="pending">Menunggu</option>
                                            <option value="contacted">Sudah Dihubungi</option>
                                            <option value="closed">Ditutup</option>
                                        </select>
                                        <div class="select-icon">
                                            <i class="fas fa-chevron-down"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label class="glass-label">
                                        <i class="fas fa-exchange-alt me-2"></i>Status Transaksi
                                    </label>
                                    <div class="glass-select-wrapper">
                                        <select class="glass-select" id="transactionFilter">
                                            <option value="">Semua Transaksi</option>
                                            <option value="pending">Pending</option>
                                            <option value="selesai">Selesai</option>
                                            <option value="dibatalkan">Dibatalkan</option>
                                        </select>
                                        <div class="select-icon">
                                            <i class="fas fa-chevron-down"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label class="glass-label">
                                        <i class="fas fa-search me-2"></i>Cari Pesan
                                    </label>
                                    <div class="glass-input-wrapper">
                                        <input type="text" class="glass-input" id="searchInput"
                                            placeholder="Cari berdasarkan nama penyewa atau kos...">
                                        <div class="input-icon">
                                            <i class="fas fa-search"></i>
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

            <!-- Messages Content -->
            <div class="row">
                <div class="col-12">
                    <div class="glass-card messages-card">
                        @if($messages->count() > 0)
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
                            <div class="messages-view" id="cardsView">
                                <div class="messages-grid">
                                    @foreach($messages as $message)
                                        <div class="message-card" data-status="{{ $message->status_kontak }}"
                                            data-transaction="{{ $message->status_transaksi }}">
                                            <div class="message-header">
                                                <div class="message-date">
                                                    <i class="fas fa-calendar-alt me-1"></i>
                                                    {{ $message->created_at->format('d/m/Y H:i') }}
                                                </div>
                                                <div class="message-status">
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

                                            <div class="message-content">
                                                <div class="penyewa-info">
                                                    <div class="penyewa-avatar">
                                                        <i class="fas fa-user"></i>
                                                    </div>
                                                    <div class="penyewa-details">
                                                        <h6 class="penyewa-name">{{ $message->penyewa->name }}</h6>
                                                        <div class="penyewa-contact">
                                                            <small>
                                                                <i class="fas fa-envelope me-1"></i>{{ $message->penyewa->email }}
                                                            </small>
                                                            @if($message->penyewa->phone)
                                                                <br>
                                                                <small>
                                                                    <i class="fas fa-phone me-1"></i>{{ $message->penyewa->phone }}
                                                                </small>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="kos-info">
                                                    <div class="kos-name">
                                                        <i class="fas fa-home me-2"></i>
                                                        <strong>{{ $message->kos->nama_kos }}</strong>
                                                    </div>
                                                    <div class="kos-location">
                                                        <i class="fas fa-map-marker-alt me-2"></i>
                                                        <small>{{ Str::limit($message->kos->lokasi, 40) }}</small>
                                                    </div>
                                                </div>

                                                @if($message->catatan)
                                                    <div class="message-text">
                                                        <div class="message-label">
                                                            <i class="fas fa-comment me-1"></i>Pesan:
                                                        </div>
                                                        <p>{{ Str::limit($message->catatan, 100) }}</p>
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="message-footer">
                                                <div class="transaction-status">
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
                                                <a href="{{ route('pemilik.messages.detail', $message->id) }}"
                                                    class="glass-btn glass-btn-primary">
                                                    <i class="fas fa-eye me-2"></i>Lihat Detail
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Table View -->
                            <div class="messages-view" id="tableView" style="display: none;">
                                <div class="glass-table-wrapper">
                                    <div class="table-responsive">
                                        <table class="glass-table">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <i class="fas fa-calendar-alt me-2"></i>Tanggal
                                                    </th>
                                                    <th>
                                                        <i class="fas fa-user me-2"></i>Penyewa
                                                    </th>
                                                    <th>
                                                        <i class="fas fa-home me-2"></i>Kos
                                                    </th>
                                                    <th>
                                                        <i class="fas fa-comment me-2"></i>Pesan
                                                    </th>
                                                    <th>
                                                        <i class="fas fa-eye me-2"></i>Status Kontak
                                                    </th>
                                                    <th>
                                                        <i class="fas fa-exchange-alt me-2"></i>Status Transaksi
                                                    </th>
                                                    <th>
                                                        <i class="fas fa-cogs me-2"></i>Aksi
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($messages as $message)
                                                    <tr class="table-row" data-status="{{ $message->status_kontak }}"
                                                        data-transaction="{{ $message->status_transaksi }}">
                                                        <td>
                                                            <div class="date-info">
                                                                <div class="date-primary">
                                                                    {{ $message->created_at->format('d/m/Y') }}
                                                                </div>
                                                                <div class="date-secondary">
                                                                    {{ $message->created_at->format('H:i') }}
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="penyewa-table-info">
                                                                <div class="penyewa-table-name">{{ $message->penyewa->name }}</div>
                                                                <div class="penyewa-table-contact">
                                                                    <small>{{ $message->penyewa->email }}</small>
                                                                    @if($message->penyewa->phone)
                                                                        <br><small>{{ $message->penyewa->phone }}</small>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="kos-table-info">
                                                                <div class="kos-table-name">{{ $message->kos->nama_kos }}</div>
                                                                <div class="kos-table-location">
                                                                    <small>{{ Str::limit($message->kos->lokasi, 30) }}</small>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="message-preview">
                                                                @if($message->catatan)
                                                                    {{ Str::limit($message->catatan, 50) }}
                                                                @else
                                                                    <em class="text-muted">Tidak ada pesan</em>
                                                                @endif
                                                            </div>
                                                        </td>
                                                        <td>
                                                            @if($message->status_kontak == 'pending')
                                                                <div class="enhanced-badge enhanced-badge-xs status-new">
                                                                    <div class="badge-icon">
                                                                        <i class="fas fa-clock"></i>
                                                                    </div>
                                                                    <div class="badge-content">
                                                                        <div class="badge-title">MENUNGGU</div>
                                                                        <div class="badge-subtitle">Belum</div>
                                                                    </div>
                                                                    <div class="badge-glow status-new-glow"></div>
                                                                </div>
                                                            @elseif($message->status_kontak == 'contacted')
                                                                <div class="enhanced-badge enhanced-badge-xs status-read">
                                                                    <div class="badge-icon">
                                                                        <i class="fas fa-check"></i>
                                                                    </div>
                                                                    <div class="badge-content">
                                                                        <div class="badge-title">DIHUBUNGI</div>
                                                                        <div class="badge-subtitle">Sudah</div>
                                                                    </div>
                                                                    <div class="badge-glow status-read-glow"></div>
                                                                </div>
                                                            @else
                                                                <div class="enhanced-badge enhanced-badge-xs status-archived">
                                                                    <div class="badge-icon">
                                                                        <i class="fas fa-times"></i>
                                                                    </div>
                                                                    <div class="badge-content">
                                                                        <div class="badge-title">DITUTUP</div>
                                                                        <div class="badge-subtitle">Tutup</div>
                                                                    </div>
                                                                    <div class="badge-glow status-archived-glow"></div>
                                                                </div>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($message->status_transaksi == 'pending')
                                                                <div class="enhanced-badge enhanced-badge-xs priority-medium">
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
                                                                <div class="enhanced-badge enhanced-badge-xs priority-low">
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
                                                                <div class="enhanced-badge enhanced-badge-xs priority-high">
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
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('pemilik.messages.detail', $message->id) }}"
                                                                class="glass-btn-sm glass-btn-primary" title="Lihat Detail">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
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
                                        {{ $messages->links() }}
                                    </div>
                                </div>
                            </div>
                        @else
                            <!-- Empty State -->
                            <div class="empty-state">
                                <div class="empty-icon">
                                    <i class="fas fa-inbox"></i>
                                </div>
                                <h4 class="empty-title">Belum Ada Pesan</h4>
                                <p class="empty-description">
                                    Pesan dari calon penyewa yang tertarik dengan kos Anda akan muncul di sini.
                                    Pastikan listing kos Anda aktif dan menarik untuk mendapat lebih banyak inquiry.
                                </p>
                                <div class="empty-actions">
                                    <a href="{{ route('pemilik.my-kos') }}" class="glass-btn glass-btn-primary">
                                        <i class="fas fa-building me-2"></i>Lihat Kos Saya
                                    </a>
                                    <a href="{{ route('pemilik.kos.create') }}" class="glass-btn glass-btn-outline">
                                        <i class="fas fa-plus me-2"></i>Tambah Kos Baru
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
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
                        Cetak Laporan Pesan
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <form id="reportForm" method="POST" action="{{ route('pemilik.messages.print-report') }}"
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
                            <div class="col-md-6">
                                <label class="glass-label">
                                    <i class="fas fa-eye me-2"></i>Status Kontak
                                </label>
                                <div class="glass-select-wrapper">
                                    <select class="glass-select" name="status_kontak">
                                        <option value="">Semua Status</option>
                                        <option value="pending">Menunggu</option>
                                        <option value="contacted">Sudah Dihubungi</option>
                                        <option value="closed">Ditutup</option>
                                    </select>
                                    <div class="select-icon">
                                        <i class="fas fa-chevron-down"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="glass-label">
                                    <i class="fas fa-exchange-alt me-2"></i>Status Transaksi
                                </label>
                                <div class="glass-select-wrapper">
                                    <select class="glass-select" name="status_transaksi">
                                        <option value="">Semua Transaksi</option>
                                        <option value="pending">Pending</option>
                                        <option value="selesai">Selesai</option>
                                        <option value="dibatalkan">Dibatalkan</option>
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

            .glassmorphism-messages {
                background: var(--gradient-background);
                min-height: 100vh;
                position: relative;
                overflow-x: hidden;
            }

            .glassmorphism-messages::before {
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

            /* Messages Card */
            .messages-card {
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

            /* Messages Grid (Card View) */
            .messages-grid {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
                gap: 2rem;
                margin-top: 3rem;
            }

            .message-card {
                background: var(--glass-bg);
                border: 1px solid var(--glass-border);
                border-radius: 20px;
                padding: 1.5rem;
                transition: all 0.4s ease;
                display: flex;
                flex-direction: column;
                gap: 1rem;
            }

            .message-card:hover {
                transform: translateY(-5px);
                box-shadow: var(--glass-shadow-hover);
                background: var(--glass-bg-light);
            }

            .message-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding-bottom: 1rem;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            }

            .message-date {
                color: rgba(255, 255, 255, 0.8);
                font-size: 0.85rem;
                font-weight: 500;
            }

            .penyewa-info {
                display: flex;
                align-items: center;
                gap: 1rem;
                margin-bottom: 1rem;
            }

            .penyewa-avatar {
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

            .penyewa-name {
                font-family: 'Poppins', sans-serif;
                font-size: 1.1rem;
                font-weight: 700;
                color: var(--white);
                margin-bottom: 0.25rem;
            }

            .penyewa-contact {
                color: rgba(255, 255, 255, 0.7);
                font-size: 0.85rem;
                line-height: 1.4;
            }

            .kos-info {
                margin-bottom: 1rem;
            }

            .kos-name {
                color: var(--white);
                font-weight: 600;
                margin-bottom: 0.5rem;
                display: flex;
                align-items: center;
            }

            .kos-location {
                color: rgba(255, 255, 255, 0.7);
                font-size: 0.9rem;
                display: flex;
                align-items: center;
            }

            .message-text {
                margin-bottom: 1rem;
            }

            .message-label {
                color: rgba(255, 255, 255, 0.8);
                font-weight: 600;
                font-size: 0.9rem;
                margin-bottom: 0.5rem;
            }

            .message-text p {
                color: rgba(255, 255, 255, 0.9);
                font-size: 0.95rem;
                line-height: 1.5;
                margin: 0;
                background: var(--glass-bg);
                padding: 1rem;
                border-radius: 15px;
                border: 1px solid var(--glass-border);
            }

            .message-footer {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-top: auto;
                padding-top: 1rem;
                border-top: 1px solid rgba(255, 255, 255, 0.1);
            }

            /* Table View */
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

            .penyewa-table-info .penyewa-table-name {
                color: var(--white);
                font-weight: 600;
                font-size: 0.95rem;
                margin-bottom: 0.25rem;
            }

            .penyewa-table-contact {
                color: rgba(255, 255, 255, 0.7);
                font-size: 0.8rem;
                line-height: 1.3;
            }

            .kos-table-info .kos-table-name {
                color: var(--white);
                font-weight: 600;
                font-size: 0.95rem;
                margin-bottom: 0.25rem;
            }

            .kos-table-location {
                color: rgba(255, 255, 255, 0.7);
                font-size: 0.8rem;
            }

            .message-preview {
                color: rgba(255, 255, 255, 0.9);
                font-size: 0.9rem;
                line-height: 1.4;
                max-width: 200px;
            }

            /* Small Action Buttons */
            .glass-btn-sm.glass-btn-primary {
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
                color: #60a5fa;
                border-color: rgba(96, 165, 250, 0.3);
            }

            .glass-btn-sm.glass-btn-primary:hover {
                background: rgba(96, 165, 250, 0.1);
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
                display: flex;
                justify-content: center;
                gap: 1rem;
                flex-wrap: wrap;
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

                .header-stats {
                    justify-content: center;
                }

                .filter-card {
                    padding: 2rem;
                }

                .messages-card {
                    padding: 2rem;
                }

                .view-toggle-wrapper {
                    position: static;
                    text-align: center;
                    margin-bottom: 2rem;
                }

                .messages-grid {
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
                .messages-card {
                    padding: 1.5rem;
                }

                .message-card {
                    padding: 1rem;
                }

                .penyewa-info {
                    flex-direction: column;
                    text-align: center;
                    gap: 0.75rem;
                }

                .messages-grid {
                    gap: 1rem;
                }

                .empty-state {
                    padding: 3rem 1rem;
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

                    // Save preference (Note: localStorage not available in Claude.ai environment)
                    try {
                        localStorage.setItem('messagesViewPreference', view);
                    } catch (e) {
                        console.log('LocalStorage not available');
                    }
                });
            });

            // Load saved view preference
            try {
                const savedView = localStorage.getItem('messagesViewPreference') || 'cards';
                if (savedView === 'table') {
                    document.querySelector('[data-view="table"]').click();
                }
            } catch (e) {
                console.log('LocalStorage not available');
            }

            // Filter Functions
            const statusFilter = document.getElementById('statusFilter');
            const transactionFilter = document.getElementById('transactionFilter');
            const searchInput = document.getElementById('searchInput');

            function filterMessages() {
                const statusValue = statusFilter.value.toLowerCase();
                const transactionValue = transactionFilter.value.toLowerCase();
                const searchValue = searchInput.value.toLowerCase();

                // Filter cards
                const messageCards = document.querySelectorAll('.message-card');
                messageCards.forEach(card => {
                    const status = card.dataset.status.toLowerCase();
                    const transaction = card.dataset.transaction.toLowerCase();
                    const cardText = card.textContent.toLowerCase();

                    const statusMatch = !statusValue || status === statusValue;
                    const transactionMatch = !transactionValue || transaction === transactionValue;
                    const searchMatch = !searchValue || cardText.includes(searchValue);

                    if (statusMatch && transactionMatch && searchMatch) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });

                // Filter table rows
                const tableRows = document.querySelectorAll('.table-row');
                tableRows.forEach(row => {
                    const status = row.dataset.status.toLowerCase();
                    const transaction = row.dataset.transaction.toLowerCase();
                    const rowText = row.textContent.toLowerCase();

                    const statusMatch = !statusValue || status === statusValue;
                    const transactionMatch = !transactionValue || transaction === transactionValue;
                    const searchMatch = !searchValue || rowText.includes(searchValue);

                    if (statusMatch && transactionMatch && searchMatch) {
                        row.style.display = 'table-row';
                    } else {
                        row.style.display = 'none';
                    }
                });

                updateResultsCount();
            }

            function updateResultsCount() {
                const visibleCards = document.querySelectorAll('.message-card[style=""], .message-card:not([style*="none"])').length;
                const totalCards = document.querySelectorAll('.message-card').length;

                console.log(`Showing ${visibleCards} of ${totalCards} messages`);
            }

            function resetFilters() {
                statusFilter.value = '';
                transactionFilter.value = '';
                searchInput.value = '';
                filterMessages();
            }

            // Add event listeners
            statusFilter.addEventListener('change', filterMessages);
            transactionFilter.addEventListener('change', filterMessages);
            searchInput.addEventListener('input', debounce(filterMessages, 300));

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

            // Auto-refresh messages every 30 seconds
            setInterval(() => {
                console.log('Auto-refreshing messages...');
                // You can add AJAX call here to refresh messages
            }, 30000);

            // Enhanced card interactions
            document.querySelectorAll('.message-card').forEach(card => {
                card.addEventListener('mouseenter', function () {
                    this.style.transform = 'translateY(-5px) scale(1.02)';
                });

                card.addEventListener('mouseleave', function () {
                    if (!this.style.display || this.style.display !== 'none') {
                        this.style.transform = '';
                    }
                });
            });

            // Enhanced table row interactions
            document.querySelectorAll('.table-row').forEach(row => {
                row.addEventListener('mouseenter', function () {
                    this.style.boxShadow = '0 4px 20px rgba(255, 255, 255, 0.1)';
                });

                row.addEventListener('mouseleave', function () {
                    this.style.boxShadow = '';
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

            // Keyboard shortcuts
            document.addEventListener('keydown', function (e) {
                if (e.ctrlKey || e.metaKey) {
                    switch (e.key) {
                        case 'f':
                            e.preventDefault();
                            searchInput.focus();
                            break;
                        case 'r':
                            e.preventDefault();
                            resetFilters();
                            break;
                        case '1':
                            e.preventDefault();
                            document.querySelector('[data-view="cards"]').click();
                            break;
                        case '2':
                            e.preventDefault();
                            document.querySelector('[data-view="table"]').click();
                            break;
                    }
                }
            });

            // Show loading state when navigating to detail
            document.querySelectorAll('a[href*="messages.detail"]').forEach(link => {
                link.addEventListener('click', function () {
                    const originalText = this.innerHTML;
                    this.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memuat...';
                    this.disabled = true;

                    // Re-enable after 3 seconds (in case of error)
                    setTimeout(() => {
                        this.innerHTML = originalText;
                        this.disabled = false;
                    }, 3000);
                });
            });

            // Add notification for filter results
            function showFilterNotification(count) {
                // Remove existing notification
                const existingNotification = document.querySelector('.filter-notification');
                if (existingNotification) {
                    existingNotification.remove();
                }

                const notification = document.createElement('div');
                notification.className = 'filter-notification';
                notification.innerHTML = `
                            <i class="fas fa-filter me-2"></i>
                            Menampilkan ${count} pesan
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
                }, 2000);
            }

            // Add filter notification styles
            const filterNotificationStyles = `
                        .filter-notification {
                            position: fixed;
                            top: 120px;
                            right: 20px;
                            background: var(--glass-bg);
                            backdrop-filter: blur(25px);
                            border: 1px solid var(--glass-border);
                            border-radius: 15px;
                            padding: 0.75rem 1rem;
                            color: var(--white);
                            font-weight: 500;
                            font-size: 0.9rem;
                            z-index: 9999;
                            transform: translateX(400px);
                            transition: transform 0.3s ease;
                            box-shadow: var(--glass-shadow);
                        }

                        .filter-notification.show {
                            transform: translateX(0);
                        }
                    `;

            const styleSheet = document.createElement('style');
            styleSheet.textContent = filterNotificationStyles;
            document.head.appendChild(styleSheet);

            // Update filter notification when filters change
            const originalFilterMessages = filterMessages;
            filterMessages = function () {
                originalFilterMessages();
                const visibleCount = document.querySelectorAll('.message-card[style=""], .message-card:not([style*="none"])').length;
                if (statusFilter.value || transactionFilter.value || searchInput.value) {
                    showFilterNotification(visibleCount);
                }
            };

            // Add ripple effect to buttons and badges
            document.querySelectorAll('.glass-btn, .glass-btn-sm, .enhanced-badge').forEach(element => {
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

            // Performance optimization: Intersection Observer for cards
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

            // Observe all message cards
            document.querySelectorAll('.message-card').forEach(card => {
                observer.observe(card);
            });

            // Add visibility styles
            const visibilityStyles = `
                        .message-card {
                            opacity: 0;
                            transform: translateY(20px);
                            transition: opacity 0.6s ease, transform 0.6s ease;
                        }

                        .message-card.visible {
                            opacity: 1;
                            transform: translateY(0);
                        }
                    `;

            const visibilityStyleSheet = document.createElement('style');
            visibilityStyleSheet.textContent = visibilityStyles;
            document.head.appendChild(visibilityStyleSheet);

            // Initialize tooltips for badges (if using Bootstrap)
            if (typeof bootstrap !== 'undefined') {
                const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl);
                });
            }

            // Add smooth scrolling to pagination
            document.querySelectorAll('.pagination a').forEach(link => {
                link.addEventListener('click', function () {
                    setTimeout(() => {
                        document.querySelector('.messages-card').scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }, 100);
                });
            });

            console.log('Enhanced Messages Interface Loaded Successfully!');

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
                    // Show loading
                    document.getElementById('reportPreview').innerHTML = `
                                <div class="preview-placeholder">
                                    <i class="fas fa-spinner fa-spin"></i>
                                    <p>Memuat preview...</p>
                                </div>
                            `;

                    // Simulate preview (in real app, you'd make AJAX call)
                    setTimeout(() => {
                        const previewHtml = `
                                    <div class="preview-stats">
                                        <div class="preview-stat-item">
                                            <span class="preview-stat-number">{{ $messages->count() }}</span>
                                            <span class="preview-stat-label">Total Pesan</span>
                                        </div>
                                        <div class="preview-stat-item">
                                            <span class="preview-stat-number">{{ $messages->where('status_kontak', 'pending')->count() }}</span>
                                            <span class="preview-stat-label">Menunggu</span>
                                        </div>
                                        <div class="preview-stat-item">
                                            <span class="preview-stat-number">{{ $messages->where('status_kontak', 'contacted')->count() }}</span>
                                            <span class="preview-stat-label">Dihubungi</span>
                                        </div>
                                        <div class="preview-stat-item">
                                            <span class="preview-stat-number">{{ $messages->where('status_transaksi', 'selesai')->count() }}</span>
                                            <span class="preview-stat-label">Selesai</span>
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

                form.action = "{{ route('pemilik.messages.print-report') }}";
                form.submit();
            }

            function exportPDF() {
                const startDate = document.getElementById('startDate').value;
                const endDate = document.getElementById('endDate').value;
                const statusKontak = document.querySelector('select[name="status_kontak"]').value;
                const statusTransaksi = document.querySelector('select[name="status_transaksi"]').value;

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
                    status_kontak: statusKontak,
                    status_transaksi: statusTransaksi
                });

                window.open("{{ route('pemilik.messages.export-pdf') }}?" + params.toString(), '_blank');
            }

            function exportExcel() {
                const startDate = document.getElementById('startDate').value;
                const endDate = document.getElementById('endDate').value;
                const statusKontak = document.querySelector('select[name="status_kontak"]').value;
                const statusTransaksi = document.querySelector('select[name="status_transaksi"]').value;

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
                    status_kontak: statusKontak,
                    status_transaksi: statusTransaksi
                });

                window.location.href = "{{ route('pemilik.messages.export-excel') }}?" + params.toString();
            }

            // Add event listeners for date changes
            document.getElementById('startDate').addEventListener('change', updateReportPreview);
            document.getElementById('endDate').addEventListener('change', updateReportPreview);
        </script>
    @endpush
@endsection