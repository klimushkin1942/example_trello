<?php

namespace App\Actions\Auth;

use Illuminate\Support\Facades\Auth;

class LogoutUserAction
{
    public function handle($data)
    {
        Auth::logout();
        $data->session()->invalidate();
        $data->session()->regenerateToken();
        return redirect('/');
    }
}
