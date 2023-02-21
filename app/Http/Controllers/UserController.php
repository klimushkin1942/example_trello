<?php

namespace App\Http\Controllers;

use App\Actions\Users\CreateUserAction;
use App\Actions\Users\DeleteUserAction;
use App\Actions\Users\GetAllUserAction;
use App\Actions\Users\GetOneUserAction;
use App\Actions\Users\UpdateUserAction;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;

class UserController extends Controller
{
    public function index(GetAllUserAction $action)
    {
//        $this->authorize('view-protected-part', [self::class]);
        return $action->handle();
    }

    public function store(UserStoreRequest $request, CreateUserAction $action)
    {
        return $action->handle($request->all());
    }

    public function show($userId, GetOneUserAction $action)
    {
        return $action->handle($userId);
    }

    public function update(UserUpdateRequest $request, $userId, UpdateUserAction $action)
    {
        return $action->handle($userId, $request->all());
    }

    public function destroy($userId, DeleteUserAction $action)
    {
        return $action->handle($userId);
    }
}
