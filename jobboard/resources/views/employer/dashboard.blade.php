@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="fw-bold mb-4">Employer Dashboard</h1>

    <div class="row">
        <!-- Company Profile -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0 text-center">
                <div class="card-body">
                    <i class="bi bi-building display-4 text-info"></i>
                    <h5 class="mt-2">Company Profile</h5>

                    @if(Auth::user()->company)
                        <!-- زر إدارة الشركة -->
                        <a href="{{ route('employer.companies.show', Auth::user()->company->id) }}" 
                           class="btn btn-outline-info btn-sm">
                            Manage
                        </a>


                    @else
                        <!-- لو ماعندوش شركة -->
                        <a href="{{ route('employer.companies.create') }}" 
                           class="btn btn-outline-success btn-sm">
                            Create Company
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Jobs -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0 text-center">
                <div class="card-body">
                    <i class="bi bi-briefcase display-4 text-primary"></i>
                    <h5 class="mt-2">My Jobs</h5>
                    <p class="text-muted">View and manage all your posted jobs</p>
                   <a href="{{ route('employer.applications.jobs.index') }}" class="btn btn-outline-primary btn-sm"> My Jobs</a>

                </div>
            </div>
        </div>

        <!-- Applications -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0 text-center">
                <div class="card-body">
                    <i class="bi bi-people display-4 text-success"></i>
                    <h5 class="mt-2">Applications</h5>
                <a href="{{ route('employer.applications.index') }}" class="btn btn-outline-success btn-sm">View Applications</a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
