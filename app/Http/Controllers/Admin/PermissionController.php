<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\PermissionService;
use Inertia\Inertia;
use Inertia\Response;

class PermissionController extends Controller
{
    protected $permissions;

    public function __construct(PermissionService $permissions)
    {
        $this->permissions = $permissions;
    }

    public function index(): Response
    {
        $filters = request()->all();
        $permissions = $this->permissions->getAll();

        return Inertia::render('Admin/Permissions/Index', compact('permissions', 'filters'));
    }
}
