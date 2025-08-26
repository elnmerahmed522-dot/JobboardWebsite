@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Job</h1>

    <form action="{{ route('employer.jobs.update', $job->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Job Title</label>
            <input type="text" name="title" value="{{ $job->title }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" required>{{ $job->description }}</textarea>
        </div>

        <div class="mb-3">
            <label>Location</label>
            <input type="text" name="location" value="{{ $job->location }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Job Type</label>
            <select name="type" class="form-control" required>
                <option value="full-time" {{ $job->type == 'full-time' ? 'selected' : '' }}>Full-time</option>
                <option value="part-time" {{ $job->type == 'part-time' ? 'selected' : '' }}>Part-time</option>
                <option value="remote" {{ $job->type == 'remote' ? 'selected' : '' }}>Remote</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Salary</label>
            <input type="number" step="0.01" name="salary" value="{{ $job->salary }}" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
