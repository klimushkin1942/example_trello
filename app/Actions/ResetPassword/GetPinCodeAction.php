<?php

namespace App\Actions\ResetPassword;

use App\Mail\MailResetPassword;
use App\Models\PasswordResets;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class GetPinCodeAction
{
    public function handle($params)
    {
        $user = User::where('email', $params['email'])->first();

        $pinCode = Str::random(6);

        PasswordResets::create([
            'user_id' => $user->id,
            'email' => $params['email'],
            'token' => $pinCode,
        ]);

        $dataForMail = [
            'subject' => 'Сброс пароля',
            'name' => 'Сброс пароля',
            'body' => "Добрый день!
                           Введите пожалуйста этот пинкод для дальнейшей процедуры сброса пароля: " . $pinCode
        ];

        Mail::to($params['email'])->send(new MailResetPassword($dataForMail));

        return __('mail.send');
    }
}
