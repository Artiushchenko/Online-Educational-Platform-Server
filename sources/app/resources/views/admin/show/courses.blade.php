@extends('layout.main')

@section('title', 'Courses')

@section('content')
<div>
    <div class="search-part">
        <button onclick="window.location.href='{{ route('admin.createCourse') }}'">Create new</button>

        <form action="{{ route('admin.courses') }}" method="GET">
            <input
                type="text"
                name="search"
                placeholder="Course slug..."
                value="{{ $search ?? '' }}"
            >
            <button type="submit">Search</button>

            @if($search)
                <a href="{{ route('admin.courses') }}">Clear</a>
            @endif
        </form>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Slug</th>
                <th>Created By</th>
                <th>Operations</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $course)
                <tr>
                    <td>{{ $course->id }}</td>
                    <td>{{ $course->title }}</td>
                    <td>{{ $course->slug }}</td>
                    <td>{{ $course->creator->name }}</td>
                    <td>
                        <button
                            onclick="window.location.href='{{ route('admin.editCourse', ['courseSlug' => $course->slug]) }}'"
                        >
                            Update
                        </button>

                        <form action="{{ route('admin.deleteCourse', ['id' => $course->id]) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="remove-button">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div>
        {{ $courses->links() }}
    </div>
</div>
@endsection
