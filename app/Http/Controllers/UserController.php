<?php

namespace App\Http\Controllers;

use App\Actions\Organizations\DeleteUserFromOrganization;
use App\Actions\Users\CreateUserAction;
use App\Actions\Users\GetAllUserAction;
use App\Actions\Users\GetOneUserAction;
use App\Actions\Users\UpdateUserAction;
use App\Http\Requests\User\GetAllUserRequest;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\Organization;
use App\Models\User;

class UserController extends Controller
{
    public function index(GetAllUserAction $action, Organization $org, GetAllUserRequest $request)
    {
        $this->authorize('can-get-all-users', [User::class, $org]);
        return $action->handle($org, $request->validated());
    }

    public function store(UserStoreRequest $request, CreateUserAction $action)
    {
        return $action->handle($request->validated());
    }

    public function show(GetOneUserAction $action, Organization $org, User $user)
    {
        $this->authorize('can-read-user', [User::class, $org]);
        return $action->handle($org, $user);
    }

    public function update(UserUpdateRequest $request, User $user, UpdateUserAction $action)
    {
        return $action->handle($user, $request->validated());
    }

    public function destroy(DeleteUserFromOrganization $action, Organization $org, User $user)
    {
        $this->authorize('can-delete-user', [User::class, $org]);
        return $action->handle($org, $user);
    }
}
