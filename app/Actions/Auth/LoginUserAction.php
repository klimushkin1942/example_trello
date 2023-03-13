<?php

namespace App\Actions\Auth;

use App\Models\User;

class LoginUserAction
{
    public function handle($credentials)
    {
        $user = User::where('email', $credentials['email'])->first();
        return [
            "result" => 'Авторизация прошла успешно',
            "id" => $user->id,
            "token" => $user->createtoken('token')->plainTextToken
        ];
    }
}
