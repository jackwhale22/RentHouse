@extends('layouts.app')

@section('title', 'Daftar - Kos Finder')

@section('content')
<div class="container-fluid glassmorphism-register">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="glass-card register-card">
                    <!-- Header Section -->
                    <div class="register-header text-center mb-4">
                        <div class="header-icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <h2 class="register-title">Buat Akun</h2>
                        <p class="register-subtitle">Bergabunglah dengan Kos Finder hari ini</p>
                    </div>

                    <!-- Registration Form -->
                    <form method="POST" action="{{ route('register') }}" class="register-form">
                        @csrf
                        
                        <!-- Full Name -->
                        <div class="form-group">
                            <label for="name" class="glass-label">
                                <i class="fas fa-user me-2"></i>Nama Lengkap
                            </label>
                            <div class="glass-input-wrapper">
                                <input type="text" 
                                       class="glass-input @error('name') is-invalid @enderror" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name') }}" 
                                       placeholder="Masukkan nama lengkap Anda"
                                       required 
                                       autofocus>
                                <div class="input-icon">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                            @error('name')
                                <div class="glass-error">
                                    <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Email Address -->
                        <div class="form-group">
                            <label for="email" class="glass-label">
                                <i class="fas fa-envelope me-2"></i>Alamat Email
                            </label>
                            <div class="glass-input-wrapper">
                                <input type="email" 
                                       class="glass-input @error('email') is-invalid @enderror" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email') }}" 
                                       placeholder="nama@email.com"
                                       required>
                                <div class="input-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                            </div>
                            @error('email')
                                <div class="glass-error">
                                    <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Phone Number -->
                        <div class="form-group">
                            <label for="phone" class="glass-label">
                                <i class="fas fa-phone me-2"></i>Nomor Telepon <span class="optional">(Opsional)</span>
                            </label>
                            <div class="glass-input-wrapper">
                                <input type="text" 
                                       class="glass-input @error('phone') is-invalid @enderror" 
                                       id="phone" 
                                       name="phone" 
                                       value="{{ old('phone') }}"
                                       placeholder="08xxxxxxxxxx">
                                <div class="input-icon">
                                    <i class="fas fa-phone"></i>
                                </div>
                            </div>
                            @error('phone')
                                <div class="glass-error">
                                    <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Role Selection -->
                        <div class="form-group">
                            <label for="role" class="glass-label">
                                <i class="fas fa-users me-2"></i>Daftar sebagai
                            </label>
                            <div class="glass-select-wrapper">
                                <select class="glass-select @error('role') is-invalid @enderror" 
                                        id="role" 
                                        name="role" 
                                        required>
                                    <option value="">Pilih peran Anda</option>
                                    <option value="penyewa" {{ old('role') == 'penyewa' ? 'selected' : '' }}>
                                        Penyewa (Mencari Kos)
                                    </option>
                                    <option value="pemilik" {{ old('role') == 'pemilik' ? 'selected' : '' }}>
                                        Pemilik (Memiliki Kos untuk Disewakan)
                                    </option>
                                </select>
                                <div class="select-icon">
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                            </div>
                            @error('role')
                                <div class="glass-error">
                                    <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="form-group">
                            <label for="password" class="glass-label">
                                <i class="fas fa-lock me-2"></i>Kata Sandi
                            </label>
                            <div class="glass-input-wrapper">
                                <input type="password" 
                                       class="glass-input @error('password') is-invalid @enderror" 
                                       id="password" 
                                       name="password" 
                                       placeholder="Minimal 8 karakter"
                                       required>
                                <div class="input-icon">
                                    <i class="fas fa-lock"></i>
                                </div>
                                <button type="button" class="password-toggle" onclick="togglePassword('password')">
                                    <i class="fas fa-eye" id="password-eye"></i>
                                </button>
                            </div>
                            @error('password')
                                <div class="glass-error">
                                    <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="form-group">
                            <label for="password_confirmation" class="glass-label">
                                <i class="fas fa-lock me-2"></i>Konfirmasi Kata Sandi
                            </label>
                            <div class="glass-input-wrapper">
                                <input type="password" 
                                       class="glass-input" 
                                       id="password_confirmation" 
                                       name="password_confirmation" 
                                       placeholder="Ulangi kata sandi"
                                       required>
                                <div class="input-icon">
                                    <i class="fas fa-lock"></i>
                                </div>
                                <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation')">
                                    <i class="fas fa-eye" id="password_confirmation-eye"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group">
                            <button type="submit" class="glass-btn glass-btn-primary register-btn">
                                <i class="fas fa-user-plus me-2"></i>
                                <span class="btn-text">Buat Akun</span>
                                <span class="btn-loading" style="display: none;">
                                    <i class="fas fa-spinner fa-spin me-2"></i>Memproses...
                                </span>
                            </button>
                        </div>
                    </form>

                    <!-- Login Link -->
                    <div class="register-footer text-center">
                        <div class="footer-divider">
                            <span>atau</span>
                        </div>
                        <p class="login-link">
                            Sudah punya akun? 
                            <a href="{{ route('login') }}" class="glass-link">
                                Masuk di sini
                            </a>
                        </p>
                    </div>
                </div>

                <!-- Role Info Cards -->
                <div class="row g-3 mt-4">
                    <div class="col-md-6">
                        <div class="glass-card info-card tenant-card">
                            <div class="info-icon tenant">
                                <i class="fas fa-search"></i>
                            </div>
                            <h6 class="info-title">Sebagai Penyewa</h6>
                            <ul class="info-list">
                                <li><i class="fas fa-check me-2"></i>Cari kos sesuai budget</li>
                                <li><i class="fas fa-check me-2"></i>Hubungi pemilik langsung</li>
                                <li><i class="fas fa-check me-2"></i>Akses informasi lengkap</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="glass-card info-card owner-card">
                            <div class="info-icon owner">
                                <i class="fas fa-home"></i>
                            </div>
                            <h6 class="info-title">Sebagai Pemilik</h6>
                            <ul class="info-list">
                                <li><i class="fas fa-check me-2"></i>Iklankan kos gratis</li>
                                <li><i class="fas fa-check me-2"></i>Kelola data kos</li>
                                <li><i class="fas fa-check me-2"></i>Terima pesan calon penyewa</li>
                            </ul>
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

    .glassmorphism-register {
        background: var(--gradient-background);
        min-height: 100vh;
        position: relative;
        overflow-x: hidden;
    }

    .glassmorphism-register::before {
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

    /* Register Card */
    .register-card {
        padding: 3rem;
        margin-bottom: 2rem;
    }

    .register-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--glass-shadow-hover);
        background: var(--glass-bg-light);
    }

    /* Header */
    .register-header {
        margin-bottom: 3rem;
    }

    .header-icon {
        width: 80px;
        height: 80px;
        background: var(--gradient-primary);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        font-size: 2rem;
        color: var(--white);
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
        animation: pulse 3s ease-in-out infinite;
    }

    @keyframes pulse {
        0%, 100% {
            transform: scale(1);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
        }
        50% {
            transform: scale(1.05);
            box-shadow: 0 15px 40px rgba(102, 126, 234, 0.6);
        }
    }

    .register-title {
        font-family: 'Poppins', sans-serif;
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--white);
        margin-bottom: 0.5rem;
    }

    .register-subtitle {
        font-size: 1.1rem;
        color: rgba(255, 255, 255, 0.8);
        margin: 0;
    }

    /* Form Styles */
    .register-form {
        margin-bottom: 2rem;
    }

    .form-group {
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

    .optional {
        color: rgba(255, 255, 255, 0.6);
        font-weight: 400;
        font-size: 0.85rem;
    }

    /* Input Wrapper */
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
        padding: 1rem 1rem 1rem 3rem;
        font-size: 0.95rem;
        width: 100%;
        transition: all 0.3s ease;
        font-family: 'Inter', sans-serif;
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

    .glass-input.is-invalid,
    .glass-select.is-invalid {
        border-color: rgba(220, 38, 38, 0.8);
        box-shadow: 0 0 15px rgba(220, 38, 38, 0.3);
    }

    /* Input Icons */
    .input-icon,
    .select-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: rgba(255, 255, 255, 0.6);
        font-size: 0.9rem;
        pointer-events: none;
        z-index: 2;
    }

    .select-icon {
        right: 1rem;
        left: auto;
    }

    /* Password Toggle */
    .password-toggle {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: rgba(255, 255, 255, 0.6);
        cursor: pointer;
        padding: 0.5rem;
        border-radius: 50%;
        transition: all 0.3s ease;
        z-index: 3;
    }

    .password-toggle:hover {
        color: var(--white);
        background: var(--glass-bg);
    }

    /* Select Styling */
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

    /* Error Messages */
    .glass-error {
        color: #fecaca;
        font-size: 0.85rem;
        font-weight: 500;
        margin-top: 0.5rem;
        padding: 0.5rem 0.75rem;
        background: rgba(220, 38, 38, 0.1);
        border: 1px solid rgba(220, 38, 38, 0.3);
        border-radius: 10px;
        display: flex;
        align-items: center;
    }

    /* Glass Button */
    .glass-btn {
        background: var(--glass-bg);
        backdrop-filter: blur(25px);
        border: 1px solid var(--glass-border);
        border-radius: 50px;
        padding: 1rem 2rem;
        font-weight: 600;
        font-size: 1rem;
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
        width: 100%;
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
        transform: translateY(-3px);
    }

    .glass-btn-primary:active {
        transform: translateY(-1px);
    }

    .register-btn {
        padding: 1.25rem 2rem;
        font-size: 1.1rem;
        font-weight: 700;
        margin-top: 1rem;
    }

    /* Footer */
    .register-footer {
        margin-top: 2rem;
    }

    .footer-divider {
        position: relative;
        margin: 2rem 0 1.5rem;
        text-align: center;
    }

    .footer-divider::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    }

    .footer-divider span {
        background: var(--glass-bg);
        color: rgba(255, 255, 255, 0.7);
        padding: 0 1rem;
        font-size: 0.9rem;
        position: relative;
        z-index: 1;
    }

    .login-link {
        color: rgba(255, 255, 255, 0.8);
        font-size: 0.95rem;
        margin: 0;
    }

    .glass-link {
        color: var(--white);
        text-decoration: none;
        font-weight: 600;
        background: var(--gradient-secondary);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        transition: all 0.3s ease;
    }

    .glass-link:hover {
        color: var(--white);
        -webkit-text-fill-color: var(--white);
        text-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
    }

    /* Info Cards */
    .info-card {
        padding: 2rem;
        text-align: center;
        transition: all 0.3s ease;
        height: 100%;
    }

    .info-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--glass-shadow-hover);
    }

    .tenant-card:hover {
        background: rgba(79, 172, 254, 0.1);
    }

    .owner-card:hover {
        background: rgba(17, 153, 142, 0.1);
    }

    .info-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        font-size: 1.5rem;
        color: var(--white);
    }

    .info-icon.tenant {
        background: var(--gradient-secondary);
    }

    .info-icon.owner {
        background: var(--gradient-success);
    }

    .info-title {
        font-family: 'Poppins', sans-serif;
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--white);
        margin-bottom: 1rem;
    }

    .info-list {
        list-style: none;
        padding: 0;
        margin: 0;
        text-align: left;
    }

    .info-list li {
        color: rgba(255, 255, 255, 0.8);
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
    }

    .info-list i {
        color: #34d399;
        font-size: 0.8rem;
        flex-shrink: 0;
    }

    /* Loading State */
    .btn-loading {
        opacity: 0.8;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .register-card {
            padding: 2rem;
        }

        .register-title {
            font-size: 2rem;
        }

        .register-subtitle {
            font-size: 1rem;
        }

        .header-icon {
            width: 60px;
            height: 60px;
            font-size: 1.5rem;
        }

        .glass-input,
        .glass-select {
            padding: 0.875rem 0.875rem 0.875rem 2.75rem;
        }

        .input-icon,
        .select-icon {
            left: 0.875rem;
        }

        .select-icon {
            right: 0.875rem;
            left: auto;
        }

        .password-toggle {
            right: 0.875rem;
        }

        .info-card {
            padding: 1.5rem;
            margin-bottom: 1rem;
        }
    }

    @media (max-width: 576px) {
        .register-card {
            padding: 1.5rem;
            margin: 1rem;
        }

        .glassmorphism-register .container {
            padding-left: 0;
            padding-right: 0;
        }

        .register-title {
            font-size: 1.75rem;
        }

        .info-list {
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
    .glass-select:focus,
    .glass-btn:focus,
    .password-toggle:focus {
        outline: 2px solid rgba(255, 255, 255, 0.5);
        outline-offset: 2px;
    }

    /* Form validation states */
    .glass-input:valid {
        border-color: rgba(52, 211, 153, 0.5);
    }

    .glass-input:invalid:not(:placeholder-shown) {
        border-color: rgba(248, 113, 113, 0.5);
    }

    /* Custom scrollbar for select */
    .glass-select::-webkit-scrollbar {
        width: 8px;
    }

    .glass-select::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.1);
    }

    .glass-select::-webkit-scrollbar-thumb {
        background: var(--gradient-primary);
        border-radius: 4px;
    }
