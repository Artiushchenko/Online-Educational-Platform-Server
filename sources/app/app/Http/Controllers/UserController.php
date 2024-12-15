<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Mail\WelcomeMail;
use App\Models\Role;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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

        $user = $this->userService->createUser($validated);

        Mail::to($user->email)->send(new WelcomeMail($user));

        return redirect()->route('admin.users.index');
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

        return redirect()->route('admin.users.index');
    }

    public function destroy(int $id): RedirectResponse
    {
        $user = User::findOrFail($id);

        $this->userService->deleteUser($user);

        return redirect()->route('admin.users.index');
    }
}
