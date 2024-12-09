@extends('layout.main')

@section('title', 'Courses')

@section('content')
<div>
    <div class="search-part">
        <button onclick="window.location.href='{{ route('admin.courses.create') }}'">Create new</button>

        @if(request()->has('sortBy') || request()->has('sortOrder'))
            <button
                onclick="window.location.href='{{ route('admin.courses.index', ['search' => null]) }}'"
                class="remove-button"
            >
                Reset Sort
            </button>
        @endif

        <form action="{{ route('admin.courses.index') }}" method="GET">
            <input
                type="text"
                name="search"
                placeholder="Course slug..."
                value="{{ $search ?? '' }}"
            >
            <button type="submit">Search</button>

            @if($search)
                <a href="{{ route('admin.courses.index') }}">Clear</a>
            @endif
        </form>
    </div>

    <table>
        <thead>
            <tr>
                <th>
                    <a
                        style="text-decoration: none; color: #FFFFFF;"
                        href="{{ route('admin.courses.index', ['sortBy' => 'id', 'sortOrder' => $sortBy == 'id' && $sortOrder == 'asc' ? 'desc' : 'asc']) }}"
                    >
                        ID
                        @if($sortBy == 'id')
                            @if($sortOrder == 'asc') ↑ @else ↓ @endif
                        @endif
                    </a>
                </th>
                <th>
                    <a
                        style="text-decoration: none; color: #FFFFFF;"
                        href="{{ route('admin.courses.index', ['sortBy' => 'title', 'sortOrder' => $sortBy == 'title' && $sortOrder == 'asc' ? 'desc' : 'asc']) }}"
                    >
                        Title
                        @if($sortBy == 'title')
                            @if($sortOrder == 'asc') ↑ @else ↓ @endif
                        @endif
                    </a>
                </th>
                <th>
                    <a
                        style="text-decoration: none; color: #FFFFFF;"
                        href="{{ route('admin.courses.index', ['sortBy' => 'slug', 'sortOrder' => $sortBy == 'slug' && $sortOrder == 'asc' ? 'desc' : 'asc']) }}"
                    >
                        Slug
                        @if($sortBy == 'slug')
                            @if($sortOrder == 'asc') ↑ @else ↓ @endif
                        @endif
                    </a>
                </th>
                <th>
                    <a
                        style="text-decoration: none; color: #FFFFFF;"
                        href="{{ route('admin.courses.index', ['sortBy' => 'created_by', 'sortOrder' => $sortBy == 'created_by' && $sortOrder == 'asc' ? 'desc' : 'asc']) }}"
                    >
                        Created By
                        @if($sortBy == 'created_by')
                            @if($sortOrder == 'asc') ↑ @else ↓ @endif
                        @endif
                    </a>
                </th>
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
                            onclick="window.location.href='{{ route('admin.courses.edit', ['course' => $course->slug]) }}'"
                        >
                            Update
                        </button>

                        <button type="button" class="remove-button" onclick="openModal({{ $course->id }}, '{{ route('admin.courses.destroy', ['course' => $course->id]) }}', 'course')">
                            Delete
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div>
        {{ $courses->links() }}
    </div>

    @include('components.modal')
</div>
@endsection
