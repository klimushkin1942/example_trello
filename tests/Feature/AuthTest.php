<?php

namespace Tests\Feature;

use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Str;

class AuthTest extends TestCase
{
    public function test_register_user()
    {
        $response = $this->post('/api/register', [
            'name' => Str::random(10),
            'email' => Str::random(10) . '@gmail.com',
            'password' => "klimushkin1942"
        ]);

        $response->assertCreated();
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
        $response->assertOk();
    }
}
