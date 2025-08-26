@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="fw-bold mb-4">Applications for All My Jobs</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Job</th>
                <th>Candidate</th>
                <th>Email</th>
                <th>Profile</th>
                <th>Resume</th>
                <th>Status</th>
                <th>Applied At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($applications as $app)
                <tr>
                    <td>{{ $app->job->title }}</td>
                    <td>{{ $app->user->name }}</td>
                    <td>{{ $app->user->email }}</td>
                    <td>
                        @if($app->user->profile)
                            <a href="{{ route('profiles.public', $app->user->id) }}" class="btn btn-info btn-sm" target="_blank">View Profile</a>
                        @else
                            No Profile
                        @endif
                    </td>
                    <td>
                        @if($app->cv)
                            <a href="{{ asset('storage/' . $app->cv) }}" target="_blank" class="btn btn-outline-primary btn-sm">Download</a>
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        @if($app->status == 'pending')
                            <span class="badge bg-warning">Pending</span>
                        @elseif($app->status == 'accepted')
                            <span class="badge bg-success">Accepted</span>
                        @else
                            <span class="badge bg-danger">Rejected</span>
                        @endif
                    </td>
                    <td>{{ $app->created_at->format('Y-m-d') }}</td>
                    <td>
                        <form action="{{ route('employer.applications.updateStatus', $app->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('PUT')
                            <select name="status" onchange="this.form.submit()" class="form-select form-select-sm">
                                <option value="pending" {{ $app->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="accepted" {{ $app->status == 'accepted' ? 'selected' : '' }}>Accept</option>
                                <option value="rejected" {{ $app->status == 'rejected' ? 'selected' : '' }}>Reject</option>
                            </select>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">No applications found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
