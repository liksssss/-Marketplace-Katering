<!DOCTYPE html>
<html>
<head>
    <title>Marketplace Katering</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light px-4">
        <a class="navbar-brand" href="/">Katering</a>
        @auth
            <div class="ms-auto">
                <span class="me-3">Hi, {{ Auth::user()->name }}</span>
                <a href="{{ route('logout') }}" class="btn btn-outline-danger btn-sm">Logout</a>
            </div>
        @endauth
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>
</body>
</html>
