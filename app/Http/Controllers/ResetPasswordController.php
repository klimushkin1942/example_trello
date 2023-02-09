<?php

namespace App\Http\Controllers;

use App\Actions\ResetPassword\GetPinCodeAction;
use App\Actions\ResetPassword\ResetPasswordAction;
use App\Actions\ResetPassword\SendPinCodeAction;
use App\Mail\MailNotify;
use App\Models\PasswordResets;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ResetPasswordController extends Controller
{
    /**
     * @param Request $request
     * @param GetPinCodeAction $action
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPinCode(Request $request, GetPinCodeAction $action)
    {
        return $action->handle($request);
    }

    /**
     * @param Request $request
     * @param SendPinCodeAction $action
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendPinCode(Request $request, SendPinCodeAction $action)
    {
        return $action->handle($request);
    }

    /**
     * @param Request $request
     * @param ResetPasswordAction $action
     * @return \Illuminate\Http\JsonResponse
     */
    public function resetPassword(Request $request, ResetPasswordAction $action)
    {
        return $action->handle($request);
    }
}
