@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit User Role: {{ $user->name }}</h1>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Select Role</label>
            <select name="role" class="form-control">
                @foreach($roles as $role)
                    <option value="{{ $role->name }}" {{ $user->roles->pluck('name')->first() == $role->name ? 'selected' : '' }}>
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
