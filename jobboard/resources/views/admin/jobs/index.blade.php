
 @extends('layouts.app')

@section('content')
<div class="container">
    <h1> Positions are awaiting approval</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Job title</th>
                <th>Company</th>
                <th>Location</th>
                <th>Type</th>
                <th>Procedures</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jobs as $job)
                <tr>
                    <td>{{ $job->title }}</td>
                    <td>{{ $job->company->name }}</td>
                    <td>{{ $job->location }}</td>
                    <td>{{ $job->type }}</td>
                    <td>
                        <form action="{{ route('admin.jobs.approve', $job->id) }}" method="POST" style="display:inline-block;">
                            @csrf
              <button type="submit" class="btn btn-success btn-sm">Approval</button>
                        </form>

                        <form action="{{ route('admin.jobs.reject', $job->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Rejected</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
