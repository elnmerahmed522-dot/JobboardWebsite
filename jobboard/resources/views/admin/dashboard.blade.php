@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="fw-bold mb-4">Admin Dashboard</h1>

    <div class="row">
        <!-- Manage Users -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0 text-center">
                <div class="card-body">
                    <i class="bi bi-people-fill display-4 text-primary"></i>
                    <h5 class="mt-2">Manage Users</h5>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-primary btn-sm">Go</a>
                </div>
            </div>
        </div>

        <!-- Manage Jobs -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0 text-center">
                <div class="card-body">
                    <i class="bi bi-briefcase-fill display-4 text-warning"></i>
                    <h5 class="mt-2">Manage Jobs</h5>
                    <a href="{{ route('admin.jobs.index') }}" class="btn btn-outline-warning btn-sm">Go</a>
                </div>
            </div>
        </div>

        <!-- Manage Applications -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0 text-center">
                <div class="card-body">
                    <i class="bi bi-file-earmark-text-fill display-4 text-danger"></i>
                    <h5 class="mt-2">Manage Applications</h5>
                    <a href="{{ route('admin.applications.index') }}" class="btn btn-outline-danger btn-sm">Go</a>
                </div>
            </div>
        </div>

        <!-- Manage Companies -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0 text-center">
                <div class="card-body">
                    <i class="bi bi-building-fill display-4 text-info"></i>
                    <h5 class="mt-2">Manage Companies</h5>
                    <a href="{{ route('admin.companies.index') }}" class="btn btn-outline-info btn-sm">Go</a>
                </div>
            </div>
        </div>

        <!-- Reports -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0 text-center">
                <div class="card-body">
                    <i class="bi bi-bar-chart display-4 text-success"></i>
                    <h5 class="mt-2">Reports</h5>
                    <p class="text-muted">View system statistics</p>
                    <a href="{{ route('admin.reports.index') }}" class="btn btn-outline-success btn-sm">Go </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
