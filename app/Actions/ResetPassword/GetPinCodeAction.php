<?php

namespace App\Actions\ResetPassword;

use App\Mail\MailNotify;
use App\Models\PasswordResets;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class GetPinCodeAction
{
    public function handle($data)
    {
        try {
            $validateDataUser = Validator::make($data->all(), ['email' => 'required|email']);
            if ($validateDataUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation error',
                    'errors' => $validateDataUser->errors()
                ], 400);
            }

            $user = User::query()->where('email', $data->email)->first();

            $pinCode = Str::random(6);
            PasswordResets::create([
                'user_id' => $user->id,
                'email' => $data->email,
                'token' => Hash::make($pinCode),
            ]);

            $dataForMail = [
                'subject' => 'Сброс пароля',
                'body' => "Добрый день!
                           Введите пожалуйста этот пинкод для дальнейшей процедуры сброса пароля: " . $pinCode
            ];

            Mail::to($data->email)->send(new MailNotify($dataForMail));

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
}
