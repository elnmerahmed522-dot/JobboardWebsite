@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $job->title }}</h1>
    <p><strong>Company:</strong> {{ $job->company->name }}</p>
    <p><strong>Location:</strong> {{ $job->location }}</p>
    <p><strong>Type:</strong> {{ $job->type }}</p>
    <p><strong>Salary:</strong> {{ $job->salary ?? 'Not specified' }}</p>
    <p><strong>Description:</strong> {{ $job->description }}</p>

    <a href="{{ route('employer.jobs.index') }}" class="btn btn-secondary">Back</a>
</div>

@role('candidate')
<form action="{{ route('candidate.applications.store', ['job' => $job->id]) }}" 
      method="POST" enctype="multipart/form-data" class="mt-4">
    @csrf
    <div class="mb-3">
        <label for="cv" class="form-label">Upload CV (Optional)</label>
        <input type="file" name="cv" id="cv" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Apply for Job</button>
</form>


@endrole
@endsection
