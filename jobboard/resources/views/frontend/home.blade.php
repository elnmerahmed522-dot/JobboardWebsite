@extends('layouts.app')

@section('content')
<div class="container-fluid bg-light py-5">
    <div class="container text-center">
        <h1 class="fw-bold mb-3">Find Your Dream Job Today 🚀</h1>
        <p class="text-muted mb-4">Thousands of companies are hiring. Start your career journey now.</p>
        
        <!-- Search Bar -->
        <form action="{{ route('jobs.index') }}" method="GET" class="d-flex justify-content-center mb-4">
            <input type="text" name="q" class="form-control w-50 me-2" placeholder="Search for jobs or companies">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>

        <!-- CTA Buttons -->
        <a href="{{ route('jobs.index') }}" class="btn btn-outline-primary btn-lg me-2">Browse Jobs</a>
        @if(auth()->check() && auth()->user()->hasRole('employer'))
            <a href="{{ route('employer.dashboard') }}" class="btn btn-success btn-lg">Post a Job</a>
        @endif
    </div>
</div>

<!-- Highlights -->
<div class="container my-5 text-center">
    <div class="row">
        <div class="col-md-3">
            <i class="bi bi-building text-primary display-6"></i>
            <h2 class="fw-bold">{{ \App\Models\Company::count() }}</h2>
            <p class="text-muted">Companies</p>
        </div>
        <div class="col-md-3">
            <i class="bi bi-briefcase text-success display-6"></i>
            <h2 class="fw-bold">{{ \App\Models\Job::count() }}</h2>
            <p class="text-muted">Jobs</p>
        </div>
        <div class="col-md-3">
            <i class="bi bi-people text-warning display-6"></i>
            <h2 class="fw-bold">{{ \App\Models\User::count() }}</h2>
            <p class="text-muted">Users</p>
        </div>
        <div class="col-md-3">
            <i class="bi bi-file-earmark-text text-danger display-6"></i>
            <h2 class="fw-bold">{{ \App\Models\Application::count() }}</h2>
            <p class="text-muted">Applications</p>
        </div>
    </div>
</div>

<!-- Featured Jobs -->
<div class="container my-5">
    <h2 class="fw-bold text-center mb-4">Featured Jobs</h2>
    <div class="row">
        @foreach(\App\Models\Job::where('status','approved')->latest()->take(6)->get() as $job)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <h5 class="fw-bold">{{ $job->title }}</h5>
                        <p class="text-muted mb-1"><i class="bi bi-building"></i> {{ $job->company->name }}</p>
                        <p class="text-muted mb-2"><i class="bi bi-geo-alt"></i> {{ $job->location }}</p>
                        <a href="{{ route('jobs.show', $job->id) }}" class="btn btn-outline-primary btn-sm">
                            View Job
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Featured Companies -->
<div class="container my-5">
    <h2 class="fw-bold text-center mb-4">Featured Companies</h2>
    <div class="row">
        @foreach(\App\Models\Company::latest()->take(6)->get() as $company)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-0 h-100 text-center p-3">
                    @if($company->logo)
                        <img src="{{ asset('storage/' . $company->logo) }}" 
                             alt="{{ $company->name }}" 
                             class="img-fluid mb-3" 
                             style="max-height: 80px;">
                    @else
                        <i class="bi bi-building text-secondary display-4 mb-3"></i>
                    @endif
                    <h5 class="fw-bold">{{ $company->name }}</h5>
                    <p class="text-muted">{{ Str::limit($company->description, 60) }}</p>
                    <a href="{{ route('companies.show', $company->id) }}" class="btn btn-outline-primary btn-sm">
                        View Company
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
