@extends('layout.main')

@section('title', 'Lectures')

@section('content')
    <div>
        <div class="search-part">
            <button onclick="window.location.href='{{ route('admin.createLecture') }}'">Create new</button>

            @if(request()->has('sortBy') || request()->has('sortOrder'))
                <button
                    onclick="window.location.href='{{ route('admin.lectures', ['search' => null]) }}'"
                    class="remove-button"
                >
                    Reset Sort
                </button>
            @endif

            <form action="{{ route('admin.lectures') }}" method="GET">
                <input
                    type="text"
                    name="search"
                    placeholder="Lecture title..."
                    value="{{ $search ?? '' }}"
                >
                <button type="submit">Search</button>

                @if($search)
                    <a href="{{ route('admin.lectures') }}">Clear</a>
                @endif
            </form>
        </div>

        <table>
            <thead>
            <tr>
                <th>
                    <a
                        style="text-decoration: none; color: #FFFFFF;"
                        href="{{ route('admin.lectures', ['sortBy' => 'id', 'sortOrder' => $sortBy == 'id' && $sortOrder == 'asc' ? 'desc' : 'asc']) }}"
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
                        href="{{ route('admin.lectures', ['sortBy' => 'title', 'sortOrder' => $sortBy == 'title' && $sortOrder == 'asc' ? 'desc' : 'asc']) }}"
                    >
                        Title
                        @if($sortBy == 'title')
                            @if($sortOrder == 'asc') ↑ @else ↓ @endif
                        @endif
                    </a>
                </th>
                <th>
                    YouTube Video ID
                </th>
                <th>
                    <a
                        style="text-decoration: none; color: #FFFFFF;"
                        href="{{ route('admin.lectures', ['sortBy' => 'created_by', 'sortOrder' => $sortBy == 'created_by' && $sortOrder == 'asc' ? 'desc' : 'asc']) }}"
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
            @foreach($lectures as $lecture)
                <tr>
                    <td>{{ $lecture->id }}</td>
                    <td>{{ $lecture->title }}</td>
                    <td>{{ $lecture->video_id }}</td>
                    <td>{{ $lecture->creator->name }}</td>
                    <td>
                        <button
                            onclick="window.location.href='{{ route('admin.editLecture', ['lectureId' => $lecture->id]) }}'"
                        >
                            Update
                        </button>

                        <button type="button" class="remove-button" onclick="openModal({{ $lecture->id }}, '{{ route('admin.deleteLecture', ['lectureId' => $lecture->id]) }}', 'lecture')">
                            Delete
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div>
            {{ $lectures->links() }}
        </div>

        @include('components.modal')
    </div>
@endsection
