<?php

namespace App\Http\Controllers;

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
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPinCode(Request $request)
    {
        try {
            $validateDataUser = Validator::make($request->all(), ['email' => 'required|email']);
            if ($validateDataUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation error',
                    'errors' => $validateDataUser->errors()
                ], 400);
            }

            $user = User::query()->where('email', $request->email)->first();

            $pinCode = Str::random(6);
            PasswordResets::create([
                'user_id' => $user->id,
                'email' => $request->email,
                'token' => Hash::make($pinCode),
            ]);

            $data = [
                'subject' => 'Сброс пароля',
                'body' => "Добрый день!
                           Введите пожалуйста этот пинкод для дальнейшей процедуры сброса пароля: " . $pinCode
            ];

            Mail::to($request->email)->send(new MailNotify($data));

            return response()->json([
                'status' => true,
                'message' => 'Pincode sended on email',
                'token' => Hash::make($pinCode)
            ], 200);

        } catch (\Throwable $throwable) {
            return response()->json([
                'status' => false,
                'message' => $throwable->getMessage()
            ], 500);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendPinCode(Request $request)
    {
        if (!PasswordResets::query()
            ->where('token', Hash::make($request->pincode))) {
            return response()->json([
                'status' => false,
                'message' => 'Error, this pincode not exist'
            ], 400);
        }

        $passwordResetUser = PasswordResets::query()
            ->where('token', Hash::make($request->pincode));

        if ($passwordResetUser->created_at->diffInMinutes(Carbon::now()) > 30) {
            return response()->json([
                'status' => false,
                'message' => 'Request timed out'
            ], 410);
        }

        return response()->json([
            'status' => true,
            'message' => 'Pincode entered is correct',
        ], 202);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function resetPassword(Request $request)
    {
      try {
          $passwordResetUser = PasswordResets::query()
              ->where('token', $request->pincode)
              ->first();

          if ($passwordResetUser->created_at->diffInMinutes(Carbon::now()) > 30) {
              return response()->json([
                  'status' => false,
                  'message' => 'Request timed out'
              ], 410);
          }

          $user = User::query()
              ->where('id', $passwordResetUser->user_id)
              ->first();

          if ($request->newPassword != $request->confirmPassword) {
              return response()->json([
                  'status' => false,
                  'message' => 'Password not equals confirm password'
              ], 403);
          }

          $user->update([
              'password' => Hash::make($request->newPassword)
          ]);

          return response()->json([
              'status' => true,
              'message' => 'Password reset success'
          ], 202);
      } catch (\Throwable $throwable) {
          return response()->json([
              'status' => false,
              'message' => $throwable->getMessage()
          ], 500);
      }
    }
}
