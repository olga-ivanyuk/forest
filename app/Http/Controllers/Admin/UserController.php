<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreRequest;
use App\Http\Resources\Role\RoleResource;
use App\Http\Resources\User\UserResource;
use App\Models\Role;
use App\Models\User;
use App\Services\UserService;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index(): \Inertia\Response
    {
        $users = UserResource::collection(User::all())->resolve();

        return Inertia::render('Admin/User/Index', compact('users'));
    }

    public function create(): \Inertia\Response
    {
        $roles = RoleResource::collection(Role::all())->resolve();

        return Inertia::render('Admin/User/Create', compact('roles'));
    }

    public function store(StoreRequest $request): array
    {
        $data = $request->validated();
        $user = UserService::create($data);

        return RoleResource::make($user)->resolve();
    }
}
