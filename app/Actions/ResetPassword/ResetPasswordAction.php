<?php

namespace App\Actions\ResetPassword;

use App\Models\PasswordResets;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class ResetPasswordAction
{
    public function handle($data)
    {
        try {
            $passwordResetUser = PasswordResets::query()
                ->where('token', $data->pincode)
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

            if ($data->newPassword != $data->confirmPassword) {
                return response()->json([
                    'status' => false,
                    'message' => 'Password not equals confirm password'
                ], 403);
            }

            $user->update([
                'password' => Hash::make($data->newPassword)
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
