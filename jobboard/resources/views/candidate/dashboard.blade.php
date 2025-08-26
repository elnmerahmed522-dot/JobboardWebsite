@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="fw-bold mb-4">Candidate Dashboard</h1>

    <div class="row mb-4">
        <!-- Profile Card -->
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="bi bi-person-circle display-4 text-primary"></i>
                    <h5 class="mt-2">My Profile</h5>
                    <a href="{{ route('candidate.profile.show') }}" class="btn btn-outline-primary btn-sm">View / Edit</a>
                </div>
            </div>
        </div>

        <!-- Applications Card -->
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="bi bi-briefcase display-4 text-success"></i>
                    <h5 class="mt-2">My Applications</h5>
                    <a href="{{ route('candidate.applications.index') }}" class="btn btn-outline-success btn-sm">View</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
