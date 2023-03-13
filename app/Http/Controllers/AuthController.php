<?php

namespace App\Http\Controllers;
use App\Actions\Auth\LoginUserAction;
use App\Actions\Auth\LogoutUserAction;
use App\Actions\Auth\RegisterUserAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AuthRegisterRequest;
use App\Http\Requests\AuthLoginRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use function PHPUnit\Framework\matches;

class AuthController extends Controller
{
    /**
     * @param AuthRegisterRequest $request
     * @param RegisterUserAction $action
     * @return mixed
     */
    public function registerUser (AuthRegisterRequest $request, RegisterUserAction $action) {
        return $action->handle($request->all());
    }

    /**
     * @param AuthLoginRequest $request
     * @param LoginUserAction $action
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function loginUser (AuthLoginRequest $request, LoginUserAction $action) {
        $user = User::where('email', $request->email)->first();
        if (Hash::check($request->password, $user->password)) {
            return $action->handle($user);
        }
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
        return __('User is logout');
    }
}
