<?php

namespace Tests\Feature;

use App\Models\PasswordResets;
use Illuminate\Auth\Notifications\ResetPassword;
use Tests\TestCase;
use function PHPUnit\Framework\assertTrue;

class ResetPasswordTest extends TestCase
{
    public function test_post_forgot_password()
    {
        $response = $this->post('/api/forgot_password', [
            'email' => 'muhammed1942ali@gmail.com'
        ]);

        $passwordResets = PasswordResets::where('email', 'muhammed1942ali@gmail.com')->orderBy('id', 'desc')->first();
        $this->assertDatabaseHas('password_resets', ['id' => $passwordResets->id]);
        return $response->assertStatus(200);
    }

    public function test_post_send_pincode()
    {
        $passwordResets = PasswordResets::where('email', 'muhammed1942ali@gmail.com')->orderBy('id', 'desc')->first();
        $response = $this->post('/api/send_pincode', [
            'pincode' => $passwordResets->token,
        ]);
        return $response->assertStatus(200);
    }

    public function test_post_reset_password()
    {
        $response = $this->post('/api/reset_password', [
            'password' => 'klimushkin1942',
            'password_confirmation' => 'klimushkin1942'
        ]);

        $response->assertStatus(200);
    }
}
