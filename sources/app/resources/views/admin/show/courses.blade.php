@extends('layout.main')

@section('title', 'Courses')

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
                        <button>Update</button>
                        <button class="remove-button">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
