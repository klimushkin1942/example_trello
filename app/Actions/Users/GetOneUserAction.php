<?php

namespace App\Actions\Users;
use App\Models\User;
class GetOneUserAction
{
    public function handle(int $userId)
    {
        return User::find($userId);
    }
}
