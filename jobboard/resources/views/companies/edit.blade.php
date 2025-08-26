@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Company</h1>

<form action="{{ route('employer.companies.update', $company->id) }}" method="POST" enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Company Name</label>
            <input type="text" name="name" value="{{ $company->name }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Website</label>
            <input type="url" name="website" value="{{ $company->website }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Logo</label>
            <input type="file" name="logo" class="form-control">
            @if($company->logo)
                <img src="{{ asset('storage/' . $company->logo) }}" alt="Logo" width="100">
            @endif
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ $company->description }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
