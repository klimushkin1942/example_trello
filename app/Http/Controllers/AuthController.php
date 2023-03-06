<?php

namespace App\Http\Controllers;

use App\Actions\Auth\LoginUserAction;
use App\Actions\Auth\LogoutUserAction;
use App\Actions\Auth\RegisterUserAction;
use App\Http\Requests\Auth\AuthLoginRequest;
use App\Http\Requests\Auth\AuthRegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * @param AuthRegisterRequest $request
     * @param RegisterUserAction $action
     * @return mixed
     */
    public function registerUser(AuthRegisterRequest $request, RegisterUserAction $action)
    {
        return $action->handle($request->all());
    }

    /**
     * @param AuthLoginRequest $request
     * @param LoginUserAction $action
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function loginUser(AuthLoginRequest $request, LoginUserAction $action)
    {
        $user = User::where('email', $request->email)->first();
        return $action->handle($user, $request->password);
    }

    /**
     * @param Request $request
     * @return string
     */
    public function logoutUser(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return __('auth.logout');
    }
}
