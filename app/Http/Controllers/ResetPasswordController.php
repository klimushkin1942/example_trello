<?php

namespace App\Http\Controllers;

use App\Actions\ResetPassword\GetPinCodeAction;
use App\Actions\ResetPassword\ResetPasswordAction;
use App\Actions\ResetPassword\SendPinCodeAction;
use App\Mail\MailNotify;
use App\Models\PasswordResets;
use Carbon\Carbon;
use Illuminate\Auth\Events\Attempting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ResetPasswordController extends Controller
{

    public function getPinCode(Request $request, GetPinCodeAction $action)
    {
        $credentials = $request->validate(
            [
                'email' => 'email:rfc',
            ]);
        return $action->handle($credentials);
    }


    public function sendPinCode(Request $request, SendPinCodeAction $action)
    {
        $credentials = $request->all();

        if (!PasswordResets::where('token', $credentials['pincode'])) {
            return response()->json([
                'status' => false,
                'message' => 'Error, this pincode not exist'
            ], 400);
        }
        return $action->handle($credentials);
    }


    public function resetPassword(Request $request, ResetPasswordAction $action)
    {
        $credentials = request()->validate(
            [
                'newPassword' => 'required|min:8',
                'confirmPassword' => 'required|min:8',
                'pincode' => 'required|string|min:6'
            ]);

        $passwordResetUser = PasswordResets::where('token', $credentials['pincode'])->first();

        if ($passwordResetUser->created_at->diffInMinutes(Carbon::now()) > 30) {
            return __('Request is time out');
        }

        $user = User::where('id', $passwordResetUser->user_id)->first();

        if ($credentials['newPassword'] != $credentials['confirmPassword']) {
            return __('Password not equals confirm password');
        }
        return $action->handle($credentials, $user->id);
    }
}
