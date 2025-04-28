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
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/dashboard">🍽️ Katering</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                @auth
                    <ul class="navbar-nav ms-auto align-items-center">
                        <li class="nav-item me-3">
                            <span class="nav-link">👋 Hi, {{ Auth::user()->name }}</span>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('logout') }}" class="btn btn-outline-danger btn-sm">Logout</a>
                        </li>
                    </ul>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow-1">
        <div class="container py-4">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-light text-center text-muted py-3 mt-auto shadow-sm">
        <div class="container">
            <small>© {{ date('Y') }} Marketplace Katering. All rights reserved.</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
