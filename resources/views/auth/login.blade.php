@extends('layouts.app')

@section('title', 'Masuk - Kos Finder')

@section('content')
<div class="container-fluid glassmorphism-login">
    <div class="container py-5">
        <div class="row justify-content-center align-items-center min-vh-80">
            <div class="col-md-6 col-lg-5 col-xl-4">
                <div class="glass-card login-card">
                    <!-- Header Section -->
                    <div class="login-header text-center mb-4">
                        <div class="header-icon">
                            <i class="fas fa-sign-in-alt"></i>
                        </div>
                        <h2 class="login-title">Selamat Datang</h2>
                        <p class="login-subtitle">Masuk ke akun Anda</p>
                    </div>

                    <!-- Login Form -->
                    <form method="POST" action="{{ route('login') }}" class="login-form">
                        @csrf

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
                                       required
                                       autofocus>
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
                                       placeholder="Masukkan kata sandi"
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

                        <!-- Remember Me -->
                        <div class="form-group">
                            <div class="glass-checkbox-wrapper">
                                <input type="checkbox" class="glass-checkbox" id="remember" name="remember">
                                <label class="glass-checkbox-label" for="remember">
                                    <span class="checkbox-custom">
                                        <i class="fas fa-check checkbox-icon"></i>
                                    </span>
                                    Ingat saya
                                </label>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group">
                            <button type="submit" class="glass-btn glass-btn-primary login-btn">
                                <i class="fas fa-sign-in-alt me-2"></i>
                                <span class="btn-text">Masuk</span>
                                <span class="btn-loading" style="display: none;">
                                    <i class="fas fa-spinner fa-spin me-2"></i>Memproses...
                                </span>
                            </button>
                        </div>
                    </form>

                    <!-- Register Link -->
                    <div class="login-footer text-center">
                        <div class="footer-divider">
                            <span>atau</span>
                        </div>
                        <p class="register-link">
                            Belum punya akun?
                            <a href="{{ route('register') }}" class="glass-link">
                                Daftar di sini
                            </a>
                        </p>
                    </div>
                </div>

                <!-- Quick Access Cards -->
                <div class="row g-3 mt-4">
                    <div class="col-6">
                        <div class="glass-card quick-card tenant-quick">
                            <div class="quick-icon">
                                <i class="fas fa-search"></i>
                            </div>
                            <h6 class="quick-title">Cari Kos</h6>
                            <p class="quick-text">Temukan kontrakan impian Anda</p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="glass-card quick-card owner-quick">
                            <div class="quick-icon">
                                <i class="fas fa-plus-circle"></i>
                            </div>
                            <h6 class="quick-title">Iklankan</h6>
                            <p class="quick-text">Pasang iklan kontrakan gratis</p>
                        </div>
                    </div>
                </div>

                <!-- Features Preview -->
                <div class="glass-card features-preview mt-4">
                    <h6 class="features-title">
                        <i class="fas fa-star me-2"></i>Mengapa Rent House?
                    </h6>
                    <div class="features-list">
                        <div class="feature-item">
                            <i class="fas fa-shield-check feature-icon"></i>
                            <span>Kos terverifikasi</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-comments feature-icon"></i>
                            <span>Kontak langsung</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-heart feature-icon"></i>
                            <span>Mudah & gratis</span>
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

    .glassmorphism-login {
        background: var(--gradient-background);
        min-height: 100vh;
        position: relative;
        overflow-x: hidden;
    }

    .glassmorphism-login::before {
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

    .min-vh-80 {
        min-height: 80vh;
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

    /* Login Card */
    .login-card {
        padding: 3rem;
    }

    .login-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--glass-shadow-hover);
        background: var(--glass-bg-light);
    }

    /* Header */
    .login-header {
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
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% {
            transform: translateY(0px);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
        }
        50% {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(102, 126, 234, 0.6);
        }
    }

    .login-title {
        font-family: 'Poppins', sans-serif;
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--white);
        margin-bottom: 0.5rem;
    }

    .login-subtitle {
        font-size: 1.1rem;
        color: rgba(255, 255, 255, 0.8);
        margin: 0;
    }

    /* Form Styles */
    .login-form {
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
        border-color: rgba(220, 38, 38, 0.8);
        box-shadow: 0 0 15px rgba(220, 38, 38, 0.3);
    }

    /* Input Icons */
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

    /* Custom Checkbox */
    .glass-checkbox-wrapper {
        display: flex;
        align-items: center;
        margin-top: 0.5rem;
    }

    .glass-checkbox {
        display: none;
    }

    .glass-checkbox-label {
        display: flex;
        align-items: center;
        cursor: pointer;
        color: rgba(255, 255, 255, 0.9);
        font-size: 0.95rem;
        font-weight: 500;
        user-select: none;
    }

    .checkbox-custom {
        width: 20px;
        height: 20px;
        background: var(--glass-bg);
        border: 1px solid var(--glass-border);
        border-radius: 6px;
        margin-right: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        position: relative;
    }

    .checkbox-icon {
        color: var(--white);
        font-size: 0.75rem;
        opacity: 0;
        transform: scale(0);
        transition: all 0.3s ease;
    }

    .glass-checkbox:checked + .glass-checkbox-label .checkbox-custom {
        background: var(--gradient-primary);
        border-color: transparent;
        transform: scale(1.1);
    }

    .glass-checkbox:checked + .glass-checkbox-label .checkbox-icon {
        opacity: 1;
        transform: scale(1);
    }

    .glass-checkbox-label:hover .checkbox-custom {
        border-color: rgba(255, 255, 255, 0.5);
        background: var(--glass-bg-light);
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

    .login-btn {
        padding: 1.25rem 2rem;
        font-size: 1.1rem;
        font-weight: 700;
        margin-top: 1rem;
    }

    /* Footer */
    .login-footer {
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

    .register-link {
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

    /* Quick Cards */
    .quick-card {
        padding: 1.5rem;
        text-align: center;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .quick-card:hover {
        transform: translateY(-5px) scale(1.02);
        box-shadow: var(--glass-shadow-hover);
    }

    .tenant-quick:hover {
        background: rgba(79, 172, 254, 0.1);
    }

    .owner-quick:hover {
        background: rgba(17, 153, 142, 0.1);
    }

    .quick-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        font-size: 1.2rem;
        color: var(--white);
    }

    .tenant-quick .quick-icon {
        background: var(--gradient-secondary);
    }

    .owner-quick .quick-icon {
        background: var(--gradient-success);
    }

    .quick-title {
        font-family: 'Poppins', sans-serif;
        font-size: 1rem;
        font-weight: 700;
        color: var(--white);
        margin-bottom: 0.5rem;
    }

    .quick-text {
        color: rgba(255, 255, 255, 0.8);
        font-size: 0.8rem;
        margin: 0;
        line-height: 1.3;
    }

    /* Features Preview */
    .features-preview {
        padding: 2rem;
        text-align: center;
    }

    .features-title {
        font-family: 'Poppins', sans-serif;
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--white);
        margin-bottom: 1.5rem;
    }

    .features-list {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .feature-item {
        display: flex;
        align-items: center;
        justify-content: center;
        color: rgba(255, 255, 255, 0.9);
        font-size: 0.9rem;
        font-weight: 500;
        padding: 0.75rem;
        background: var(--glass-bg);
        border: 1px solid var(--glass-border);
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    .feature-item:hover {
        background: var(--glass-bg-light);
        transform: translateX(5px);
    }

    .feature-icon {
        color: #34d399;
        margin-right: 0.75rem;
        font-size: 0.9rem;
        flex-shrink: 0;
    }

    /* Loading State */
    .btn-loading {
        opacity: 0.8;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .login-card {
            padding: 2rem;
            margin: 1rem;
        }

        .login-title {
            font-size: 2rem;
        }

        .login-subtitle {
            font-size: 1rem;
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

        .password-toggle {
            right: 0.875rem;
        }

        .quick-card,
        .features-preview {
            padding: 1.5rem;
        }

        .features-list {
            gap: 0.75rem;
        }
    }

    @media (max-width: 576px) {
        .glassmorphism-login .container {
            padding-left: 0;
            padding-right: 0;
        }

        .login-card {
            padding: 1.5rem;
            margin: 0.5rem;
        }

        .login-title {
            font-size: 1.75rem;
        }

        .quick-card {
            padding: 1rem;
        }

        .quick-icon {
            width: 40px;
            height: 40px;
            font-size: 1rem;
        }

        .quick-title {
            font-size: 0.9rem;
        }

        .quick-text {
            font-size: 0.75rem;
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
    .glass-btn:focus,
    .password-toggle:focus,
    .glass-checkbox-label:focus-within {
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
    document.querySelector('.login-form').addEventListener('submit', function(e) {
        const submitBtn = this.querySelector('.login-btn');
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

        // Add focus effects
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });

        input.addEventListener('blur', function() {
            this.parentElement.classList.remove('focused');
        });
    });

    // Smooth scroll to error
    if (document.querySelector('.glass-error')) {
        document.querySelector('.glass-error').scrollIntoView({
            behavior: 'smooth',
            block: 'center'
        });
    }

    // Add click handlers for quick cards
    document.querySelectorAll('.quick-card').forEach(card => {
        card.addEventListener('click', function() {
            if (this.classList.contains('tenant-quick')) {
                // Redirect to search page after login
                sessionStorage.setItem('redirectAfterLogin', '/search');
            } else if (this.classList.contains('owner-quick')) {
                // Redirect to add kos page after login
                sessionStorage.setItem('redirectAfterLogin', '/pemilik/kos/create');
            }
        });
    });

    // Handle redirect after successful login
    window.addEventListener('load', function() {
        const redirectPath = sessionStorage.getItem('redirectAfterLogin');
        if (redirectPath) {
            sessionStorage.removeItem('redirectAfterLogin');
            // This would be handled by the backend after successful login
        }
    });

    // Auto-focus email field on page load
    window.addEventListener('load', function() {
        const emailInput = document.getElementById('email');
        if (emailInput && !emailInput.value) {
            setTimeout(() => {
                emailInput.focus();
            }, 500);
        }
    });

    // Enhanced keyboard navigation
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && e.target.classList.contains('glass-input')) {
            const form = e.target.closest('form');
            const inputs = form.querySelectorAll('.glass-input');
            const currentIndex = Array.from(inputs).indexOf(e.target);

            if (currentIndex < inputs.length - 1) {
                e.preventDefault();
                inputs[currentIndex + 1].focus();
            }
        }
    });
</script>
@endpush
@endsection
