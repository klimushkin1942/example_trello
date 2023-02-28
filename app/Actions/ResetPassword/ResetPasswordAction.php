<?php

namespace App\Actions\ResetPassword;

use App\Models\User;

class ResetPasswordAction
{
    public function handle($credentials, $userId)
    {
        $user = User::findOrFail($userId);
        $user->password = $credentials['password'];
        $user->save();
        return __('passwords.reset');
    }
}
