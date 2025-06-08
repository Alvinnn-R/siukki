<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang - SiUKKI</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Aref+Ruqaa:wght@400;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --primary-green: #2E8B57;
            --secondary-green: #3CB371;
            --accent-gold: #FFD700;
            --dark-green: #1F5F3F;
            --light-green: #E8F5E8;
            --text-dark: #2C3E50;
            --text-light: #6C757D;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #e2f0d9;
            min-height: 100vh;
            overflow-x: hidden;
            /* Remove the padding-top from here since it's duplicated */
        }

        /* Islamic Pattern Background */
        .islamic-pattern {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0.1;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.4'%3E%3Cpath d='M30 0l30 30-30 30L0 30 30 0z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            z-index: -1;
        }

        /* Welcome Container */
        .welcome-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 100px 20px 20px;
            /* Add top padding for navbar */
            position: relative;
        }

        .welcome-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            max-width: 1200px;
            width: 100%;
            animation: slideUp 1s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Header Section */
        .welcome-header {
            background: #91c47b;
            color: white;
            text-align: center;
            padding: 60px 40px 40px;
            position: relative;
        }

        .welcome-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
        }

        .logo-container {
            margin-bottom: 20px;
            position: relative;
            z-index: 2;
        }

        .main-logo {
            width: 120px;
            height: 120px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
        }

        .main-logo img {
            width: 80px;
            height: 80px;
            object-fit: contain;
        }

        .app-title {
            font-family: 'Aref Ruqaa', serif;
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            position: relative;
            z-index: 2;
        }

        .app-subtitle {
            font-size: 1.3rem;
            opacity: 0.9;
            margin-bottom: 30px;
            position: relative;
            z-index: 2;
        }

        .bismillah {
            font-family: 'Aref Ruqaa', serif;
            font-size: 1.8rem;
            color: var(--accent-gold);
            margin-bottom: 20px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
            position: relative;
            z-index: 2;
        }

        /* Content Section */
        .welcome-content {
            padding: 60px 40px;
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin: 40px 0;
        }

        .feature-card {
            background: var(--light-green);
            padding: 30px;
            border-radius: 16px;
            text-align: center;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(46, 139, 87, 0.2);
            border-color: var(--secondary-green);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary-green), var(--secondary-green));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 2rem;
            color: white;
        }

        .feature-title {
            font-size: 1.4rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 15px;
        }

        .feature-desc {
            color: var(--text-light);
            line-height: 1.6;
        }

        /* Stats Section */
        .stats-section {
            background: #91c47b;
            padding: 50px 40px;
            margin: 40px -40px;
            color: white;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 30px;
            text-align: center;
        }

        .stat-item {
            padding: 20px;
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 700;
            color: var(--accent-gold);
            display: block;
        }

        .stat-label {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-top: 10px;
        }

        /* CTA Section */
        .cta-section {
            text-align: center;
            margin-top: 50px;
        }

        .cta-title {
            font-size: 2.5rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 20px;
        }

        .cta-desc {
            font-size: 1.2rem;
            color: var(--text-light);
            margin-bottom: 40px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .btn-get-started {
            display: inline-block;
            background: linear-gradient(135deg, var(--primary-green), var(--secondary-green));
            color: white;
            padding: 18px 40px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(46, 139, 87, 0.3);
        }

        .btn-get-started:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(46, 139, 87, 0.4);
            color: white;
        }

        /* University Info */
        .university-info {
            background: #e8f5e8;
            padding: 40px;
            margin: 40px -40px 0;
            text-align: center;
        }

        .university-logo {
            width: 100px;
            height: 100px;
            margin: 0 auto 20px;
        }

        .university-name {
            font-size: 1.4rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 10px;
        }

        .university-address {
            color: var(--text-light);
            font-size: 1rem;
        }

        /* Navigation Bar */
        .navbar {
            background: #91c47b;
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            z-index: 1000;
        }

        .navbar.scrolled {
            background: rgb(0, 0, 0);
            box-shadow: 0 2px 30px rgba(0, 0, 0, 0.2);
        }

        .navbar-brand {
            font-weight: 700;
            color: white !important;
            font-size: 1.5rem;
            text-decoration: none;
        }

        .brand-logo {
            width: 40px;
            height: 40px;
            background: var(--accent-gold);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: var(--primary-green);
        }

        .brand-text {
            font-family: 'Aref Ruqaa', serif;
        }

        .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            padding: 8px 16px !important;
            border-radius: 8px;
            transition: all 0.3s ease;
            margin: 0 4px;
        }

        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            color: white !important;
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
        }

        .auth-buttons {
            gap: 12px;
        }

        .btn-login {
            border: 2px solid rgba(255, 255, 255, 0.8);
            color: white !important;
            font-weight: 500;
            padding: 8px 20px;
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background: #2e8a57;
            border-color: #2e8a57;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .btn-register {
            background: var(--accent-gold);
            color: #2e8a57;
            font-weight: 600;
            padding: 8px 20px;
            border-radius: 25px;
            border: 2px solid var(--accent-gold);
            transition: all 0.3s ease;
        }

        .btn-register:hover {
            background: white;
            color: var(--primary-green) !important;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .navbar-toggler {
            border: none;
            padding: 4px 8px;
        }

        .navbar-toggler:focus {
            box-shadow: none;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 0.8%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        /* Modal Styles */
        .modal-content {
            border-radius: 16px;
            border: none;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        }

        .modal-header {
            background: linear-gradient(135deg, var(--primary-green), var(--secondary-green));
            color: white;
            border-radius: 16px 16px 0 0;
            border-bottom: none;
        }

        .modal-title {
            font-weight: 600;
        }

        .btn-close {
            filter: brightness(0) invert(1);
        }

        .form-control {
            border-radius: 12px;
            border: 2px solid #e9ecef;
            padding: 12px 16px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--secondary-green);
            box-shadow: 0 0 0 0.2rem rgba(46, 139, 87, 0.25);
        }

        .btn-modal-primary {
            background: linear-gradient(135deg, var(--primary-green), var(--secondary-green));
            border: none;
            border-radius: 12px;
            padding: 12px 24px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-modal-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(46, 139, 87, 0.3);
        }

        .floating {
            animation: floating 3s ease-in-out infinite;
        }

        @keyframes floating {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .welcome-card {
                margin: 10px;
                border-radius: 16px;
            }

            .welcome-header {
                padding: 40px 20px 30px;
            }

            .app-title {
                font-size: 2.5rem;
            }

            .app-subtitle {
                font-size: 1.1rem;
            }

            .bismillah {
                font-size: 1.4rem;
            }

            .welcome-content {
                padding: 40px 20px;
            }

            .feature-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .stats-section {
                margin: 30px -20px;
                padding: 40px 20px;
            }

            .cta-title {
                font-size: 2rem;
            }

            .university-info {
                margin: 30px -20px 0;
                padding: 30px 20px;
            }

            .welcome-container {
                padding: 80px 20px 20px;
            }
        }
    </style>
</head>

<body>
    <div class="islamic-pattern"></div>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid px-4">
            <!-- Logo dan Brand -->
            <a class="navbar-brand d-flex align-items-center" href="#">
                <div class="me-3">
                    <img src="{{ asset('assets/images/Logo UKKI.png') }}" alt="Logo" style="height: 50px;">
                </div>
                <span class="brand-text">SiUKKI</span>
            </a>

            <!-- Toggle button untuk mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Auth Buttons -->
            <div class="auth-buttons d-flex align-items-center gap-2">
                <button class="btn btn-outline-light btn-login" onclick="location.href='{{ route('login') }}'">
                    <i class="fas fa-sign-in-alt me-2"></i>
                    Login
                </button>
                <button class="btn btn-light btn-register"
                    onclick="window.open('https://docs.google.com/forms/d/e/1FAIpQLSf7GU8-Kor1OPE0Ji6duCdPIWM0sGqNnnVTE3Hz1K9CNb7uZg/viewform?usp=sharing', '_blank')">
                    <i class="fas fa-user-plus me-2"></i>
                    Register
                </button>
            </div>
        </div>
    </nav>

    <div class="welcome-container">
        <div class="welcome-card">
            <!-- Header Section -->
            <div class="welcome-header">
                <div class="bismillah">بِسْمِ اللَّهِ الرَّحْمَنِ الرَّحِيم</div>

                <div class="logo-container">
                    <div class="main-logo">
                        <img src="{{ asset('assets/images/Logo UKKI.png') }}" alt="Logo"
                            style="width: 100px; height: 100px; border-radius: 50%;">
                    </div>
                </div>

                <h1 class="app-title">SiUKKI</h1>
                <p class="app-subtitle">Sistem Informasi Unit Kegiatan Kerohanian Islam</p>

                <div class="d-flex justify-content-center align-items-center gap-3 mt-4">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-university me-2"></i>
                        <span>UPN "Veteran" Jawa Timur</span>
                    </div>
                </div>
            </div>

            <!-- Content Section -->
            <div class="welcome-content">
                <div class="text-center mb-5">
                    <h2 class="display-5 fw-bold text-dark mb-3">Selamat Datang di Era Baru</h2>
                    <p class="lead text-muted">Aplikasi gamifikasi untuk meningkatkan keterlibatan Anda dalam kegiatan
                        UKKI melalui sistem poin, XP, dan pencapaian yang menarik!</p>
                </div>

                <!-- Features Grid -->
                <div class="feature-grid">
                    <div class="feature-card">
                        <div class="feature-icon floating">
                            <i class="fas fa-tasks"></i>
                        </div>
                        <h3 class="feature-title">Misi & Tantangan</h3>
                        <p class="feature-desc">Ikuti berbagai misi menarik seperti membaca Al-Qur'an, sholat berjamaah,
                            dan menghadiri kajian untuk mendapatkan XP.</p>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon floating" style="animation-delay: 1s;">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h3 class="feature-title">Leaderboard</h3>
                        <p class="feature-desc">Pemeringkatan untuk mendorong kompetisi sehat dan keterlibatan yang
                            lebih tinggi antar anggota.</p>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon floating" style="animation-delay: 1.5s;">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <h3 class="feature-title">Kalender Event</h3>
                        <p class="feature-desc">Pantau jadwal kegiatan UKKI dan jangan lewatkan kesempatan untuk
                            mengumpulkan poin!</p>
                    </div>
                </div>

                <!-- Stats Section -->
                <div class="stats-section">
                    <h3 class="text-center mb-4 fs-2 fw-bold">Pencapaian UKKI</h3>
                    <div class="stats-grid">
                        <div class="stat-item">
                            <span class="stat-number">200+</span>
                            <div class="stat-label">Anggota Aktif</div>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">50+</span>
                            <div class="stat-label">Event per Tahun</div>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">10+</span>
                            <div class="stat-label">Program Unggulan</div>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">15+</span>
                            <div class="stat-label">Tahun Pengabdian</div>
                        </div>
                    </div>
                </div>

                <!-- CTA Section -->
                <div class="cta-section">
                    <h2 class="cta-title">Siap Memulai Perjalanan?</h2>
                    <p class="cta-desc">Bergabunglah dengan ribuan mahasiswa lainnya dalam meningkatkan spiritualitas
                        dan keterlibatan dalam kegiatan islami kampus.</p>
                    <a href="#" class="btn-get-started">
                        <i class="fas fa-rocket me-2"></i>
                        Mulai Sekarang
                    </a>
                </div>

                <!-- University Info -->
                <div class="university-info">
                    <div class="university-logo">
                        <i class="fas fa-university" style="font-size: 4rem; color: var(--primary-green);"></i>
                    </div>
                    <h4 class="university-name">Universitas Pembangunan Nasional "Veteran" Jawa Timur</h4>
                    <p class="university-address">Jl. Raya Rungkut Madya, Gunung Anyar, Surabaya, Jawa Timur</p>
                    <div class="mt-3">
                        <span class="badge bg-success fs-6 px-3 py-2">
                            <i class="fas fa-heart me-1"></i>
                            Ahlan wa Sahlan
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Force scroll to top on page load/refresh
        window.addEventListener('beforeunload', function () {
            window.scrollTo(0, 0);
        });

        window.addEventListener('load', function () {
            // Force scroll to top immediately
            setTimeout(function () {
                window.scrollTo(0, 0);
                document.documentElement.scrollTop = 0;
                document.body.scrollTop = 0;
            }, 0);
        });

        // Additional fallback for page refresh
        if (window.performance && window.performance.navigation.type === window.performance.navigation.TYPE_RELOAD) {
            window.scrollTo(0, 0);
        }

        // Prevent scroll restoration
        if (history.scrollRestoration) {
            history.scrollRestoration = 'manual';
        }

        // Add smooth scrolling and entrance animations
        document.addEventListener('DOMContentLoaded', function () {
            // Ensure page starts at top
            window.scrollTo(0, 0);

            // Animate feature cards on scroll
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver(function (entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            // Observe feature cards
            document.querySelectorAll('.feature-card').forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                card.style.transition = 'all 0.6s ease';
                observer.observe(card);
            });

            // Add click effects
            document.querySelectorAll('.feature-card').forEach(card => {
                card.addEventListener('click', function () {
                    this.style.transform = 'scale(0.95)';
                    setTimeout(() => {
                        this.style.transform = 'translateY(-10px) scale(1)';
                    }, 150);
                });
            });

            // Smooth scroll for CTA button
            document.querySelector('.btn-get-started').addEventListener('click', function (e) {
                e.preventDefault();

                // Add loading state
                const originalText = this.innerHTML;
                this.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memuat...';

                setTimeout(() => {
                    // Replace with actual navigation
                    alert('Fitur ini akan segera tersedia!');
                    this.innerHTML = originalText;
                }, 1500);
            });
        });

        // Add typing effect for title
        function typeWriter(element, text, speed = 100) {
            let i = 0;
            element.innerHTML = '';

            function type() {
                if (i < text.length) {
                    element.innerHTML += text.charAt(i);
                    i++;
                    setTimeout(type, speed);
                }
            }

            type();
        }

        // Counter animation for stats
        function animateCounter(element, target, duration = 2000) {
            let start = 0;
            const increment = target / (duration / 16);

            function updateCounter() {
                start += increment;
                if (start < target) {
                    element.textContent = Math.floor(start) + '+';
                    requestAnimationFrame(updateCounter);
                } else {
                    element.textContent = target + '+';
                }
            }

            updateCounter();
        }

        // Animate counters when they come into view
        const counterObserver = new IntersectionObserver(function (entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const target = parseInt(entry.target.textContent);
                    animateCounter(entry.target, target);
                }
            });
        });

        document.querySelectorAll('.stat-number').forEach(counter => {
            counterObserver.observe(counter);
        });

        // Navbar scroll effect
        window.addEventListener('scroll', function () {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>
</body>

</html>