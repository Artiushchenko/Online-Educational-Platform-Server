@extends('layout.main')

@section('title', 'Edit Course')

@section('content')
    <div>
        <h1>Edit Course</h1>

        <form action="{{ route('admin.updateCourse', $course->slug) }}" method="POST" class="edit">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Title</label>
                <input
                    type="text"
                    name="title"
                    id="title"
                    value="{{ old('title', $course->title) }}"
                    required
                >
            </div>

            <div class="form-group">
                <label for="slug">Slug</label>
                <input
                    type="text"
                    name="slug"
                    id="slug"
                    value="{{ old('slug', $course->slug) }}"
                    required
                >
            </div>

            <div class="form-group">
                <label for="lectures">Lectures</label>
                <select name="lectures[]" id="lectures" class="form-control" multiple required>
                    @foreach($lectures as $lecture)
                        <option value="{{ $lecture->id }}"
                                @if(in_array($lecture->id, $course->lectures->pluck('id')->toArray())) selected @endif>
                            {{ $lecture->title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="categories">Categories</label>
                <select name="categories[]" id="categories" class="form-control" multiple required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                                @if(in_array($category->id, $course->categories->pluck('id')->toArray())) selected @endif>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit">Update Course</button>
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
