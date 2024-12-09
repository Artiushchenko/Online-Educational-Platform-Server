@extends('layout.main')

@section('title', 'New User')

@section('content')
    <div>
        <h1>Create New User</h1>

        <form action="{{ route('admin.users.store') }}" method="POST" class="edit">
            @csrf
            <div class="form-group">
                <label for="name">Username</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}">
                @error('name')
                    <div class="color: #FF0000; font-size: 14px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}">
                @error('email')
                    <div class="color: #FF0000; font-size: 14px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" value="{{ old('password') }}">
                @error('password')
                    <div class="color: #FF0000; font-size: 14px;">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit">Create User</button>
        </form>
    </div>
@endsection
