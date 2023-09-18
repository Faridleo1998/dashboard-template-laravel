<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Models\User;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();

        return Inertia::render('Admin/Users/Index', compact('users'));
    }

    public function create()
    {
        return Inertia::render('Admin/Users/Create');
    }

    public function store(UserRequest $request)
    {
        User::create($request->all());

        return to_route('users.index');
    }

    public function edit(User $user)
    {
        return Inertia::render('Admin/Users/Edit', compact('user'));
    }

    public function update(UserRequest $request, User $user)
    {
        $user->fill($request->all());
        $user->save();

        return to_route('users.index');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return to_route('users.index');
    }
}
