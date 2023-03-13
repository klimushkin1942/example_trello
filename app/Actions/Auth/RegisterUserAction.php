<?php

namespace App\Actions\Auth;

use App\Models\User;

class RegisterUserAction
{
    public function handle($credentials)
    {
        return User::create($credentials);
    }
}
