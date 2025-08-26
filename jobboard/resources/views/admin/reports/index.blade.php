@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="fw-bold mb-4">Admin Reports & Statistics</h2>

    <!-- Cards with stats -->
    <div class="row text-center">
        <div class="col-md-3">
            <div class="card shadow-sm border-0 mb-3">
                <div class="card-body">
                    <h3>{{ $totalUsers }}</h3>
                    <p class="text-muted">Users</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 mb-3">
                <div class="card-body">
                    <h3>{{ $totalCompanies }}</h3>
                    <p class="text-muted">Companies</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 mb-3">
                <div class="card-body">
                    <h3>{{ $totalJobs }}</h3>
                    <p class="text-muted">Jobs</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 mb-3">
                <div class="card-body">
                    <h3>{{ $totalApplications }}</h3>
                    <p class="text-muted">Applications</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts -->
    <div class="row mt-4">
        <div class="col-md-6">
            <h5>Users by Role</h5>
            <canvas id="usersChart"></canvas>
        </div>
        <div class="col-md-6">
            <h5>Jobs by Month (This Year)</h5>
            <canvas id="jobsChart"></canvas>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Users by Role Chart
    new Chart(document.getElementById('usersChart'), {
        type: 'pie',
        data: {
            labels: {!! json_encode($usersByRole->keys()) !!},
            datasets: [{
                data: {!! json_encode($usersByRole->values()) !!},
                backgroundColor: ['#007bff', '#28a745', '#ffc107']
            }]
        }
    });

    // Jobs by Month Chart
    new Chart(document.getElementById('jobsChart'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($jobsByMonth->keys()) !!},
            datasets: [{
                label: 'Jobs',
                data: {!! json_encode($jobsByMonth->values()) !!},
                backgroundColor: '#17a2b8'
            }]
        }
    });
</script>
@endsection