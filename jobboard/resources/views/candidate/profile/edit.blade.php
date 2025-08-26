@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit My Profile</h1>

    <form action="{{ route('candidate.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="mb-3">
            <label class="form-label">Headline</label>
            <input type="text" name="headline" value="{{ old('headline', $profile->headline ?? '') }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Bio</label>
            <textarea name="bio" class="form-control" rows="3">{{ old('bio', $profile->bio ?? '') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Location</label>
            <input type="text" name="location" value="{{ old('location', $profile->location ?? '') }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Phone</label>
            <input type="text" name="phone" value="{{ old('phone', $profile->phone ?? '') }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">LinkedIn URL</label>
            <input type="url" name="linkedin" value="{{ old('linkedin', $profile->linkedin ?? '') }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">GitHub URL</label>
            <input type="url" name="github" value="{{ old('github', $profile->github ?? '') }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Skills (comma-separated)</label>
            <input type="text" name="skills" value="{{ old('skills', $profile->skills ?? '') }}" class="form-control" placeholder="Laravel, Vue, MySQL">
        </div>

        <div class="mb-3">
            <label class="form-label">Experience</label>
            <textarea name="experience" class="form-control" rows="6" placeholder="Add your experience, roles, achievements...">{{ old('experience', $profile->experience ?? '') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Resume (PDF/DOC/DOCX)</label>
            <input type="file" name="resume" class="form-control">
            @if(isset($profile) && $profile->resume)
                <small class="text-muted">Current: <a href="{{ asset('storage/' . $profile->resume) }}" target="_blank">Download</a></small>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Save Profile</button>
        <a href="{{ route('candidate.profile.show') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection