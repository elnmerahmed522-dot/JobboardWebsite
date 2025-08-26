@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $company->name }}</h1>

    @if($company->logo)
        <img src="{{ asset('storage/' . $company->logo) }}" alt="Logo" width="150">
    @endif

    <p><strong>Website:</strong> 
        @if($company->website)
            <a href="{{ $company->website }}" target="_blank">{{ $company->website }}</a>
        @else
            N/A
        @endif
    </p>

    <p><strong>Description:</strong> {{ $company->description }}</p>
@auth
    @role('employer')
        <a href="{{ route('employer.companies.edit', $company->id) }}" class="btn btn-warning">Edit</a>

        <form action="{{ route('employer.companies.destroy', $company->id) }}" method="POST" style="display:inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
        </form>
    @endrole
@endauth

</div>
@endsection
