<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\Lecture;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sortBy = $request->input('sortBy', 'id');
        $sortOrder = $request->input('sortOrder', 'asc');

        $users = User::with('role')
            ->select('id', 'name', 'role_id', 'email')
            ->when($search, function ($query, $search) {
                return $query->where('email', 'like', '%' . $search . '%');
            })
            ->orderBy($sortBy, $sortOrder)
            ->simplePaginate(10);

        return view('admin.show.users', [
            'users' => $users,
            'search' => $search,
            'sortBy' => $sortBy,
            'sortOrder' => $sortOrder
        ]);
    }

    public function create()
    {
        return view('admin.create.user');
    }

    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();

        $role = Role::where('name', 'Student')->first();

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role_id' => $role->id,
        ]);

        return redirect()->route('admin.getUsers');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        $roles = Role::all();

        return view('admin.edit.user', ['user' => $user, 'roles' => $roles]);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $validated = $request->validated();

        $user = User::findOrFail($id);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        if ($validated['password']) {
            $user->password = Hash::make($validated['password']);
        }
        $user->role_id = $validated['role_id'];

        $user->save();

        return redirect()->route('admin.getUsers');
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->route('admin.getUsers');
    }

    public function getStatistics()
    {
        $user = auth()->user();

        $totalLectures = Lecture::count();
        $viewedLectures = $user->viewedLectures()->count();

        return response()->json([
            'progress' => $totalLectures > 0 ? ($viewedLectures / $totalLectures) * 100 : 0
        ]);
    }

    public function getUser()
    {
        $user = auth()->user()->name;
        $role = auth()->user()->role->name;

        return response()->json([
            'user_name' => $user,
            'user_role' => $role
        ], 200);
    }
}
