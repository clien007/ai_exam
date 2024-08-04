<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Services\UserService;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $users = $this->userService->getAllUsers();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $this->userService->storeUser($request);
        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        $types = ['Writer', 'Editor'];
        $statuses = ['Active', 'Inactive'];
        return view('users.edit', compact('user', 'types', 'statuses'));
    }

    public function update(Request $request, User $user)
    {
        $this->userService->updateUser($request, $user);
        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }
}
