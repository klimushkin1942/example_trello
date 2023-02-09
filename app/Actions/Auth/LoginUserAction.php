<?php

namespace App\Actions\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginUserAction
{
    public function handle($data)
    {
        if (Auth::attempt($data)) {
            $data->session()->regenerate();
        }

        return response()->json([
            'status' => true,
            'message' => 'User is logged'
        ], 200);
    }
}
