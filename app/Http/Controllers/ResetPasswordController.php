<?php

namespace App\Http\Controllers;

use App\Actions\ResetPassword\GetPinCodeAction;
use App\Actions\ResetPassword\ResetPasswordAction;
use App\Actions\ResetPassword\SendPinCodeAction;
use App\Http\Requests\ResetPassword\GetPincodeRequest;
use App\Http\Requests\ResetPassword\ResetPasswordRequest;
use App\Models\PasswordResets;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{

    public function getPinCode(GetPincodeRequest $request, GetPinCodeAction $action)
    {
        return $action->handle($request->all());
    }


    public function sendPinCode(Request $request, SendPinCodeAction $action)
    {
        $credentials = $request->all();

        if (!PasswordResets::where('token', $credentials['pincode'])) {
            return ['status' => false, 'message' => __('mail.failed')];
        }
        return $action->handle($credentials);
    }


    public function resetPassword(ResetPasswordRequest $request, ResetPasswordAction $action)
    {
        $credentials = $request->all();

        $passwordResetUser = PasswordResets::where('email', 'muhammed1942ali@gmail.com')->orderBy('id', 'desc')->first();

        if ($passwordResetUser->created_at->diffInMinutes(Carbon::now()) > 30) {
            return __('mail.time_out');
        }
        return $action->handle($credentials, $passwordResetUser->user_id);
    }
}
