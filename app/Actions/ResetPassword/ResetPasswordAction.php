<?php

namespace App\Actions\ResetPassword;

use App\Models\User;

class ResetPasswordAction
{
    public function handle($credentials, $userId)
    {
        User::where('id', $userId)->update(
            ['password' => bcrypt($credentials['newPassword'])]
        );

        return __('Password reset success');
    }
}
