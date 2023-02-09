<?php

namespace App\Http\Controllers;

use App\Actions\Auth\LoginUserAction;
use App\Actions\Auth\LogoutUserAction;
use App\Actions\Auth\RegisterUserAction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function registerUser(Request $request, RegisterUserAction $action)
    {
        $credentials = request()->validate(
            [
                'name' => 'required|min:8',
                'email' => 'required|email|unique',
                'password' => 'required|min:8'
            ]);

        return $action->handle($credentials);
    }

    public function loginUser(Request $request, LoginUserAction $action)
    {
        $credentials = request()->validate(
            [
                'email' => 'required|email',
                'password' => 'required|min:8'
            ]);

        return $action->handle($credentials);
    }


    public function logoutUser(Request $request, LogoutUserAction $action)
    {
        return $action->handle($request);
    }
}
