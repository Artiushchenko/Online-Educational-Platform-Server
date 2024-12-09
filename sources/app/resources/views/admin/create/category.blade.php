@extends('layout.main')

@section('title', 'New Category')

@section('content')
    <div>
        <h1>Create New Category</h1>

        <form action="{{ route('admin.categories.store') }}" method="POST" class="edit">
            @csrf
            <div class="form-group">
                <label for="name">Category Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}">
                @if ($errors->has('name'))
                    <span class="color: #FF0000; font-size: 14px;">{{ $errors->first('name') }}</span>
                @endif
            </div>

            <button type="submit">Create</button>
        </form>
    </div>
@endsection
