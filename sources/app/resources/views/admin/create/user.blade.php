@extends('layout.main')

@section('title', 'New User')

@section('content')
    <div>
        <h1>Create New User</h1>

        <form action="{{ route('admin.storeUser') }}" method="POST" class="edit">
            @csrf
            <div class="form-group">
                <label for="name">Username</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required>
                @error('name')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required>
                @error('email')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
                @error('password')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <button type="submit">Create User</button>
        </form>
    </div>
@endsection
