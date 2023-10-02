<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ToastNotificationTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    use ToastNotificationTrait;

    protected $users;

    public function __construct(UserService $users)
    {
        $this->users = $users;
    }

    public function index(): Response
    {
        $filters = request()->all();
        $users = $this->users->getAll();

        return Inertia::render('Admin/Users/Index', compact('users', 'filters'));
    }

    public function create(): Response
    {
        return Inertia::render('Admin/Users/Create');
    }

    public function store(UserRequest $request): RedirectResponse
    {
        $this->users->create($request);

        return to_route('users.index')->with($this->created());
    }

    public function edit(User $user): Response
    {
        return Inertia::render('Admin/Users/Edit', compact('user'));
    }

    public function update(UserRequest $request, User $user): RedirectResponse
    {
        $this->users->update($request, $user);

        return to_route('users.index')->with($this->updated());
    }

    public function destroy(User $user): RedirectResponse
    {
        $this->users->delete($user);

        return to_route('users.index')->with($this->deleted());
    }
}
