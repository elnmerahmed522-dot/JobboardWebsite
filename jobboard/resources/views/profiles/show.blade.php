@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Candidate Profile</h1>

    <div class="card">
        <div class="card-body">
            <h3 class="mb-1">{{ $user->name }}</h3>
            <p class="text-muted mb-2">{{ $profile->headline }}</p>

            <p><strong>Location:</strong> {{ $profile->location ?? 'N/A' }}</p>
            <p><strong>LinkedIn:</strong>
                @if($profile->linkedin)
                    <a href="{{ $profile->linkedin }}" target="_blank">{{ $profile->linkedin }}</a>
                @else
                    N/A
                @endif
            </p>
            <p><strong>GitHub:</strong>
                @if($profile->github)
                    <a href="{{ $profile->github }}" target="_blank">{{ $profile->github }}</a>
                @else
                    N/A
                @endif
            </p>

            <p><strong>Skills:</strong><br>{{ $profile->skills ?? 'N/A' }}</p>
            <p><strong>Experience:</strong><br>{!! nl2br(e($profile->experience ?? 'N/A')) !!}</p>

            <p><strong>Resume:</strong>
                @if($profile->resume)
                    <a href="{{ asset('storage/' . $profile->resume) }}" target="_blank" class="btn btn-outline-info btn-sm">Download</a>
                @else
                    N/A
                @endif
            </p>
        </div>
    </div>
</div>
@endsection