<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marketplace Katering</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        /* Styling for modern footer */
        .footer {
            background-color: #007bff; /* Primary color */
            color: #ffffff;
            padding: 40px 0;
        }

        .footer .footer-logo a {
            color: #ffffff;
            font-size: 1.5rem;
            text-decoration: none;
            font-weight: bold;
        }

        .footer .social-icons a {
            color: #ffffff;
            font-size: 1.5rem;
            margin: 0 10px;
            transition: color 0.3s;
        }

        .footer .social-icons a:hover {
            color: #f8f9fa;
        }

        .footer .footer-links a {
            color: #ffffff;
            text-decoration: none;
            margin-bottom: 10px;
            display: block;
            transition: color 0.3s;
        }

        .footer .footer-links a:hover {
            color: #f8f9fa;
        }

        .footer .footer-bottom {
            text-align: center;
            font-size: 0.9rem;
            margin-top: 20px;
        }

        .footer .divider {
            border-top: 1px solid #f8f9fa;
            margin: 20px 0;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center fw-bold text-primary" href="/dashboard">
                <i class="bi bi-basket-fill me-2"></i> 🍽️ Katering
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="bi bi-list fs-1 text-primary"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-2">
                    @auth
                        <li class="nav-item">
                            <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary rounded-pill">
                                <i class="bi bi-person-circle me-1"></i> Profil
                            </a>
                        </li>
                        <li class="nav-item">
                            <span class="nav-link text-primary fw-semibold">
                                👋 Hi, {{ Auth::user()->name }}
                            </span>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('logout') }}" class="btn btn-outline-danger rounded-pill" 
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right me-1"></i> Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    @endauth

                    @guest
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="btn btn-primary rounded-pill">
                                <i class="bi bi-box-arrow-in-right me-1"></i> Login
                            </a>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="flex-grow-1 pt-5 mt-4">
        <div class="container py-4">
            <div class="row justify-content-center mb-4">
                @if (Route::currentRouteName() === 'dashboard')
                <div class="col-md-8">
                    <form action="{{ route('search') }}" method="GET" class="d-flex bg-white p-3 rounded shadow-sm">
                        <input type="text" name="query" class="form-control me-2" placeholder="Cari menu katering..." required>
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </form>
                </div>
                @endif
            </div>
    
            @yield('content')
        </div>
    </main>
    

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 text-center text-md-start mb-4 mb-md-0">
                    <div class="footer-logo">
                        <a href="/">🍽️ Katering</a>
                    </div>
                    <p class="mt-3">Menyediakan layanan katering terbaik untuk Anda.</p>
                </div>
                <div class="col-md-4 text-center">
                    <div class="footer-links">
                        <a href="#">Tentang Kami</a>
                        <a href="#">Layanan</a>
                        <a href="#">Kontak</a>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="social-icons">
                        <a href="#" title="Facebook">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="#" title="Twitter">
                            <i class="bi bi-twitter-x"></i>
                        </a>
                        <a href="#" title="Instagram">
                            <i class="bi bi-instagram"></i>
                        </a>
                        <a href="mailto:info@example.com" title="Email">
                            <i class="bi bi-envelope"></i>
                        </a>
                        <a href="https://www.google.com/maps/place/Example+Address" title="Lokasi">
                            <i class="bi bi-geo-alt"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="divider"></div>

            <div class="footer-bottom">
                <p class="mb-0">&copy; {{ date('Y') }} <a href="/" class="text-light text-decoration-none fw-bold">Marketplace Katering</a>. Semua hak dilindungi.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
