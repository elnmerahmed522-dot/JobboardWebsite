@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Application Management</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Candidate</th>
                <th>Email</th>
                <th>Job</th>
                <th>Company</th>
                <th>Resume</th>
                <th>Status</th>
                <th>Applied At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($applications as $app)
                <tr>
                    <td>{{ $app->user->name }}</td>
                    <td>{{ $app->user->email }}</td>
                    <td>{{ $app->job->title }}</td>
                    <td>{{ $app->job->company->name }}</td>
                    <td>
                        @if($app->cv)
                            <a href="{{ asset('storage/' . $app->cv) }}" target="_blank">Download</a>
                        @else
                            Not Available
                        @endif
                    </td>
                    <td>
                        @if($app->status == 'pending')
                            <span class="badge bg-warning">Under Review</span>
                        @elseif($app->status == 'accepted')
                            <span class="badge bg-success">Accepted</span>
                        @else
                            <span class="badge bg-danger">Rejected</span>
                        @endif
                    </td>
                    <td>{{ $app->created_at->format('Y-m-d') }}</td>
                    <td>
                        <form action="{{ route('admin.applications.destroy', $app->id) }}" method="POST" style="display:inline-block;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this application?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
