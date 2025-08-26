@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Applications for Job: {{ $job->title }}</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Applicant</th>
                <th>Email</th>
                <th>CV</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($applications as $app)
                <tr>
                    <td>{{ $app->user->name }}</td>
                    <td>{{ $app->user->email }}</td>
                    <td>
                        @if($app->cv)
                            <a href="{{ asset('storage/' . $app->cv) }}" target="_blank">Download</a>
                        @else
                            Not Available
                        @endif
                    </td>
                    <td>{{ ucfirst($app->status) }}</td>
                    <td>
                        @if($app->status == 'pending')
                            <form action="{{ route('applications.accept', $app->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">Accept</button>
                            </form>
                            <form action="{{ route('applications.reject', $app->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                            </form>
                        @else
                            <span>{{ $app->status == 'accepted' ? 'Accepted' : 'Rejected' }}</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
