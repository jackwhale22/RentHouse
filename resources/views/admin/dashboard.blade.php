@extends('layouts.app')

@section('title', 'Admin Dashboard - Kos Finder')

@section('content')
    <div class="container-fluid glassmorphism-dashboard">
        <div class="container py-5">
            <!-- Dashboard Header -->
            <div class="row mb-5">
                <div class="col-12">
                    <div class="glass-card dashboard-header">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <div class="header-content">
                                <div class="header-icon">
                                    <i class="fas fa-crown"></i>
                                </div>
                                <div class="header-text">
                                    <h1 class="dashboard-title">Admin Dashboard</h1>
                                    <p class="dashboard-subtitle">Kelola sistem dan pantau aktivitas platform</p>
                                </div>
                            </div>
                            <div class="header-actions">
                                <a href="{{ route('admin.verify-kos') }}" class="glass-btn glass-btn-primary">
                                    <i class="fas fa-check-circle me-2"></i>Verifikasi Kos
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="row g-4 mb-5">
                <!-- Total Users -->
                <div class="col-md-6 col-lg-3">
                    <div class="glass-card stat-card primary-stat">
                        <div class="stat-icon primary">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-header">
                                <h6 class="stat-label">Total Users</h6>
                                <div class="stat-trend up">
                                    <i class="fas fa-arrow-up"></i>
                                </div>
                            </div>
                            <h2 class="stat-number">{{ $totalUsers }}</h2>
                            <p class="stat-description">Seluruh pengguna platform</p>
                        </div>
                    </div>
                </div>

                <!-- Total Kos -->
                <div class="col-md-6 col-lg-3">
                    <div class="glass-card stat-card success-stat">
                        <div class="stat-icon success">
                            <i class="fas fa-home"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-header">
                                <h6 class="stat-label">Total Kos</h6>
                                <div class="stat-trend up">
                                    <i class="fas fa-arrow-up"></i>
                                </div>
                            </div>
                            <h2 class="stat-number">{{ $totalKos }}</h2>
                            <p class="stat-description">Semua listing kos</p>
                        </div>
                    </div>
                </div>

                <!-- Pending Verification -->
                <div class="col-md-6 col-lg-3">
                    <div class="glass-card stat-card warning-stat">
                        <div class="stat-icon warning">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-header">
                                <h6 class="stat-label">Menunggu Verifikasi</h6>
                                <div class="stat-trend neutral">
                                    <i class="fas fa-minus"></i>
                                </div>
                            </div>
                            <h2 class="stat-number">{{ $pendingKos }}</h2>
                            <p class="stat-description">Perlu direview admin</p>
                        </div>
                    </div>
                </div>

                <!-- Total Contacts -->
                <div class="col-md-6 col-lg-3">
                    <div class="glass-card stat-card info-stat">
                        <div class="stat-icon info">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-header">
                                <h6 class="stat-label">Total Kontak</h6>
                                <div class="stat-trend up">
                                    <i class="fas fa-arrow-up"></i>
                                </div>
                            </div>
                            <h2 class="stat-number">{{ $totalTransaksi }}</h2>
                            <p class="stat-description">Inquiry platform</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Statistics -->
            <div class="row g-4 mb-5">
                <div class="col-md-4">
                    <div class="glass-card stat-card gradient-primary">
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
                            <p class="stat-description">Owner aktif</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="glass-card stat-card gradient-success">
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
                            <p class="stat-description">Tenant terdaftar</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="glass-card stat-card gradient-info">
                        <div class="stat-icon info">
                            <i class="fas fa-check-double"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-header">
                                <h6 class="stat-label">Kos Terverifikasi</h6>
                                <div class="stat-trend up">
                                    <i class="fas fa-arrow-up"></i>
                                </div>
                            </div>
                            <h2 class="stat-number">{{ \App\Models\Kos::where('is_verified', true)->count() }}</h2>
                            <p class="stat-description">Telah diverifikasi</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activities and Quick Actions -->
            <div class="row g-4 mb-5">
                <!-- Quick Actions -->
                <div class="col-lg-6">
                    <div class="glass-card table-card">
                        <div class="card-header-custom">
                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                <div class="header-info">
                                    <h5 class="table-title">
                                        <i class="fas fa-bolt me-2"></i>Quick Actions
                                    </h5>
                                    <p class="table-subtitle">Aksi cepat untuk manajemen sistem</p>
                                </div>
                            </div>
                        </div>

                        <div class="card-body-custom">
                            <div class="quick-actions-grid">
                                <a href="{{ route('admin.verify-kos') }}" class="quick-action-item warning">
                                    <div class="quick-action-icon">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                    <div class="quick-action-content">
                                        <h6 class="quick-action-title">Verifikasi Kos</h6>
                                        <p class="quick-action-subtitle">{{ $pendingKos }} kos menunggu</p>
                                    </div>
                                    <div class="quick-action-arrow">
                                        <i class="fas fa-chevron-right"></i>
                                    </div>
                                </a>

                                <a href="{{ route('admin.users') }}" class="quick-action-item primary">
                                    <div class="quick-action-icon">
                                        <i class="fas fa-users-cog"></i>
                                    </div>
                                    <div class="quick-action-content">
                                        <h6 class="quick-action-title">Kelola Users</h6>
                                        <p class="quick-action-subtitle">{{ $totalUsers }} total users</p>
                                    </div>
                                    <div class="quick-action-arrow">
                                        <i class="fas fa-chevron-right"></i>
                                    </div>
                                </a>

                                <a href="#" class="quick-action-item success">
                                    <div class="quick-action-icon">
                                        <i class="fas fa-chart-bar"></i>
                                    </div>
                                    <div class="quick-action-content">
                                        <h6 class="quick-action-title">Laporan</h6>
                                        <p class="quick-action-subtitle">Analitik platform</p>
                                    </div>
                                    <div class="quick-action-arrow">
                                        <i class="fas fa-chevron-right"></i>
                                    </div>
                                </a>

                                <a href="#" class="quick-action-item info">
                                    <div class="quick-action-icon">
                                        <i class="fas fa-cogs"></i>
                                    </div>
                                    <div class="quick-action-content">
                                        <h6 class="quick-action-title">Settings</h6>
                                        <p class="quick-action-subtitle">Konfigurasi sistem</p>
                                    </div>
                                    <div class="quick-action-arrow">
                                        <i class="fas fa-chevron-right"></i>
                                    </div>
                                </a>
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

            /* Dashboard Header */
            .dashboard-header {
                padding: 2.5rem;
                margin-bottom: 2rem;
            }

            .dashboard-header:hover {
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

            .dashboard-title {
                font-family: 'Poppins', sans-serif;
                font-size: 2.5rem;
                font-weight: 800;
                color: var(--white);
                margin-bottom: 0.5rem;
            }

            .dashboard-subtitle {
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

            .primary-stat:hover,
            .gradient-primary:hover {
                background: rgba(102, 126, 234, 0.1);
            }

            .success-stat:hover,
            .gradient-success:hover {
                background: rgba(17, 153, 142, 0.1);
            }

            .warning-stat:hover {
                background: rgba(217, 119, 6, 0.1);
            }

            .info-stat:hover,
            .gradient-info:hover {
                background: rgba(14, 165, 233, 0.1);
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

            .stat-icon.warning {
                background: var(--gradient-accent);
                box-shadow: 0 8px 25px rgba(217, 119, 6, 0.3);
            }

            .stat-icon.info {
                background: var(--gradient-secondary);
                box-shadow: 0 8px 25px rgba(14, 165, 233, 0.3);
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

            /* Quick Actions Grid */
            .quick-actions-grid {
                display: grid;
                gap: 1rem;
            }

            .quick-action-item {
                display: flex;
                align-items: center;
                gap: 1rem;
                padding: 1.5rem;
                background: var(--glass-bg);
                border: 1px solid var(--glass-border);
                border-radius: 15px;
                text-decoration: none;
                transition: all 0.3s ease;
                position: relative;
                overflow: hidden;
            }

            .quick-action-item::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
                transition: left 0.6s ease;
            }

            .quick-action-item:hover::before {
                left: 100%;
            }

            .quick-action-item:hover {
                transform: translateX(10px);
                background: var(--glass-bg-light);
                box-shadow: 0 8px 25px rgba(255, 255, 255, 0.1);
                text-decoration: none;
            }

            .quick-action-item.primary:hover {
                border-color: rgba(102, 126, 234, 0.5);
            }

            .quick-action-item.success:hover {
                border-color: rgba(17, 153, 142, 0.5);
            }

            .quick-action-item.warning:hover {
                border-color: rgba(217, 119, 6, 0.5);
            }

            .quick-action-item.info:hover {
                border-color: rgba(14, 165, 233, 0.5);
            }

            .quick-action-icon {
                width: 50px;
                height: 50px;
                border-radius: 12px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.2rem;
                color: var(--white);
                flex-shrink: 0;
            }

            .quick-action-item.primary .quick-action-icon {
                background: var(--gradient-primary);
            }

            .quick-action-item.success .quick-action-icon {
                background: var(--gradient-success);
            }

            .quick-action-item.warning .quick-action-icon {
                background: var(--gradient-accent);
            }

            .quick-action-item.info .quick-action-icon {
                background: var(--gradient-secondary);
            }

            .quick-action-content {
                flex: 1;
            }

            .quick-action-title {
                font-family: 'Poppins', sans-serif;
                font-size: 1rem;
                font-weight: 600;
                color: var(--white);
                margin-bottom: 0.25rem;
            }

            .quick-action-subtitle {
                color: rgba(255, 255, 255, 0.7);
                font-size: 0.85rem;
                margin: 0;
            }

            .quick-action-arrow {
                color: rgba(255, 255, 255, 0.6);
                transition: all 0.3s ease;
            }

            .quick-action-item:hover .quick-action-arrow {
                color: var(--white);
                transform: translateX(5px);
            }

            /* System Overview */
            .system-overview {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: 1.5rem;
            }

            .overview-item {
                display: flex;
                align-items: center;
                gap: 1rem;
                padding: 1rem;
                background: var(--glass-bg);
                border: 1px solid var(--glass-border);
                border-radius: 12px;
                transition: all 0.3s ease;
            }

            .overview-item:hover {
                background: var(--glass-bg-light);
                transform: translateY(-2px);
            }

            .overview-icon {
                width: 40px;
                height: 40px;
                border-radius: 10px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1rem;
                color: var(--white);
                flex-shrink: 0;
            }

            .overview-icon.primary {
                background: var(--gradient-primary);
            }

            .overview-icon.success {
                background: var(--gradient-success);
            }

            .overview-icon.warning {
                background: var(--gradient-accent);
            }

            .overview-icon.info {
                background: var(--gradient-secondary);
            }

            .overview-title {
                font-size: 0.85rem;
                font-weight: 600;
                color: rgba(255, 255, 255, 0.8);
                margin-bottom: 0.25rem;
            }

            .overview-value {
                font-size: 0.9rem;
                font-weight: 700;
                margin: 0;
            }

            .overview-value.primary {
                color: #60a5fa;
            }

            .overview-value.success {
                color: #34d399;
            }

            .overview-value.warning {
                color: #fbbf24;
            }

            .overview-value.info {
                color: #60a5fa;
            }

            /* Activity Feed */
            .activity-feed {
                display: flex;
                flex-direction: column;
                gap: 1rem;
            }

            .activity-item {
                display: flex;
                align-items: flex-start;
                gap: 1rem;
                padding: 1.5rem;
                background: var(--glass-bg);
                border: 1px solid var(--glass-border);
                border-radius: 15px;
                transition: all 0.3s ease;
            }

            .activity-item:hover {
                background: var(--glass-bg-light);
                transform: translateX(5px);
            }

            .activity-icon {
                width: 40px;
                height: 40px;
                border-radius: 10px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1rem;
                color: var(--white);
                flex-shrink: 0;
            }

            .activity-icon.primary {
                background: var(--gradient-primary);
            }

            .activity-icon.success {
                background: var(--gradient-success);
            }

            .activity-icon.warning {
                background: var(--gradient-accent);
            }

            .activity-icon.info {
                background: var(--gradient-secondary);
            }

            .activity-title {
                font-size: 1rem;
                font-weight: 600;
                color: var(--white);
                margin-bottom: 0.25rem;
            }

            .activity-description {
                color: rgba(255, 255, 255, 0.8);
                font-size: 0.9rem;
                margin-bottom: 0.5rem;
                line-height: 1.4;
            }

            .activity-time {
                color: rgba(255, 255, 255, 0.6);
                font-size: 0.8rem;
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
                .dashboard-header {
                    padding: 2rem;
                }

                .header-content {
                    flex-direction: column;
                    text-align: center;
                    gap: 1rem;
                }

                .dashboard-title {
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

                .system-overview {
                    grid-template-columns: 1fr;
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
                .dashboard-title {
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

                .quick-action-item {
                    padding: 1rem;
                }

                .activity-item {
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
            .quick-action-item:focus {
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

            // Add ripple effect to buttons and action items
            document.querySelectorAll('.glass-btn, .quick-action-item').forEach(button => {
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

            // Run animations when page loads
            window.addEventListener('load', function () {
                setTimeout(animateNumbers, 500);
            });

            // Enhanced hover effects for activity items
            document.querySelectorAll('.activity-item').forEach(item => {
                item.addEventListener('mouseenter', function () {
                    this.style.boxShadow = '0 4px 20px rgba(255, 255, 255, 0.1)';
                });

                item.addEventListener('mouseleave', function () {
                    this.style.boxShadow = '';
                });
            });

            // Auto-refresh dashboard data every 5 minutes
            setInterval(() => {
                console.log('Auto-refreshing admin dashboard data...');
                // Add AJAX call here to refresh statistics
            }, 300000);

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