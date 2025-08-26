<!-- resources/views/layouts/navbar.blade.php -->

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">JobBoard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                @else
                    @if(auth()->user()->hasRole('Admin'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
                        </li>
                    @elseif(auth()->user()->hasRole('Employer'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('jobs.create') }}">Post Job</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('jobs.index') }}">My Jobs</a>
                        </li>
                    @elseif(auth()->user()->hasRole('Candidate'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('jobs.index') }}">Browse Jobs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('applications.index') }}">My Applications</a>
                        </li>
                    @endif

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
