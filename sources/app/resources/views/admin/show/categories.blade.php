@extends('layout.main')

@section('title', 'Categories')

@section('content')
    <div>
        <div class="search-part">
            <button onclick="window.location.href='{{ route('admin.createCategory') }}'">Create new</button>

            @if(request()->has('sortBy') || request()->has('sortOrder'))
                <button
                    onclick="window.location.href='{{ route('admin.getCategories', ['search' => null]) }}'"
                    class="remove-button"
                >
                    Reset Sort
                </button>
            @endif

            <form action="{{ route('admin.getCategories') }}" method="GET">
                <input
                    type="text"
                    name="search"
                    placeholder="Category name..."
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
                <th>
                    <a
                        style="text-decoration: none; color: #FFFFFF;"
                        href="{{ route('admin.getCategories', ['sortBy' => 'id', 'sortOrder' => $sortBy == 'id' && $sortOrder == 'asc' ? 'desc' : 'asc']) }}"
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
                        href="{{ route('admin.getCategories', ['sortBy' => 'name', 'sortOrder' => $sortBy == 'name' && $sortOrder == 'asc' ? 'desc' : 'asc']) }}"
                    >
                        Name
                        @if($sortBy == 'name')
                            @if($sortOrder == 'asc') ↑ @else ↓ @endif
                        @endif
                    </a>
                </th>
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

                        <button type="button" class="remove-button" onclick="openModal({{ $category->id }}, '{{ route('admin.deleteCategory', ['id' => $category->id]) }}', 'category')">
                            Delete
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div>
            {{ $categories->links() }}
        </div>

        @include('components.modal')
    </div>
@endsection
