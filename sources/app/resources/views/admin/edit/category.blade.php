@extends('layout.main')

@section('title', 'Edit Category')

@section('content')
    <div>
        <h1>Edit Category</h1>

        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" class="edit">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Category Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $category->name) }}">
                @if ($errors->has('name'))
                    <span class="color: #FF0000; font-size: 14px;">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <button type="submit">Update</button>
        </form>
    </div>
@endsection
