<?php

namespace App\Actions\ResetPassword;

use App\Models\User;

class ResetPasswordAction
{
    public function handle($params, $userId)
    {
        $user = User::findOrFail($userId);
        $user->password = $params['password'];
        $user->save();
        return __('passwords.reset');
    }
}
