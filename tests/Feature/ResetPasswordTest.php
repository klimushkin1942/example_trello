<?php

namespace Tests\Feature;

use App\Models\PasswordResets;
use Tests\TestCase;

class ResetPasswordTest extends TestCase
{
    public function testPostForgotPassword()
    {
        $response = $this->post('/api/forgot_password', [
            'email' => 'muhammed1942ali@gmail.com'
        ]);
        $passwordResets = PasswordResets::where('email', 'muhammed1942ali@gmail.com')->orderBy('id', 'desc')->first();
        $this->assertDatabaseHas('password_resets', ['id' => $passwordResets->id]);
        return $response->assertStatus(200);
    }

    public function testPostSendPincode()
    {
        $passwordResets = PasswordResets::where('email', 'muhammed1942ali@gmail.com')->orderBy('id', 'desc')->first();
        $response = $this->post('/api/send_pincode', [
            'pin_code' => $passwordResets->token,
        ]);
        return $response->assertStatus(200);
    }

    public function testPostResetPassword()
    {
        $tokenUser = PasswordResets::where('email', 'muhammed1942ali@gmail.com')->first();
        $response = $this->post('/api/reset_password', [
            'pinCode' => $tokenUser->token,
            'password' => 'klimushkin1942',
            'password_confirmation' => 'klimushkin1942'
        ]);
        $response->assertStatus(200);
    }
}
