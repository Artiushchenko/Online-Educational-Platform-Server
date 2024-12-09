@extends('layout.main')

@section('title', 'Categories')

@section('content')
    <div>
        <div class="search-part">
            <button onclick="window.location.href='{{ route('admin.categories.create') }}'">Create new</button>

            @if(request()->has('sortBy') || request()->has('sortOrder'))
                <button
                    onclick="window.location.href='{{ route('admin.categories.index', ['search' => null]) }}'"
                    class="remove-button"
                >
                    Reset Sort
                </button>
            @endif

            <form action="{{ route('admin.categories.index') }}" method="GET">
                <input
                    type="text"
                    name="search"
                    placeholder="Category name..."
                    value="{{ $search ?? '' }}"
                >
                <button type="submit">Search</button>

                @if($search)
                    <a href="{{ route('admin.categories.index') }}">Clear</a>
                @endif
            </form>
        </div>

        <table>
            <thead>
            <tr>
                <th>
                    <a
                        style="text-decoration: none; color: #FFFFFF;"
                        href="{{ route('admin.categories.index', ['sortBy' => 'id', 'sortOrder' => $sortBy == 'id' && $sortOrder == 'asc' ? 'desc' : 'asc']) }}"
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
                        href="{{ route('admin.categories.index', ['sortBy' => 'name', 'sortOrder' => $sortBy == 'name' && $sortOrder == 'asc' ? 'desc' : 'asc']) }}"
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
                            onclick="window.location.href='{{ route('admin.categories.edit', ['category' => $category->id]) }}'"
                        >
                            Update
                        </button>

                        <button type="button" class="remove-button" onclick="openModal({{ $category->id }}, '{{ route('admin.categories.destroy', ['category' => $category->id]) }}', 'category')">
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
