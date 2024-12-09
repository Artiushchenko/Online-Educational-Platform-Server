<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function getUsers(?string $search, string $sortBy, string $sortOrder): Paginator
    {
        return User::with('role')
            ->select('id', 'name', 'role_id', 'email')
            ->when($search, function ($query, $search) {
                return $query->where('email', 'like', '%' . $search . '%');
            })
            ->orderBy($sortBy, $sortOrder)
            ->simplePaginate(10);
    }

    public function createUser(array $data): User
    {
        $role = Role::where('name', 'Student')->first();

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id' => $role->id,
        ]);
    }

    public function updateUser(User $user, array $data): User
    {
        $user->name = $data['name'];
        $user->email = $data['email'];

        if (!empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        $user->role_id = $data['role_id'];
        $user->save();

        return $user;
    }

    public function deleteUser(User $user): bool
    {
        return $user->delete();
    }
}
