<?php

namespace App\Actions\Users;
use App\Models\User;

class CreateUserAction
{
    public function handle($params)
    {
        return User::create($params);
    }
}
