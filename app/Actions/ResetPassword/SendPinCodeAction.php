<?php

namespace App\Actions\ResetPassword;

use App\Models\PasswordResets;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class SendPinCodeAction
{
    public function handle($params)
    {
        $passwordResetUser = PasswordResets::where('token', $params['pinCode'])->orderBy('created_at', 'asc')->first();

        if ($passwordResetUser->created_at->diffInMinutes(Carbon::now()) > 30) {
            return __('mail.time_out');
        }
        return __('mail.success');
    }
}
