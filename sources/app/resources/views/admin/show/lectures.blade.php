@extends('layout.main')

@section('title', 'Lectures')

@section('content')
    <div>
        <div class="search-part">
            <button>Create new</button>

            <input type="text" placeholder="Search...">
        </div>

        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Content</th>
                <th>YouTube Video ID</th>
                <th>Operations</th>
            </tr>
            </thead>
            <tbody>
            @foreach($lectures as $lecture)
                <tr>
                    <td>{{ $lecture->id }}</td>
                    <td>{{ $lecture->title }}</td>
                    <td>{{ $lecture->content }}</td>
                    <td>{{ $lecture->video_id }}</td>
                    <td>
                        <button>Update</button>
                        <button class="remove-button">Delete</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
