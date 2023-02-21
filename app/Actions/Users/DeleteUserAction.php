<?php

namespace App\Actions\Users;
use App\Models\User;
class DeleteUserAction
{
    public function handle(int $userId)
    {
        return User::destroy($userId);
    }
}
