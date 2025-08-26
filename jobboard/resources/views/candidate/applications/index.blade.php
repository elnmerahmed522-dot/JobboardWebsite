@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="fw-bold mb-4">My Applications</h1>

    @if($applications->isEmpty())
        <p>You haven't applied to any jobs yet.</p>
    @else
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Job Title</th>
                    <th>Company</th>
                    <th>Status</th>
                    <th>Applied At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($applications as $application)
                    <tr>
                        <td>{{ $application->job->title }}</td>
                        <td>{{ $application->job->company->name }}</td>
                        <td>{{ ucfirst($application->status) }}</td>
                        <td>{{ $application->created_at->format('Y-m-d') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
