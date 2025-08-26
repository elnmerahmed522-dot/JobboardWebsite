<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'JobBoard') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body class="d-flex flex-column min-vh-100">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">JobBoard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @guest
                        <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Login</a></li>
                        <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Register</a></li>
                    @else
                        @role('candidate')
                            <li class="nav-item"><a href="{{ route('candidate.dashboard') }}" class="nav-link">Dashboard</a></li>
                        @endrole
                        @role('employer')
                            <li class="nav-item"><a href="{{ route('employer.dashboard') }}" class="nav-link">Dashboard</a></li>
                        @endrole
                        @role('admin')
                            <li class="nav-item"><a href="{{ route('admin.dashboard') }}" class="nav-link">Admin</a></li>
                        @endrole
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userMenu" data-bs-toggle="dropdown">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button class="dropdown-item">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow-1 py-4">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container">
            <div class="row">
                <!-- About -->
                <div class="col-md-4 mb-3">
                    <h5 class="fw-bold">JobBoard</h5>
                    <p class="text-muted">Connecting talented people with top companies. Start your career journey today.</p>
                </div>

                <!-- Quick Links -->
                <div class="col-md-4 mb-3">
                    <h5 class="fw-bold">Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('home') }}" class="text-white text-decoration-none">Home</a></li>
                        <li><a href="{{ route('jobs.index') }}" class="text-white text-decoration-none">Jobs</a></li>
                       
                        @role('admin')
                            <li><a href="{{ route('admin.companies.index') }}" class="text-white text-decoration-none">Companies</a></li>
                        @endrole

                    </ul>
                </div>

                <!-- Social Media -->
                <div class="col-md-4 mb-3">
                    <h5 class="fw-bold">Follow Us</h5>
                    <a href="#" class="text-white me-3"><i class="bi bi-facebook fs-4"></i></a>
                    <a href="#" class="text-white me-3"><i class="bi bi-twitter fs-4"></i></a>
                    <a href="#" class="text-white me-3"><i class="bi bi-linkedin fs-4"></i></a>
                    <a href="#" class="text-white"><i class="bi bi-instagram fs-4"></i></a>
                </div>
            </div>

            <div class="text-center mt-3 border-top pt-3">
                <p class="mb-0 text-muted">&copy; {{ date('Y') }} JobBoard. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
