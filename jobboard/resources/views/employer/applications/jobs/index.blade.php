@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="fw-bold mb-4">My Jobs</h2>

    @forelse($jobs as $job)
        <div class="card mb-3 shadow-sm border-0">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="fw-bold">{{ $job->title }}</h5>
                    <p class="text-muted mb-0">
                        <i class="bi bi-geo-alt"></i> {{ $job->location }}
                    </p>
                </div>
                <div>
<a href="{{ route('employer.jobs.applications', $job) }}" class="btn btn-outline-info btn-sm">
    View Applications
</a>

                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-warning">You have not posted any jobs yet.</div>
    @endforelse

    <!-- Pagination -->
    <div class="mt-4">
        {{ $jobs->links() }}
    </div>
</div>
@endsection