@extends('layout.main')

@section('title', 'Users')

@section('content')
    <div>
        <div class="search-part">
            <button onclick="window.location.href='{{ route('admin.createUser') }}'">Create new</button>

            @if(request()->has('sortBy') || request()->has('sortOrder'))
                <button
                    onclick="window.location.href='{{ route('admin.getUsers', ['search' => null]) }}'"
                    class="remove-button"
                >
                    Reset Sort
                </button>
            @endif

            <form action="{{ route('admin.getUsers') }}" method="GET">
                <input
                    type="text"
                    name="search"
                    placeholder="User e-mail..."
                    value="{{ $search ?? '' }}"
                >
                <button type="submit">Search</button>

                @if($search)
                    <a href="{{ route('admin.getUsers') }}">Clear</a>
                @endif
            </form>
        </div>

        <table>
            <thead>
            <tr>
                <th>
                    <a
                        style="text-decoration: none; color: #FFFFFF;"
                        href="{{ route('admin.getUsers', ['sortBy' => 'id', 'sortOrder' => $sortBy == 'id' && $sortOrder == 'asc' ? 'desc' : 'asc']) }}"
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
                        href="{{ route('admin.getUsers', ['sortBy' => 'name', 'sortOrder' => $sortBy == 'name' && $sortOrder == 'asc' ? 'desc' : 'asc']) }}"
                    >
                        Username
                        @if($sortBy == 'name')
                            @if($sortOrder == 'asc') ↑ @else ↓ @endif
                        @endif
                    </a>
                </th>
                <th>
                    <a
                        style="text-decoration: none; color: #FFFFFF;"
                        href="{{ route('admin.getUsers', ['sortBy' => 'role_id', 'sortOrder' => $sortBy == 'role_id' && $sortOrder == 'asc' ? 'desc' : 'asc']) }}"
                    >
                        Role
                        @if($sortBy == 'role_id')
                            @if($sortOrder == 'asc') ↑ @else ↓ @endif
                        @endif
                    </a>
                </th>
                <th>
                    <a
                        style="text-decoration: none; color: #FFFFFF;"
                        href="{{ route('admin.getUsers', ['sortBy' => 'email', 'sortOrder' => $sortBy == 'email' && $sortOrder == 'asc' ? 'desc' : 'asc']) }}"
                    >
                        Email
                        @if($sortBy == 'email')
                            @if($sortOrder == 'asc') ↑ @else ↓ @endif
                        @endif
                    </a>
                </th>
                <th>Operations</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->role->name  }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <button
                            onclick="window.location.href='{{ route('admin.editUser', ['id' => $user->id]) }}'"
                        >
                            Update
                        </button>

                        <button type="button" class="remove-button" onclick="openModal({{ $user->id }}, '{{ route('admin.deleteUser', ['id' => $user->id]) }}', 'user')">
                            Delete
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div>
            {{ $users->links() }}
        </div>

        @include('components.modal')
    </div>
@endsection
