@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Company Info -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body text-center">
            @if($company->logo)
                <img src="{{ asset('storage/' . $company->logo) }}" 
                     class="rounded mb-3" alt="{{ $company->name }}" width="120">
            @endif
            <h2 class="fw-bold">{{ $company->name }}</h2>
            @if($company->website)
                <p><a href="{{ $company->website }}" target="_blank">{{ $company->website }}</a></p>
            @endif
            <p class="text-muted mb-2">
                <i class="bi bi-geo-alt"></i> {{ $company->location ?? 'No location specified' }}
            </p>
            <p>{{ $company->description ?? 'No description available' }}</p>
        </div>
    </div>

    <!-- Jobs -->
    <h3 class="mb-3">Available Jobs</h3>
    @forelse($jobs as $job)
        <div class="card mb-3 shadow-sm border-0">
            <div class="card-body">
                <h5 class="fw-bold">
                    <a href="{{ route('jobs.show', $job->id) }}" class="text-decoration-none text-dark">
                        {{ $job->title }}
                    </a>
                </h5>
                <p class="text-muted mb-1">
                    <i class="bi bi-geo-alt"></i> {{ $job->location }}
                </p>
                <p>{{ Str::limit($job->description, 120) }}</p>
                <a href="{{ route('jobs.show', $job->id) }}" class="btn btn-outline-primary btn-sm">View Details</a>
            </div>
        </div>
    @empty
        <div class="alert alert-warning">No jobs found for this company.</div>
    @endforelse

    <!-- Pagination -->
    <div class="mt-4">
        {{ $jobs->links() }}
    </div>
</div>
@endsection