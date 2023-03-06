<?php

namespace App\Actions\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginUserAction
{
    public function handle(User $user, string $password)
    {
        if (Hash::check($password, $user->password)) {
            return [
                "result" => __('auth.success'),
                "id" => $user->id,
                "token" => $user->createtoken('token')->plainTextToken
            ];
        }
        return __('auth.login.failed');
    }
}
