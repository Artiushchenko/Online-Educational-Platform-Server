@extends('layout.main')

@section('title', 'Edit User')

@section('content')
    <div>
        <h1>Edit User</h1>

        <form action="{{ route('admin.updateUser', $user->id) }}" method="POST" class="edit">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Username</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required>
                @error('name')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required>
                @error('email')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password (leave empty to keep the current one)</label>
                <input type="password" name="password" id="password">
                @error('password')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="role">Role</label>
                <select name="role_id" id="role" class="user_select" required>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}"
                                @if($role->id == old('role_id', $user->role_id)) selected @endif>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
                @error('role_id')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <button type="submit">Update User</button>
        </form>
    </div>
@endsection
