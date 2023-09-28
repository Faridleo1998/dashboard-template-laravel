<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Models\User;
use App\Services\UserService;
use Inertia\Inertia;

class UserController extends Controller
{
    protected $users;

    public function __construct(UserService $users)
    {
        $this->users = $users;
    }

    public function index()
    {
        $users = $this->users->getAll();
        $filters = request()->all();

        return Inertia::render('Admin/Users/Index', compact('users', 'filters'));
    }

    public function create()
    {
        return Inertia::render('Admin/Users/Create');
    }

    public function store(UserRequest $request)
    {
        $this->users->create($request);

        return to_route('users.index');
    }

    public function edit(User $user)
    {
        return Inertia::render('Admin/Users/Edit', compact('user'));
    }

    public function update(UserRequest $request, User $user)
    {
        $this->users->update($request, $user);

        return to_route('users.index');
    }

    public function destroy(User $user)
    {
        $this->users->delete($user);

        return to_route('users.index');
    }
}
