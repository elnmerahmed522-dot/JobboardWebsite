@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Company Information</h1>

    <form action="{{ route('admin.companies.update', $company->id) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Company Name</label>
            <input type="text" name="name" value="{{ $company->name }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Website</label>
            <input type="url" name="website" value="{{ $company->website }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ $company->description }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