</style>
@endpush

@push('scripts')
<script>
    // Password toggle functionality
    function togglePassword(inputId) {
        const input = document.getElementById(inputId);
        const eye = document.getElementById(inputId + '-eye');
        
        if (input.type === 'password') {
            input.type = 'text';
            eye.classList.remove('fa-eye');
            eye.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            eye.classList.remove('fa-eye-slash');
            eye.classList.add('fa-eye');
        }
    }

    // Form submission loading state
    document.querySelector('.register-form').addEventListener('submit', function(e) {
        const submitBtn = this.querySelector('.register-btn');
        const btnText = submitBtn.querySelector('.btn-text');
        const btnLoading = submitBtn.querySelector('.btn-loading');
        
        btnText.style.display = 'none';
        btnLoading.style.display = 'inline-flex';
        submitBtn.disabled = true;
    });

    // Real-time form validation feedback
    document.querySelectorAll('.glass-input').forEach(input => {
        input.addEventListener('input', function() {
            if (this.checkValidity()) {
                this.classList.remove('is-invalid');
                this.classList.add('is-valid');
            } else {
                this.classList.remove('is-valid');
                if (this.value.length > 0) {
                    this.classList.add('is-invalid');
                }
            }
        });
    });

    // Password strength indicator
    document.getElementById('password').addEventListener('input', function() {
        const password = this.value;
        const strength = calculatePasswordStrength(password);
        // You can add visual strength indicator here
    });

    function calculatePasswordStrength(password) {
        let strength = 0;
        if (password.length >= 8) strength++;
        if (/[a-z]/.test(password)) strength++;
        if (/[A-Z]/.test(password)) strength++;
        if (/[0-9]/.test(password)) strength++;
        if (/[^A-Za-z0-9]/.test(password)) strength++;
        return strength;
    }

    // Phone number formatting
    document.getElementById('phone').addEventListener('input', function() {
        let value = this.value.replace(/\D/g, '');
        if (value.startsWith('62')) {
            value = '0' + value.substring(2);
        }
        this.value = value;
    });

    // Smooth scroll to error
    if (document.querySelector('.glass-error')) {
        document.querySelector('.glass-error').scrollIntoView({
            behavior: 'smooth',
            block: 'center'
        });
    }
</script>
@endpush
@endsection