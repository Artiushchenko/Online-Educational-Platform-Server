@extends('layout.main')

@section('title', 'New Course')

@section('content')
    <div>
        <h1>Create New Course</h1>

        <form action="{{ route('admin.courses.store') }}" method="POST" class="edit">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title">
                @error('title')
                    <div class="color: #FF0000; font-size: 14px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" name="slug" id="slug">
                @error('slug')
                    <div class="color: #FF0000; font-size: 14px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="lectures">Lectures</label>
                <select id="lectures" name="lectures[]" class="form-control" multiple>
                    @foreach($lectures as $lecture)
                        <option value="{{ $lecture->id }}">{{ $lecture->title }}</option>
                    @endforeach
                </select>
                @error('lectures')
                    <div class="color: #FF0000; font-size: 14px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="categories">Categories</label>
                <select id="categories" name="categories[]" class="form-control" multiple>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('categories')
                    <div class="color: #FF0000; font-size: 14px;">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit">Create Course</button>
        </form>
    </div>

    <script>
        new MultiSelectTag('lectures', {
            tagColor: {
                textColor: '#000000',
                borderColor: '#000000',
                bgColor: '#FFFFFF'
            }
        });

        new MultiSelectTag('categories', {
            tagColor: {
                textColor: '#000000',
                borderColor: '#000000',
                bgColor: '#FFFFFF'
            }
        });
    </script>
@endsection
