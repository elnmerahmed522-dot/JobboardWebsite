@extends('layouts.app')

@section('content')
<div class="container">
    <div class="text-center mb-5">
        <h1 class="fw-bold">Find Your Dream Job</h1>
        <p class="text-muted">Browse thousands of job opportunities and apply in minutes</p>
    </div>

    <!-- Search bar -->
    <form method="GET" action="{{ route('home') }}" class="mb-4">
        <div class="input-group input-group-lg shadow-sm">
            <input type="text" name="search" class="form-control"
                   placeholder="Search by job title or location..."
                   value="{{ request('search') }}">
            <button class="btn btn-primary px-4" type="submit">Search</button>
        </div>
    </form>

    <!-- Jobs list -->
    @forelse($jobs as $job)
        <div class="card mb-3 shadow-sm border-0">
            <div class="card-body">
                <h4 class="fw-bold">
                    <a href="{{ route('jobs.show', $job->id) }}" class="text-decoration-none text-dark">
                        {{ $job->title }}
                    </a>
                </h4>
                <p class="text-muted mb-1">
                    <i class="bi bi-building"></i> {{ $job->company->name }}
                    &nbsp; | &nbsp;
                    <i class="bi bi-geo-alt"></i> {{ $job->location }}
                </p>
                <p>{{ Str::limit($job->description, 100) }}</p>
                <a href="{{ route('jobs.show', $job->id) }}" class="btn btn-outline-primary btn-sm">View Details</a>
                
                <p class="text-muted mb-1">
                <i class="bi bi-building"></i>
                <a href="{{ route('companies.show', $job->company->id) }}" class="text-decoration-none">
                 {{ $job->company->name }}
                 </a>
                  &nbsp; | &nbsp;
                <i class="bi bi-geo-alt"></i> {{ $job->location }}
                </p>
            </div>
        </div>
    @empty
        <div class="alert alert-warning">No jobs found.</div>
    @endforelse

    <!-- Pagination -->
    <div class="mt-4">
        {{ $jobs->withQueryString()->links() }}
    </div>
</div>
@endsection