<?php

namespace App\Actions\ResetPassword;

use App\Models\PasswordResets;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class SendPinCodeAction
{
    public function handle($credentials)
    {
        $passwordResetUser = PasswordResets::where('token', $credentials['pincode'])->first();

        if ($passwordResetUser->created_at->diffInMinutes(Carbon::now()) > 30) {
            return __('mail.time_out');
        }

        return __('mail.success');
    }
}
