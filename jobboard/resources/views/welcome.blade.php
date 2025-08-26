<!-- @extends('layouts.app')

@section('content')
<div class="container">
    {{-- Header Section --}}
    <div class="text-center my-5">
        <h1 class="fw-bold">Welcome to JobBoard</h1>
        <p class="text-muted">Find your perfect job or post jobs for your company</p>
    </div>

    {{-- Quick Search --}}
    <form method="GET" action="{{ route('jobs.index') }}" class="mb-5">
        <div class="row justify-content-center">
            <div class="col-md-4 mb-2">
                <input type="text" name="keyword" class="form-control" placeholder="Search for a job or company">
            </div>
            <div class="col-md-3 mb-2">
                <button type="submit" class="btn btn-primary w-100">Search</button>
            </div>
        </div>
    </form>

    {{-- Registration Links --}}
    <div class="row text-center mb-5">
        <div class="col-md-6 mb-3">
            <a href="{{ route('register') }}" class="btn btn-success btn-lg w-75">Register as Candidate</a>
        </div>
        <div class="col-md-6 mb-3">
            <a href="{{ route('register') }}" class="btn btn-warning btn-lg w-75">Register as Employer</a>
        </div>
    </div>

    {{-- Latest Jobs --}}
    <h3 class="mb-4">Latest Jobs</h3>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Job Title</th>
                    <th>Company</th>
                    <th>Location</th>
                    <th>Type</th>
                    <th>Salary</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($latestJobs as $job)
                    <tr>
                        <td>{{ $job->title }}</td>
                        <td>{{ $job->company->name }}</td>
                        <td>{{ $job->location }}</td>
                        <td>{{ $job->type == 'full-time' ? 'Full-time' : ($job->type == 'part-time' ? 'Part-time' : 'Remote') }}</td>
                        <td>{{ $job->salary ?? 'Not specified' }}</td>
                        <td><a href="{{ route('jobs.show', $job->id) }}" class="btn btn-info btn-sm">View</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection -->

