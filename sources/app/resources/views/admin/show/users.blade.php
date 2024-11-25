@extends('layout.main')

@section('title', 'Users')

@section('content')
    <div>
        <div class="search-part">
            <button onclick="window.location.href='{{ route('admin.createUser') }}'">Create new</button>

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
                <th>ID</th>
                <th>Username</th>
                <th>Role</th>
                <th>Email</th>
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

                        <form action="{{ route('admin.deleteUser', ['id' => $user->id]) }}" method="POST" style="display: inline;">
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
            {{ $users->links() }}
        </div>
    </div>
@endsection
