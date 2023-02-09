<?php

namespace App\Actions\ResetPassword;

use App\Models\PasswordResets;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class SendPinCodeAction
{
    public function handle($data)
    {
        if (!PasswordResets::query()
            ->where('token', Hash::make($data->pincode))) {
            return response()->json([
                'status' => false,
                'message' => 'Error, this pincode not exist'
            ], 400);
        }

        $passwordResetUser = PasswordResets::query()
            ->where('token', Hash::make($data->pincode));

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
}
