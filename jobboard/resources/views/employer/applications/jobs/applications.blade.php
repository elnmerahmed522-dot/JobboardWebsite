@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="fw-bold mb-4">Applications for: {{ $job->title }}</h2>

    @forelse($applications as $application)
        <div class="card mb-3 shadow-sm border-0">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="fw-bold mb-1">{{ $application->user->name }}</h5>
                    <p class="mb-0 text-muted">
                        <i class="bi bi-envelope"></i> {{ $application->user->email }}
                    </p>
                    <p class="mb-0 text-muted">
                        <i class="bi bi-geo-alt"></i> {{ $application->user->profile->location ?? 'Not specified' }}
                    </p>
                </div>
                <div>
<a href="{{ route('profiles.public', $application->user->id) }}" class="btn btn-outline-primary btn-sm" target="_blank">
    View Profile
</a>

                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-warning">No applications yet.</div>
    @endforelse

    <!-- Pagination -->
    <div class="mt-4">
        {{ $applications->links() }}
    </div>
</div>
@endsection