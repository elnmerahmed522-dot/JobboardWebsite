@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h1 class="fw-bold">{{ $job->title }}</h1>
            <p class="text-muted mb-3">
                <i class="bi bi-building"></i> {{ $job->company->name }} 
                &nbsp; | &nbsp; 
                <i class="bi bi-geo-alt"></i> {{ $job->location }}
            </p>

            <h5>Description</h5>
            <p>{{ $job->description }}</p>

            <h5>Requirements</h5>
            <p>{{ $job->requirements }}</p>

            <h5>Salary</h5>
            <p>{{ $job->salary ?? 'Not specified' }}</p>

            <hr>

            @if(auth()->check() && auth()->user()->hasRole('candidate'))
               <form action="{{ route('candidate.applications.store', $job->id) }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Upload Resume</label>
                        <input type="file" name="cv" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success">Apply Now</button>
                </form>
            @elseif(!auth()->check())
                <a href="{{ route('login') }}" class="btn btn-success">Login to Apply</a>
            @endif

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
</div>
@endsection