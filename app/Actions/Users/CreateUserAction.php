<?php

namespace App\Actions\Users;
use App\Models\User;

class CreateUserAction
{
    public function handle($credentials)
    {
        return User::create($credentials);
    }
}
