@extends('layout.main')

@section('title', 'Categories')

@section('content')
    <div>
        <div class="search-part">
            <button onclick="window.location.href='{{ route('admin.createCategory') }}'">Create new</button>

            <form action="{{ route('admin.getCategories') }}" method="GET">
                <input
                    type="text"
                    name="search"
                    placeholder="Search by category name..."
                    value="{{ $search ?? '' }}"
                >
                <button type="submit">Search</button>

                @if($search)
                    <a href="{{ route('admin.getCategories') }}">Clear</a>
                @endif
            </form>
        </div>

        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Operations</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        <button
                            onclick="window.location.href='{{ route('admin.editCategory', ['id' => $category->id]) }}'"
                        >
                            Update
                        </button>

                        <form action="{{ route('admin.deleteCategory', ['id' => $category->id]) }}" method="POST" style="display: inline;">
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
            {{ $categories->links() }}
        </div>
    </div>
@endsection
