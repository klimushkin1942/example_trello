<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    public function test_register_user()
    {
        $response = $this->post('/api/register', [
            'name' => 'klimushkin',
            'email' => 'muhammed1942ali@gmail.com',
            'password' => 'klimushkin1942'
        ]);

        $response->assertOk();
    }

    public function test_login_user()
    {
        $response = $this->post('/api/login', [
            'email' => 'muhammed1942ali@gmail.com',
            'password' => 'klimushkin1942'
        ]);

        $response->assertOk();
    }

    public function test_logout_user()
    {
        $response = $this->post('/api/logout',[]);
        $response->assertRedirect();
    }
}
