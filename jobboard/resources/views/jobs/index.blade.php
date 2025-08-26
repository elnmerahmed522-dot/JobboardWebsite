@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Job Listings</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

<form action="{{ route('jobs.index') }}" method="GET" class="row g-2 mb-4">
    <div class="col-md-4">
        <input type="text" name="keyword" class="form-control" placeholder="Search for jobs or companies" value="{{ request('keyword') }}">
    </div>
    <div class="col-md-3">
        <select name="location" class="form-control">
            <option value="">All Locations</option>
            @foreach($locations as $location)
                <option value="{{ $location }}" {{ request('location') == $location ? 'selected' : '' }}>
                    {{ $location }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3">
        <select name="type" class="form-control">
            <option value="">All Types</option>
            @foreach($types as $type)
                <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>
                    {{ ucfirst($type) }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-2">
        <input type="number" name="min_salary" class="form-control" placeholder="Min Salary" value="{{ request('min_salary') }}">
    </div>
    <div class="col-md-12 text-center mt-2">
        <button type="submit" class="btn btn-primary">Search</button>
    </div>
</form>

    @auth
        @role('employer')
            <a href="{{ route('employer.jobs.create') }}" class="btn btn-primary mb-3">Add New Job</a>
        @endrole
    @endauth

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Job Title</th>
                <th>Company</th>
                <th>Location</th>
                <th>Type</th>
                <th>Salary</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jobs as $job)
                <tr>
                    <td>{{ $job->title }}</td>
                    <td>{{ $job->company->name }}</td>
                    <td>{{ $job->location }}</td>
                    <td>{{ $job->type }}</td>
                    <td>{{ $job->salary ?? 'Not specified' }}</td>
                    <td>
                        <a href="{{ route('jobs.show', $job->id) }}" class="btn btn-info btn-sm">View</a>
                        @auth
                            @role('employer')
                                <a href="{{ route('employer.jobs.edit', $job->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('employer.jobs.destroy', $job->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            @endrole
                        @endauth
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
