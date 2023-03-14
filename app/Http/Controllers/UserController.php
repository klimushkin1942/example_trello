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
    public function index(GetAllUserAction $action, $orgId, GetAllUserRequest $request)
    {
        $this->authorize('can-get-all-users', [User::class, $orgId]);
        return $action->handle($orgId, $request->validated());
    }

    public function store(UserStoreRequest $request, CreateUserAction $action)
    {
        return $action->handle($request->validated());
    }

    public function show(GetOneUserAction $action, $orgId, $userId)
    {
        $this->authorize('can-read-user', [User::class, $orgId]);
        return $action->handle($orgId, $userId);
    }

    public function update(UserUpdateRequest $request, $userId, UpdateUserAction $action)
    {
        return $action->handle($userId, $request->validated());
    }

    public function destroy(DeleteUserFromOrganization $action, $orgId, $userId)
    {
        $this->authorize('can-delete-user', [User::class, $orgId]);
        return $action->handle(Organization::findOrFail($orgId), User::findOrFail($userId));
    }
}
