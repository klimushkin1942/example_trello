<?php

namespace App\Actions\Users;
use App\Models\User;
class UpdateUserAction
{
    public function handle(int $userId, $data)
    {
        return User::find($userId)->update($data);
    }
}
