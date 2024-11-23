@extends('layout.main')

@section('title', 'Lectures')

@section('content')
    <div>
        <div class="search-part">
            <button onclick="window.location.href='{{ route('admin.createLecture') }}'">Create new</button>

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
                <th>ID</th>
                <th>Title</th>
                <th>YouTube Video ID</th>
                <th>Operations</th>
            </tr>
            </thead>
            <tbody>
            @foreach($lectures as $lecture)
                <tr>
                    <td>{{ $lecture->id }}</td>
                    <td>{{ $lecture->title }}</td>
                    <td>{{ $lecture->video_id }}</td>
                    <td>
                        <button
                            onclick="window.location.href='{{ route('admin.editLecture', ['lectureId' => $lecture->id]) }}'"
                        >
                            Update
                        </button>

                        <form action="{{ route('admin.deleteLecture', ['lectureId' => $lecture->id]) }}" method="POST" style="display: inline;">
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
    </div>
@endsection
