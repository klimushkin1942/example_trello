<?php

namespace App\Actions\Users;
use App\Models\User;
class UpdateUserAction
{
    public function handle(User $user, $params)
    {
        return $user->update($params);
    }
}
