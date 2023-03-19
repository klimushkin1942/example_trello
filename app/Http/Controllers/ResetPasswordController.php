<?php

namespace App\Http\Controllers;

use App\Actions\ResetPassword\GetPinCodeAction;
use App\Actions\ResetPassword\ResetPasswordAction;
use App\Actions\ResetPassword\SendPinCodeAction;
use App\Http\Requests\ResetPassword\GetPincodeRequest;
use App\Http\Requests\ResetPassword\ResetPasswordRequest;
use App\Http\Requests\ResetPassword\SendPincodeRequest;
use App\Models\PasswordResets;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    public function getPinCode(GetPincodeRequest $request, GetPinCodeAction $action)
    {
        return $action->handle($request->validated());
    }

    public function sendPinCode(SendPincodeRequest $request, SendPinCodeAction $action)
    {
        $params = $request->validated();

        if (!PasswordResets::where('token', $params['pin_code'])) {
            return ['status' => false, 'message' => __('mail.failed')];
        }
        return $action->handle($params);
    }


    public function resetPassword(ResetPasswordRequest $request, ResetPasswordAction $action)
    {
        $params = $request->validated();
        $passwordResetUser = PasswordResets::where('token', $params['pinCode'])->orderBy('id', 'desc')->first();

        if ($passwordResetUser->created_at->diffInMinutes(Carbon::now()) > 30) {
            return __('mail.time_out');
        }
        return $action->handle($params, $passwordResetUser->user_id);
    }
}
