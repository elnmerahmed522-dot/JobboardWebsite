@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add New Job</h1>

    <form action="{{ route('employer.jobs.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Job Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
            <label>Location</label>
            <input type="text" name="location" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Job Type</label>
            <select name="type" class="form-control" required>
                <option value="full-time">Full-time</option>
                <option value="part-time">Part-time</option>
                <option value="remote">Remote</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Salary (Optional)</label>
            <input type="number" step="0.01" name="salary" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Save</button>
    </form>
</div>
@endsection
