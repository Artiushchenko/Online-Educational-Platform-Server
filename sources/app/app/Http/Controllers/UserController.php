<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\Lecture;
use App\Models\Role;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function __construct(
        protected UserService $userService
    ) {}

    public function index(Request $request): View
    {
        $search = (string) $request->input('search');
        $sortBy = (string) $request->input('sortBy', 'id');
        $sortOrder = (string) $request->input('sortOrder', 'asc');

        $users = $this->userService->getUsers($search, $sortBy, $sortOrder);

        return view('admin.show.users', compact('users', 'search', 'sortBy', 'sortOrder'));
    }

    public function create(): View
    {
        return view('admin.create.user');
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $this->userService->createUser($validated);

        return redirect()->route('admin.getUsers');
    }

    public function edit(int $id): View
    {
        $user = User::findOrFail($id);

        $roles = Role::all();

        return view('admin.edit.user', compact('user', 'roles'));
    }

    public function update(UpdateUserRequest $request, int $id): RedirectResponse
    {
        $validated = $request->validated();

        $user = User::findOrFail($id);

        $this->userService->updateUser($user, $validated);

        return redirect()->route('admin.getUsers');
    }

    public function delete(int $id): RedirectResponse
    {
        $user = User::findOrFail($id);

        $this->userService->deleteUser($user);

        return redirect()->route('admin.getUsers');
    }

    public function getStatistics(): JsonResponse
    {
        $user = auth()->user();

        $totalLectures = Lecture::count();
        $viewedLectures = $user->viewedLectures()->count();

        return response()->json([
            'progress' => $totalLectures > 0 ? ($viewedLectures / $totalLectures) * 100 : 0
        ]);
    }

    public function getUser(): JsonResponse
    {
        $user = auth()->user();

        return response()->json([
            'user_name' => $user->name,
            'user_role' => $user->role->name
        ]);
    }
}
