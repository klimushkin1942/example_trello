<?php

namespace App\Actions\Users;
use App\Models\User;
class UpdateUserAction
{
    public function handle(int $userId, $data)
    {
        $user = User::findOrFail($userId);
        return $user->update($data);
    }
}
