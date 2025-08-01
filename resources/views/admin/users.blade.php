@extends('layouts.app')

@section('title', 'Kelola Pengguna - Dashboard Admin')

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
                                    <i class="fas fa-users-cog"></i>
                                </div>
                                <div class="header-text">
                                    <h1 class="page-title">Kelola Pengguna</h1>
                                    <p class="page-subtitle">Kelola pengguna platform ({{ $users->total() }} total pengguna)
                                    </p>
                                </div>
                            </div>
                            <div class="header-actions">
                                <a href="{{ route('admin.dashboard') }}" class="glass-btn glass-btn-outline">
                                    <i class="fas fa-arrow-left me-2"></i>Kembali ke Dashboard
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Statistics Cards -->
            <div class="row g-4 mb-5">
                <div class="col-md-4">
                    <div class="glass-card stat-card danger-stat">
                        <div class="stat-icon danger">
                            <i class="fas fa-crown"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-header">
                                <h6 class="stat-label">Administrator</h6>
                                <div class="stat-trend neutral">
                                    <i class="fas fa-shield-alt"></i>
                                </div>
                            </div>
                            <h2 class="stat-number">{{ \App\Models\User::where('role', 'admin')->count() }}</h2>
                            <p class="stat-description">Administrator sistem</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="glass-card stat-card primary-stat">
                        <div class="stat-icon primary">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-header">
                                <h6 class="stat-label">Pemilik Kos</h6>
                                <div class="stat-trend up">
                                    <i class="fas fa-arrow-up"></i>
                                </div>
                            </div>
                            <h2 class="stat-number">{{ \App\Models\User::where('role', 'pemilik')->count() }}</h2>
                            <p class="stat-description">Pemilik properti</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="glass-card stat-card success-stat">
                        <div class="stat-icon success">
                            <i class="fas fa-user-friends"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-header">
                                <h6 class="stat-label">Penyewa</h6>
                                <div class="stat-trend up">
                                    <i class="fas fa-arrow-up"></i>
                                </div>
                            </div>
                            <h2 class="stat-number">{{ \App\Models\User::where('role', 'penyewa')->count() }}</h2>
                            <p class="stat-description">Penyewa terdaftar</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Users Table -->
            <div class="row">
                <div class="col-12">
                    <div class="glass-card table-card">
                        <div class="card-header-custom">
                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                <div class="header-info">
                                    <h5 class="table-title">
                                        <i class="fas fa-users me-2"></i>Semua Pengguna
                                    </h5>
                                    <p class="table-subtitle">Daftar semua pengguna terdaftar di platform</p>
                                </div>
                                <div class="header-actions">
                                    <div class="glass-btn glass-btn-outline user-count-badge">
                                        <i class="fas fa-user-check me-2"></i>{{ $users->total() }} Pengguna
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body-custom">
                            @if($users->count() > 0)
                                <div class="glass-table-wrapper">
                                    <div class="table-responsive">
                                        <table class="glass-table">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <i class="fas fa-user me-2"></i>Informasi Pengguna
                                                    </th>
                                                    <th>
                                                        <i class="fas fa-envelope me-2"></i>Kontak
                                                    </th>
                                                    <th>
                                                        <i class="fas fa-user-tag me-2"></i>Peran
                                                    </th>
                                                    <th>
                                                        <i class="fas fa-calendar me-2"></i>Bergabung
                                                    </th>
                                                    <th>
                                                        <i class="fas fa-chart-bar me-2"></i>Aktivitas
                                                    </th>
                                                    <th>
                                                        <i class="fas fa-cogs me-2"></i>Aksi
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($users as $user)
                                                    <tr class="table-row" data-user-id="{{ $user->id }}"
                                                        data-user-name="{{ $user->name }}" data-user-email="{{ $user->email }}"
                                                        data-user-phone="{{ $user->phone ?? '' }}"
                                                        data-user-role="{{ $user->role }}"
                                                        data-user-verified="{{ $user->email_verified_at ? 'true' : 'false' }}"
                                                        data-user-created="{{ $user->created_at->format('Y-m-d H:i:s') }}"
                                                        data-user-updated="{{ $user->updated_at->format('Y-m-d H:i:s') }}"
                                                        data-kos-count="{{ $user->role === 'pemilik' ? $user->kos()->count() : 0 }}"
                                                        data-transaction-count="{{ $user->role === 'penyewa' ? $user->transaksis()->count() : 0 }}">
                                                        <td>
                                                            <div class="user-info">
                                                                <div class="user-avatar">
                                                                    <i class="fas fa-user-circle"></i>
                                                                </div>
                                                                <div class="user-details">
                                                                    <div class="user-name">
                                                                        {{ $user->name }}
                                                                        @if($user->email_verified_at)
                                                                            <span class="verification-badge verified">
                                                                                <i class="fas fa-check-circle"></i>
                                                                            </span>
                                                                        @else
                                                                            <span class="verification-badge unverified">
                                                                                <i class="fas fa-exclamation-circle"></i>
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                    <div class="user-id">ID: #{{ $user->id }}</div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="contact-info">
                                                                <div class="contact-email">
                                                                    <i class="fas fa-envelope contact-icon"></i>
                                                                    {{ Str::limit($user->email, 25) }}
                                                                </div>
                                                                <div class="contact-phone">
                                                                    <i class="fas fa-phone contact-icon"></i>
                                                                    {{ $user->phone ?? 'Tidak tersedia' }}
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            @if($user->role == 'admin')
                                                                <div class="enhanced-badge admin-badge">
                                                                    <div class="badge-icon">
                                                                        <i class="fas fa-crown"></i>
                                                                    </div>
                                                                    <div class="badge-content">
                                                                        <div class="badge-title">ADMIN</div>
                                                                        <div class="badge-subtitle">Administrator</div>
                                                                    </div>
                                                                    <div class="badge-glow admin-glow"></div>
                                                                </div>
                                                            @elseif($user->role == 'pemilik')
                                                                <div class="enhanced-badge owner-badge">
                                                                    <div class="badge-icon">
                                                                        <i class="fas fa-user-tie"></i>
                                                                    </div>
                                                                    <div class="badge-content">
                                                                        <div class="badge-title">PEMILIK</div>
                                                                        <div class="badge-subtitle">Pemilik Kos</div>
                                                                    </div>
                                                                    <div class="badge-glow owner-glow"></div>
                                                                </div>
                                                            @else
                                                                <div class="enhanced-badge tenant-badge">
                                                                    <div class="badge-icon">
                                                                        <i class="fas fa-user-friends"></i>
                                                                    </div>
                                                                    <div class="badge-content">
                                                                        <div class="badge-title">PENYEWA</div>
                                                                        <div class="badge-subtitle">Pencari Kos</div>
                                                                    </div>
                                                                    <div class="badge-glow tenant-glow"></div>
                                                                </div>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <div class="date-info">
                                                                <div class="date-primary">{{ $user->created_at->format('d M Y') }}
                                                                </div>
                                                                <div class="date-secondary">{{ $user->created_at->diffForHumans() }}
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="activity-stats">
                                                                @if($user->role == 'pemilik')
                                                                    <div class="activity-item">
                                                                        <span class="activity-icon">
                                                                            <i class="fas fa-home"></i>
                                                                        </span>
                                                                        <span class="activity-count">{{ $user->kos()->count() }}
                                                                            Kos</span>
                                                                    </div>
                                                                @else
                                                                    <div class="activity-item">
                                                                        <span class="activity-icon">
                                                                            <i class="fas fa-phone"></i>
                                                                        </span>
                                                                        <span class="activity-count">{{ $user->transaksis()->count() }}
                                                                            Kontak</span>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="action-buttons">
                                                                @if($user->role != 'admin')
                                                                    <div class="action-group">
                                                                        <button type="button"
                                                                            class="glass-btn-sm glass-btn-info detail-btn"
                                                                            data-user-id="{{ $user->id }}"
                                                                            data-user-name="{{ $user->name }}"
                                                                            data-user-email="{{ $user->email }}"
                                                                            data-user-phone="{{ $user->phone ?? '' }}"
                                                                            data-user-role="{{ $user->role }}"
                                                                            data-user-verified="{{ $user->email_verified_at ? 'true' : 'false' }}"
                                                                            data-user-created="{{ $user->created_at->format('Y-m-d H:i:s') }}"
                                                                            data-user-updated="{{ $user->updated_at->format('Y-m-d H:i:s') }}"
                                                                            data-kos-count="{{ $user->role === 'pemilik' ? $user->kos()->count() : 0 }}"
                                                                            data-transaction-count="{{ $user->role === 'penyewa' ? $user->transaksis()->count() : 0 }}"
                                                                            title="Lihat Detail">
                                                                            <i class="fas fa-eye"></i>
                                                                        </button>
                                                                        <button type="button"
                                                                            class="glass-btn-sm glass-btn-danger delete-btn"
                                                                            data-user-id="{{ $user->id }}"
                                                                            data-user-name="{{ $user->name }}" title="Hapus Pengguna">
                                                                            <i class="fas fa-trash"></i>
                                                                        </button>
                                                                    </div>
                                                                @else
                                                                    <span class="protected-badge">
                                                                        <i class="fas fa-shield-alt me-1"></i>Dilindungi
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Pagination -->
                                @if($users->hasPages())
                                    <div class="pagination-wrapper">
                                        <div class="glass-pagination">
                                            {{ $users->links('pagination::bootstrap-4') }}
                                        </div>
                                    </div>
                                @endif
                            @else
                                <!-- Empty State -->
                                <div class="empty-state">
                                    <div class="empty-icon">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <h5 class="empty-title">Tidak Ada Pengguna</h5>
                                    <p class="empty-description">
                                        Belum ada pengguna yang terdaftar di sistem
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- User Details Modal -->
        <div class="modal fade" id="userDetailsModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content glass-modal">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="fas fa-user-circle text-primary me-2"></i>
                            Detail Pengguna
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body" id="userDetailsContent">
                        <!-- User details will be loaded here -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="glass-btn glass-btn-outline" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i>Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div class="modal fade" id="deleteUserModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content glass-modal">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="fas fa-exclamation-triangle text-warning me-2"></i>
                            Konfirmasi Hapus Pengguna
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <p class="modal-text">Apakah Anda yakin ingin menghapus pengguna <strong
                                id="deleteUserName"></strong>?</p>
                        <p class="modal-warning">
                            <i class="fas fa-info-circle me-2"></i>
                            Tindakan ini tidak dapat dibatalkan dan akan menghapus semua data pengguna serta catatan terkait
                            secara permanen.
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="glass-btn glass-btn-outline" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i>Batal
                        </button>
                        <form id="deleteUserForm" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="glass-btn glass-btn-danger">
                                <i class="fas fa-trash me-2"></i>Ya, Hapus Pengguna
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

                .primary-stat:hover {
                    background: rgba(102, 126, 234, 0.1);
                }

                .success-stat:hover {
                    background: rgba(17, 153, 142, 0.1);
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

                .stat-icon.primary {
                    background: var(--gradient-primary);
                    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
                }

                .stat-icon.success {
                    background: var(--gradient-success);
                    box-shadow: 0 8px 25px rgba(17, 153, 142, 0.3);
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

                .user-count-badge {
                    background: var(--glass-bg-light);
                    border: 1px solid rgba(255, 255, 255, 0.3);
                    padding: 0.75rem 1.25rem;
                    border-radius: 50px;
                    font-size: 0.9rem;
                    font-weight: 600;
                    color: var(--white);
                }

                /* Glass Table */
                .glass-table-wrapper {
                    background: var(--glass-bg);
                    border: 1px solid var(--glass-border);
                    border-radius: 15px;
                    overflow: hidden;
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

                /* User Info Styling */
                .user-info {
                    display: flex;
                    align-items: center;
                    gap: 1rem;
                }

                .user-avatar {
                    width: 45px;
                    height: 45px;
                    border-radius: 50%;
                    background: var(--gradient-primary);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 1.5rem;
                    color: var(--white);
                    flex-shrink: 0;
                }

                .user-name {
                    color: var(--white);
                    font-weight: 600;
                    font-size: 1rem;
                    margin-bottom: 0.25rem;
                    display: flex;
                    align-items: center;
                    gap: 0.5rem;
                }

                .user-id {
                    color: rgba(255, 255, 255, 0.6);
                    font-size: 0.8rem;
                }

                .verification-badge {
                    font-size: 0.8rem;
                }

                .verification-badge.verified {
                    color: #22c55e;
                }

                .verification-badge.unverified {
                    color: #f59e0b;
                }

                /* Contact Info */
                .contact-info .contact-email,
                .contact-info .contact-phone {
                    display: flex;
                    align-items: center;
                    gap: 0.5rem;
                    margin-bottom: 0.25rem;
                }

                .contact-email {
                    color: var(--white);
                    font-size: 0.9rem;
                }

                .contact-phone {
                    color: rgba(255, 255, 255, 0.7);
                    font-size: 0.85rem;
                }

                .contact-icon {
                    color: rgba(255, 255, 255, 0.6);
                    font-size: 0.8rem;
                    width: 12px;
                }

                /* Date Info */
                .date-info .date-primary {
                    color: var(--white);
                    font-weight: 600;
                    font-size: 0.9rem;
                    margin-bottom: 0.25rem;
                }

                .date-info .date-secondary {
                    color: rgba(255, 255, 255, 0.6);
                    font-size: 0.8rem;
                }

                /* Activity Stats */
                .activity-stats .activity-item {
                    display: flex;
                    align-items: center;
                    gap: 0.5rem;
                    padding: 0.5rem 0.75rem;
                    background: var(--glass-bg);
                    border: 1px solid var(--glass-border);
                    border-radius: 10px;
                }

                .activity-icon {
                    color: rgba(255, 255, 255, 0.7);
                    font-size: 0.8rem;
                }

                .activity-count {
                    color: var(--white);
                    font-size: 0.85rem;
                    font-weight: 600;
                }

                /* Enhanced Role Badges */
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

                /* Admin Badge */
                .admin-badge {
                    background: linear-gradient(135deg, rgba(220, 38, 38, 0.2) 0%, rgba(153, 27, 27, 0.15) 100%);
                    border-color: rgba(220, 38, 38, 0.4);
                    color: #ffffff;
                }

                .admin-badge .badge-icon {
                    background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%);
                    color: #ffffff;
                    box-shadow: 0 4px 15px rgba(220, 38, 38, 0.4);
                }

                .admin-glow {
                    background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%);
                }

                .admin-badge:hover {
                    background: linear-gradient(135deg, rgba(220, 38, 38, 0.3) 0%, rgba(153, 27, 27, 0.25) 100%);
                    border-color: rgba(220, 38, 38, 0.6);
                    box-shadow: 0 15px 40px rgba(220, 38, 38, 0.3);
                }

                /* Owner Badge */
                .owner-badge {
                    background: linear-gradient(135deg, rgba(59, 130, 246, 0.2) 0%, rgba(37, 99, 235, 0.15) 100%);
                    border-color: rgba(59, 130, 246, 0.4);
                    color: #ffffff;
                }

                .owner-badge .badge-icon {
                    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
                    color: #ffffff;
                    box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4);
                }

                .owner-glow {
                    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
                }

                .owner-badge:hover {
                    background: linear-gradient(135deg, rgba(59, 130, 246, 0.3) 0%, rgba(37, 99, 235, 0.25) 100%);
                    border-color: rgba(59, 130, 246, 0.6);
                    box-shadow: 0 15px 40px rgba(59, 130, 246, 0.3);
                }

                /* Tenant Badge */
                .tenant-badge {
                    background: linear-gradient(135deg, rgba(34, 197, 94, 0.2) 0%, rgba(21, 128, 61, 0.15) 100%);
                    border-color: rgba(34, 197, 94, 0.4);
                    color: #ffffff;
                }

                .tenant-badge .badge-icon {
                    background: linear-gradient(135deg, #22c55e 0%, #15803d 100%);
                    color: #ffffff;
                    box-shadow: 0 4px 15px rgba(34, 197, 94, 0.4);
                }

                .tenant-glow {
                    background: linear-gradient(135deg, #22c55e 0%, #15803d 100%);
                }

                .tenant-badge:hover {
                    background: linear-gradient(135deg, rgba(34, 197, 94, 0.3) 0%, rgba(21, 128, 61, 0.25) 100%);
                    border-color: rgba(34, 197, 94, 0.6);
                    box-shadow: 0 15px 40px rgba(34, 197, 94, 0.3);
                }

                /* Action Buttons */
                .action-buttons {
                    display: flex;
                    gap: 0.5rem;
                    align-items: center;
                    pointer-events: auto;
                }

                .action-group {
                    display: flex;
                    gap: 0.5rem;
                    pointer-events: auto;
                }

                .glass-btn-sm {
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
                    cursor: pointer;
                    pointer-events: auto;
                    position: relative;
                    z-index: 10;
                }

                .glass-btn-sm.glass-btn-info {
                    color: #60a5fa;
                    border-color: rgba(96, 165, 250, 0.3);
                }

                .glass-btn-sm.glass-btn-info:hover {
                    background: rgba(96, 165, 250, 0.1);
                    color: var(--white);
                    transform: scale(1.1);
                    box-shadow: 0 4px 15px rgba(96, 165, 250, 0.3);
                }

                .glass-btn-sm.glass-btn-danger {
                    color: #ef4444;
                    border-color: rgba(239, 68, 68, 0.3);
                }

                .glass-btn-sm.glass-btn-danger:hover {
                    background: rgba(239, 68, 68, 0.1);
                    color: var(--white);
                    transform: scale(1.1);
                    box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
                }

                .protected-badge {
                    display: inline-flex;
                    align-items: center;
                    padding: 0.4rem 0.8rem;
                    background: rgba(156, 163, 175, 0.2);
                    color: #9ca3af;
                    border: 1px solid rgba(156, 163, 175, 0.3);
                    border-radius: 20px;
                    font-size: 0.8rem;
                    font-weight: 600;
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
                    margin: 0 auto;
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

                /* User Details Modal Styles */
                .user-details-container {
                    font-family: 'Inter', sans-serif;
                }

                .user-details-header {
                    background: var(--glass-bg-light);
                    border: 1px solid var(--glass-border);
                    border-radius: 15px;
                    padding: 2rem;
                    margin-bottom: 2rem;
                }

                .user-title {
                    font-family: 'Poppins', sans-serif;
                    font-weight: 800;
                    color: var(--white);
                    font-size: 1.8rem;
                    margin-bottom: 1rem;
                }

                .user-meta {
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

                .section-title {
                    font-family: 'Poppins', sans-serif;
                    font-weight: 700;
                    color: var(--white);
                    font-size: 1.1rem;
                    margin-bottom: 1.5rem;
                    padding-bottom: 0.75rem;
                    border-bottom: 1px solid var(--glass-border);
                }

                .info-grid {
                    display: grid;
                    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                    gap: 1rem;
                }

                .info-item {
                    background: var(--glass-bg);
                    border: 1px solid var(--glass-border);
                    border-radius: 10px;
                    padding: 1.25rem;
                    transition: all 0.3s ease;
                }

                .info-item:hover {
                    background: var(--glass-bg-light);
                    transform: translateY(-2px);
                }

                .info-icon {
                    width: 40px;
                    height: 40px;
                    background: var(--gradient-primary);
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    color: white;
                    font-size: 1rem;
                    margin-bottom: 1rem;
                }

                .info-label {
                    font-size: 0.8rem;
                    color: rgba(255, 255, 255, 0.6);
                    text-transform: uppercase;
                    letter-spacing: 0.5px;
                    margin-bottom: 0.5rem;
                }

                .info-value {
                    color: var(--white);
                    font-weight: 600;
                    font-size: 1rem;
                    line-height: 1.4;
                }

                .role-display {
                    text-align: center;
                    padding: 1.5rem;
                }

                /* Statistics Display */
                .stats-section {
                    background: var(--glass-bg);
                    border: 1px solid var(--glass-border);
                    border-radius: 15px;
                    padding: 2rem;
                    margin-top: 2rem;
                }

                .stats-grid {
                    display: grid;
                    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
                    gap: 1.5rem;
                    margin-top: 1.5rem;
                }

                .stat-item-modal {
                    text-align: center;
                    background: var(--glass-bg-light);
                    border: 1px solid var(--glass-border);
                    border-radius: 12px;
                    padding: 1.5rem;
                    transition: all 0.3s ease;
                }

                .stat-item-modal:hover {
                    transform: translateY(-3px);
                    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
                }

                .stat-icon-modal {
                    width: 50px;
                    height: 50px;
                    background: var(--gradient-secondary);
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    color: white;
                    font-size: 1.2rem;
                    margin: 0 auto 1rem;
                }

                .stat-number-modal {
                    font-family: 'Poppins', sans-serif;
                    font-size: 2rem;
                    font-weight: 800;
                    color: var(--white);
                    line-height: 1;
                    margin-bottom: 0.5rem;
                }

                .stat-label-modal {
                    font-size: 0.85rem;
                    color: rgba(255, 255, 255, 0.7);
                    text-transform: uppercase;
                    letter-spacing: 0.5px;
                }

                /* Button click animation */
                .button-clicked {
                    transform: scale(0.95) !important;
                    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.3) !important;
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

                    .glass-table thead th,
                    .glass-table tbody td {
                        padding: 1rem 0.75rem;
                        font-size: 0.85rem;
                    }

                    .user-info {
                        flex-direction: column;
                        text-align: center;
                    }

                    .contact-info .contact-email,
                    .contact-info .contact-phone {
                        font-size: 0.8rem;
                    }

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

                    .action-group {
                        justify-content: center;
                    }

                    .d-flex.justify-content-between {
                        flex-direction: column;
                        gap: 1rem;
                    }

                    .header-actions {
                        align-self: stretch;
                    }

                    .user-details-header {
                        padding: 1.5rem;
                    }

                    .user-details-header .row {
                        text-align: center;
                    }

                    .user-title {
                        font-size: 1.5rem;
                    }

                    .user-meta {
                        align-items: center;
                    }

                    .info-grid {
                        grid-template-columns: 1fr;
                    }

                    .stats-grid {
                        grid-template-columns: repeat(2, 1fr);
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

                    .user-avatar {
                        width: 35px;
                        height: 35px;
                        font-size: 1.2rem;
                    }

                    .user-name {
                        font-size: 0.9rem;
                    }

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

                    .stats-grid {
                        grid-template-columns: 1fr;
                    }

                    .info-item {
                        padding: 1rem;
                        text-align: center;
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
                .glass-btn-sm:focus,
                .enhanced-badge:focus {
                    outline: 2px solid rgba(255, 255, 255, 0.5);
                    outline-offset: 2px;
                }

                /* Ripple Effect */
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
            </style>
        @endpush

        @push('scripts')
            <script>
                // Global variables
                let isInitialized = false;

                // Main initialization function
                function initializeUserManagement() {
                    if (isInitialized) {
                        console.log('Already initialized');
                        return;
                    }

                    console.log('Initializing User Management Interface...');

                    // Check if Bootstrap is available
                    if (typeof bootstrap === 'undefined') {
                        console.error('Bootstrap is not loaded!');
                        showError('Bootstrap tidak dimuat. Pastikan Bootstrap JS sudah dimuat.');
                        return;
                    }

                    // Check if required modals exist
                    const userDetailsModal = document.getElementById('userDetailsModal');
                    const deleteUserModal = document.getElementById('deleteUserModal');

                    if (!userDetailsModal) {
                        console.error('User details modal not found!');
                        showError('Modal detail pengguna tidak ditemukan!');
                        return;
                    }

                    if (!deleteUserModal) {
                        console.error('Delete user modal not found!');
                        showError('Modal hapus pengguna tidak ditemukan!');
                        return;
                    }

                    // Initialize event listeners
                    initializeEventListeners();

                    // Initialize enhanced interactions
                    initializeEnhancedInteractions();

                    // Run animations
                    setTimeout(() => {
                        animateNumbers();
                    }, 500);

                    isInitialized = true;
                    console.log('✅ User Management Interface initialized successfully!');
                }

                // Initialize all event listeners
                function initializeEventListeners() {
                    console.log('Setting up event listeners...');

                    // Detail button event listeners
                    const detailButtons = document.querySelectorAll('.detail-btn');
                    console.log(`Found ${detailButtons.length} detail buttons`);

                    detailButtons.forEach((button, index) => {
                        console.log(`Setting up detail button ${index + 1}:`, button);

                        // Remove any existing event listeners
                        button.removeEventListener('click', handleDetailClick);

                        // Add new event listener
                        button.addEventListener('click', handleDetailClick);

                        // Add visual feedback
                        button.addEventListener('mouseenter', function () {
                            this.style.backgroundColor = 'rgba(96, 165, 250, 0.2)';
                            this.style.transform = 'scale(1.05)';
                        });

                        button.addEventListener('mouseleave', function () {
                            this.style.backgroundColor = '';
                            this.style.transform = '';
                        });
                    });

                    // Delete button event listeners
                    const deleteButtons = document.querySelectorAll('.delete-btn');
                    console.log(`Found ${deleteButtons.length} delete buttons`);

                    deleteButtons.forEach((button, index) => {
                        console.log(`Setting up delete button ${index + 1}:`, button);

                        // Remove any existing event listeners
                        button.removeEventListener('click', handleDeleteClick);

                        // Add new event listener
                        button.addEventListener('click', handleDeleteClick);

                        // Add visual feedback
                        button.addEventListener('mouseenter', function () {
                            this.style.backgroundColor = 'rgba(239, 68, 68, 0.2)';
                            this.style.transform = 'scale(1.05)';
                        });

                        button.addEventListener('mouseleave', function () {
                            this.style.backgroundColor = '';
                            this.style.transform = '';
                        });
                    });

                    // Delete form submission listener
                    const deleteForm = document.getElementById('deleteUserForm');
                    if (deleteForm) {
                        deleteForm.addEventListener('submit', function () {
                            const submitBtn = this.querySelector('button[type="submit"]');
                            if (submitBtn) {
                                const originalHtml = submitBtn.innerHTML;
                                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menghapus...';
                                submitBtn.disabled = true;

                                // Re-enable button after 5 seconds (in case of error)
                                setTimeout(() => {
                                    submitBtn.innerHTML = originalHtml;
                                    submitBtn.disabled = false;
                                }, 5000);
                            }
                        });
                    }

                    console.log('✅ Event listeners set up successfully');
                }

                // Handle detail button click
                function handleDetailClick(event) {
                    event.preventDefault();
                    event.stopPropagation();

                    console.log('Detail button clicked:', this);

                    // Add click animation
                    this.classList.add('button-clicked');
                    setTimeout(() => {
                        this.classList.remove('button-clicked');
                    }, 150);

                    // Get user data from button attributes
                    const userData = extractUserData(this);

                    if (userData) {
                        showUserDetails(userData);
                    } else {
                        showError('Tidak dapat menemukan data pengguna');
                    }
                }

                // Handle delete button click
                function handleDeleteClick(event) {
                    event.preventDefault();
                    event.stopPropagation();

                    console.log('Delete button clicked:', this);

                    // Add click animation
                    this.classList.add('button-clicked');
                    setTimeout(() => {
                        this.classList.remove('button-clicked');
                    }, 150);

                    const userId = this.dataset.userId;
                    const userName = this.dataset.userName;

                    if (userId && userName) {
                        showDeleteConfirmation(userId, userName);
                    } else {
                        showError('Tidak dapat menemukan data pengguna untuk dihapus');
                    }
                }

                // Extract user data from button or row
                function extractUserData(buttonElement) {
                    console.log('Extracting user data from:', buttonElement);

                    // First try to get data from button attributes
                    let userData = {
                        id: buttonElement.dataset.userId,
                        name: buttonElement.dataset.userName,
                        email: buttonElement.dataset.userEmail,
                        phone: buttonElement.dataset.userPhone,
                        role: buttonElement.dataset.userRole,
                        verified: buttonElement.dataset.userVerified === 'true',
                        created: buttonElement.dataset.userCreated,
                        updated: buttonElement.dataset.userUpdated,
                        kosCount: parseInt(buttonElement.dataset.kosCount) || 0,
                        transactionCount: parseInt(buttonElement.dataset.transactionCount) || 0
                    };

                    // If button doesn't have data, try to get from parent row
                    if (!userData.id) {
                        const row = buttonElement.closest('[data-user-id]');
                        if (row) {
                            userData = {
                                id: row.dataset.userId,
                                name: row.dataset.userName,
                                email: row.dataset.userEmail,
                                phone: row.dataset.userPhone,
                                role: row.dataset.userRole,
                                verified: row.dataset.userVerified === 'true',
                                created: row.dataset.userCreated,
                                updated: row.dataset.userUpdated,
                                kosCount: parseInt(row.dataset.kosCount) || 0,
                                transactionCount: parseInt(row.dataset.transactionCount) || 0
                            };
                        }
                    }

                    console.log('Extracted user data:', userData);
                    return userData.id ? userData : null;
                }

                // Show user details modal
                function showUserDetails(userData) {
                    try {
                        const modal = new bootstrap.Modal(document.getElementById('userDetailsModal'));
                        const modalTitle = document.querySelector('#userDetailsModal .modal-title');
                        const modalContent = document.getElementById('userDetailsContent');

                        // Update modal title
                        modalTitle.innerHTML = `
                                    <i class="fas fa-user-circle text-primary me-2"></i>
                                    Detail Pengguna: ${userData.name}
                                `;

                        // Show loading state
                        modalContent.innerHTML = `
                                    <div class="text-center py-4">
                                        <div class="spinner-border text-primary mb-3" role="status" style="width: 3rem; height: 3rem;">
                                            <span class="visually-hidden">Memuat...</span>
                                        </div>
                                        <p class="text-white">Memuat detail pengguna...</p>
                                    </div>
                                `;

                        modal.show();

                        // Display content after brief loading
                        setTimeout(() => {
                            displayUserDetails(userData, modalContent);
                        }, 300);

                        console.log('✅ User details modal shown');
                    } catch (error) {
                        console.error('Error showing user details:', error);
                        showError('Terjadi kesalahan saat memuat detail pengguna: ' + error.message);
                    }
                }

                // Display user details content
                function displayUserDetails(userData, contentContainer) {
                    // Format dates
                    const createdDate = new Date(userData.created).toLocaleDateString('id-ID', {
                        weekday: 'long',
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit'
                    });

                    const updatedDate = new Date(userData.updated).toLocaleDateString('id-ID', {
                        weekday: 'long',
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit'
                    });

                    // Determine role info
                    let roleInfo = {
                        name: 'Penyewa',
                        icon: 'fas fa-user-friends',
                        color: 'tenant',
                        description: 'Pencari Kos'
                    };

                    if (userData.role === 'admin') {
                        roleInfo = {
                            name: 'Administrator',
                            icon: 'fas fa-crown',
                            color: 'admin',
                            description: 'Administrator Sistem'
                        };
                    } else if (userData.role === 'pemilik') {
                        roleInfo = {
                            name: 'Pemilik Kos',
                            icon: 'fas fa-user-tie',
                            color: 'owner',
                            description: 'Pemilik Properti'
                        };
                    }

                    const modalContent = `
                                <div class="user-details-container">
                                    <!-- User Header -->
                                    <div class="user-details-header">
                                        <div class="row align-items-center">
                                            <div class="col-md-8">
                                                <h4 class="user-title">${userData.name}</h4>
                                                <div class="user-meta">
                                                    <div class="meta-item">
                                                        <i class="fas fa-envelope text-primary me-2"></i>
                                                        <span>${userData.email}</span>
                                                    </div>
                                                    ${userData.phone && userData.phone.trim() !== '' ? `
                                                        <div class="meta-item">
                                                            <i class="fas fa-phone text-info me-2"></i>
                                                            <span>${userData.phone}</span>
                                                        </div>
                                                    ` : `
                                                        <div class="meta-item">
                                                            <i class="fas fa-phone text-muted me-2"></i>
                                                            <span class="text-white-50">Nomor telepon tidak tersedia</span>
                                                        </div>
                                                    `}
                                                    <div class="meta-item">
                                                        <i class="fas fa-calendar-plus text-success me-2"></i>
                                                        <span>Bergabung: ${createdDate}</span>
                                                    </div>
                                                    <div class="meta-item">
                                                        <i class="fas fa-clock text-warning me-2"></i>
                                                        <span>Terakhir update: ${updatedDate}</span>
                                                    </div>
                                                    <div class="meta-item">
                                                        <i class="fas fa-${userData.verified ? 'check-circle text-success' : 'exclamation-circle text-warning'} me-2"></i>
                                                        <span>${userData.verified ? 'Email sudah diverifikasi' : 'Email belum diverifikasi'}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 text-center">
                                                <div class="role-display">
                                                    <div class="enhanced-badge ${roleInfo.color}-badge">
                                                        <div class="badge-icon">
                                                            <i class="${roleInfo.icon}"></i>
                                                        </div>
                                                        <div class="badge-content">
                                                            <div class="badge-title">${roleInfo.name.toUpperCase()}</div>
                                                            <div class="badge-subtitle">${roleInfo.description}</div>
                                                        </div>
                                                        <div class="badge-glow ${roleInfo.color}-glow"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Content Sections -->
                                    <div class="row g-4">
                                        <!-- Basic Information -->
                                        <div class="col-md-6">
                                            <div class="glass-card" style="padding: 2rem; height: 100%;">
                                                <h6 class="section-title">
                                                    <i class="fas fa-id-card me-2"></i>Informasi Dasar
                                                </h6>
                                                <div class="info-grid">
                                                    <div class="info-item">
                                                        <div class="info-icon">
                                                            <i class="fas fa-hashtag"></i>
                                                        </div>
                                                        <div class="info-label">ID Pengguna</div>
                                                        <div class="info-value">#${userData.id}</div>
                                                    </div>
                                                    <div class="info-item">
                                                        <div class="info-icon">
                                                            <i class="fas fa-user"></i>
                                                        </div>
                                                        <div class="info-label">Nama Lengkap</div>
                                                        <div class="info-value">${userData.name}</div>
                                                    </div>
                                                    <div class="info-item">
                                                        <div class="info-icon">
                                                            <i class="fas fa-envelope"></i>
                                                        </div>
                                                        <div class="info-label">Email</div>
                                                        <div class="info-value">${userData.email}</div>
                                                    </div>
                                                    <div class="info-item">
                                                        <div class="info-icon">
                                                            <i class="fas fa-phone"></i>
                                                        </div>
                                                        <div class="info-label">Nomor Telepon</div>
                                                        <div class="info-value">${userData.phone && userData.phone.trim() !== '' ? userData.phone : 'Tidak tersedia'}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Account Status -->
                                        <div class="col-md-6">
                                            <div class="glass-card" style="padding: 2rem; height: 100%;">
                                                <h6 class="section-title">
                                                    <i class="fas fa-shield-alt me-2"></i>Status Akun
                                                </h6>
                                                <div class="info-grid">
                                                    <div class="info-item">
                                                        <div class="info-icon">
                                                            <i class="fas fa-user-tag"></i>
                                                        </div>
                                                        <div class="info-label">Peran</div>
                                                        <div class="info-value">${roleInfo.name}</div>
                                                    </div>
                                                    <div class="info-item">
                                                        <div class="info-icon">
                                                            <i class="fas fa-${userData.verified ? 'check-circle' : 'exclamation-circle'}"></i>
                                                        </div>
                                                        <div class="info-label">Verifikasi Email</div>
                                                        <div class="info-value">${userData.verified ? 'Sudah Diverifikasi' : 'Belum Diverifikasi'}</div>
                                                    </div>
                                                    <div class="info-item">
                                                        <div class="info-icon">
                                                            <i class="fas fa-calendar-plus"></i>
                                                        </div>
                                                        <div class="info-label">Tanggal Bergabung</div>
                                                        <div class="info-value">${new Date(userData.created).toLocaleDateString('id-ID')}</div>
                                                    </div>
                                                    <div class="info-item">
                                                        <div class="info-icon">
                                                            <i class="fas fa-sync-alt"></i>
                                                        </div>
                                                        <div class="info-label">Terakhir Diperbarui</div>
                                                        <div class="info-value">${new Date(userData.updated).toLocaleDateString('id-ID')}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Activity Statistics -->
                                    <div class="stats-section">
                                        <h6 class="section-title">
                                            <i class="fas fa-chart-bar me-2"></i>Statistik Aktivitas
                                        </h6>
                                        <div class="stats-grid">
                                            ${userData.role === 'pemilik' ? `
                                                <div class="stat-item-modal">
                                                    <div class="stat-icon-modal">
                                                        <i class="fas fa-home"></i>
                                                    </div>
                                                    <div class="stat-number-modal">${userData.kosCount}</div>
                                                    <div class="stat-label-modal">Kos Terdaftar</div>
                                                </div>
                                                <div class="stat-item-modal">
                                                    <div class="stat-icon-modal">
                                                        <i class="fas fa-check-circle"></i>
                                                    </div>
                                                    <div class="stat-number-modal">0</div>
                                                    <div class="stat-label-modal">Kos Terverifikasi</div>
                                                </div>
                                            ` : `
                                                <div class="stat-item-modal">
                                                    <div class="stat-icon-modal">
                                                        <i class="fas fa-phone"></i>
                                                    </div>
                                                    <div class="stat-number-modal">${userData.transactionCount}</div>
                                                    <div class="stat-label-modal">Kontak Dilakukan</div>
                                                </div>
                                                <div class="stat-item-modal">
                                                    <div class="stat-icon-modal">
                                                        <i class="fas fa-heart"></i>
                                                    </div>
                                                    <div class="stat-number-modal">0</div>
                                                    <div class="stat-label-modal">Kos Difavorit</div>
                                                </div>
                                            `}
                                            <div class="stat-item-modal">
                                                <div class="stat-icon-modal">
                                                    <i class="fas fa-calendar"></i>
                                                </div>
                                                <div class="stat-number-modal">${Math.floor((new Date() - new Date(userData.created)) / (1000 * 60 * 60 * 24))}</div>
                                                <div class="stat-label-modal">Hari Bergabung</div>
                                            </div>
                                            <div class="stat-item-modal">
                                                <div class="stat-icon-modal">
                                                    <i class="fas fa-clock"></i>
                                                </div>
                                                <div class="stat-number-modal">${Math.floor((new Date() - new Date(userData.updated)) / (1000 * 60 * 60 * 24))}</div>
                                                <div class="stat-label-modal">Hari Tidak Aktif</div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Admin Actions -->
                                    ${userData.role !== 'admin' ? `
                                        <div class="modal-actions mt-4">
                                            <div class="d-flex gap-3 justify-content-center">
                                                <button type="button" class="glass-btn glass-btn-outline" onclick="sendMessage('${userData.email}')">
                                                    <i class="fas fa-envelope me-2"></i>Kirim Email
                                                </button>
                                                <button type="button" class="glass-btn glass-btn-danger" onclick="deleteUserFromModal(${userData.id}, '${userData.name}')">
                                                    <i class="fas fa-trash me-2"></i>Hapus Pengguna
                                                </button>
                                            </div>
                                        </div>
                                    ` : ''}
                                </div>
                            `;

                    contentContainer.innerHTML = modalContent;
                    console.log('✅ User details content displayed');
                }

                // Show delete confirmation modal
                function showDeleteConfirmation(userId, userName) {
                    try {
                        const deleteUserNameEl = document.getElementById('deleteUserName');
                        const deleteUserForm = document.getElementById('deleteUserForm');

                        if (!deleteUserNameEl || !deleteUserForm) {
                            showError('Elemen modal hapus tidak ditemukan');
                            return;
                        }

                        deleteUserNameEl.textContent = userName;
                        deleteUserForm.action = `/admin/users/${userId}/delete`;

                        // Close user details modal if open
                        const userDetailsModalEl = document.getElementById('userDetailsModal');
                        const userDetailsModal = bootstrap.Modal.getInstance(userDetailsModalEl);
                        if (userDetailsModal) {
                            userDetailsModal.hide();
                        }

                        const modal = new bootstrap.Modal(document.getElementById('deleteUserModal'));
                        modal.show();

                        console.log('✅ Delete confirmation modal shown');
                    } catch (error) {
                        console.error('Error showing delete confirmation:', error);
                        showError('Terjadi kesalahan saat membuka modal hapus: ' + error.message);
                    }
                }

                // Helper function for sending email
                function sendMessage(email) {
                    console.log('sendMessage called with:', email);
                    showInfo(`Fitur kirim email ke ${email} akan diimplementasikan`);
                }

                // Delete user from modal (called from detail modal)
                function deleteUserFromModal(userId, userName) {
                    showDeleteConfirmation(userId, userName);
                }

                // Initialize enhanced interactions
                function initializeEnhancedInteractions() {
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

                    // Add click animation to stat cards
                    document.querySelectorAll('.stat-card').forEach(card => {
                        card.addEventListener('click', function () {
                            this.style.transform = 'scale(0.98)';
                            setTimeout(() => {
                                this.style.transform = '';
                            }, 150);
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

                    console.log('✅ Enhanced interactions initialized');
                }

                // Animate number counting
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

                // Utility functions
                function showError(message) {
                    console.error('Error:', message);
                    alert('❌ Error: ' + message);
                }

                function showInfo(message) {
                    console.info('Info:', message);
                    alert('ℹ️ Info: ' + message);
                }

                // Make functions globally available
                window.sendMessage = sendMessage;
                window.deleteUserFromModal = deleteUserFromModal;

                // Initialize when DOM is ready
                if (document.readyState === 'loading') {
                    document.addEventListener('DOMContentLoaded', initializeUserManagement);
                } else {
                    // DOM is already ready
                    initializeUserManagement();
                }

                // Also initialize on window load as backup
                window.addEventListener('load', function () {
                    if (!isInitialized) {
                        console.log('Backup initialization on window load');
                        initializeUserManagement();
                    }
                });

                console.log('📋 User Management Script Loaded');
            </script>
        @endpush
@endsection