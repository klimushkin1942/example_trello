<?php

namespace App\Actions\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterUserAction
{
    public function handle($credentials)
    {
        $user = User::create([
            'name' => $credentials->name,
            'email' => $credentials->email,
            'password' => User::setPasswordAttribute($credentials->password)
        ]);

        return response()->json([
            'status' => true,
            'message' => 'User created',
            'token' => $user->createToken('auth_token')->plainText
        ], 200);
    }
}
