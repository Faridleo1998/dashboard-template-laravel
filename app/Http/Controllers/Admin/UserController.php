<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ToastNotificationTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Models\User;
use App\Services\UserService;
use Inertia\Inertia;

class UserController extends Controller
{
    use ToastNotificationTrait;

    protected $users;

    public function __construct(UserService $users)
    {
        $this->users = $users;
    }

    public function index()
    {
        $filters = request()->all();
        $users = $this->users->getAll();

        return Inertia::render('Admin/Users/Index', compact('users', 'filters'));
    }

    public function create()
    {
        return Inertia::render('Admin/Users/Create');
    }

    public function store(UserRequest $request)
    {
        $this->users->create($request);

        return to_route('users.index')->with($this->created());
    }

    public function edit(User $user)
    {
        return Inertia::render('Admin/Users/Edit', compact('user'));
    }

    public function update(UserRequest $request, User $user)
    {
        $this->users->update($request, $user);

        return to_route('users.index')->with($this->updated());
    }

    public function destroy(User $user)
    {
        $this->users->delete($user);

        return to_route('users.index')->with($this->deleted());
    }
}
