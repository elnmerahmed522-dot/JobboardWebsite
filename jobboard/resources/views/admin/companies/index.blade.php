@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Company Management</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.companies.index') }}" class="btn btn-primary mb-3">All Companies</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Company Name</th>
                <th>Owner</th>
                <th>Website</th>
                <th>Description</th>
                <th>Logo</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($companies as $company)
                <tr>
                    <td>{{ $company->name }}</td>
                    <td>{{ $company->user->name }}</td>
                    <td>
                        @if($company->website)
                            <a href="{{ $company->website }}" target="_blank">{{ $company->website }}</a>
                        @else
                            Not Available
                        @endif
                    </td>
                    <td>{{ Str::limit($company->description, 50) }}</td>
                    <td>
                        @if($company->logo)
                            <img src="{{ asset('storage/' . $company->logo) }}" alt="Logo" width="80">
                        @else
                            Not Available
                        @endif
                    </td>
                    <td><a href="{{ route('admin.companies.edit', $company->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.companies.destroy', $company->id) }}" method="POST" style="display:inline-block;">
                            @csrf 
                        
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this company?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
