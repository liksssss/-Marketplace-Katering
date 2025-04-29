<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marketplace Katering</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
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

    <!-- Main Content -->
    <main class="flex-grow-1 pt-5 mt-4">
        <div class="container py-4">
            <form action="{{ route('search') }}" method="GET" class="d-flex">
                <input type="text" name="query" class="form-control me-2" placeholder="Cari menu katering..." required>
                <button type="submit" class="btn btn-primary">Cari</button>
            </form>
            
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-primary text-light mt-auto">
        <div class="container py-4 d-flex flex-column flex-md-row justify-content-between align-items-center">
            <div class="mb-3 mb-md-0 text-center text-md-start">
                <p class="mb-0">&copy; {{ date('Y') }} <a href="/" class="text-light text-decoration-none fw-bold">Marketplace Katering</a></p>
            </div>
            <div class="d-flex gap-3 justify-content-center">
                <a href="#" class="text-light fs-5" title="Facebook">
                    <i class="bi bi-facebook"></i>
                </a>
                <a href="#" class="text-light fs-5" title="Twitter">
                    <i class="bi bi-twitter-x"></i>
                </a>
                <a href="#" class="text-light fs-5" title="Instagram">
                    <i class="bi bi-instagram"></i>
                </a>
            </div>
        </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
