<?php

namespace Tests\Feature;

use App\Models\Organization;
use http\Env\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class OrganizationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_post_create_organization()
    {
        $user = User::where('email', 'muhammed1942ali@gmail.com')->first();
        $response = $this->actingAs($user)->post('/api/organizations', [
            'name' => 'Привет, что-то там...',
            'description' => 'Как там и что',
            'user_id' => '1'
        ]);
        return $response->assertCreated();
    }

    public function test_get_all_organizations()
    {
        $user = User::where('email', 'muhammed1942ali@gmail.com')->first();
        $response = $this->actingAs($user)->get('/api/organizations', []);
        $response->assertOk();
    }

    public function test_get_one_organization()
    {
        $orgId = '1';
        $user = User::where('email', 'muhammed1942ali@gmail.com')->first();
        $response = $this->actingAs($user)->get('/api/organizations/' . $orgId, []);

        $response->assertOk();
    }


    public function test_put_update_organization()
    {
        $orgId = '2';
        $user = User::where('email', 'muhammed1942ali@gmail.com')->first();

        $response = $this->actingAs($user)->put('/api/organizations/' . $orgId, [
            'name' => 'Саламуля, ребята',
            'description' => 'Биба и Боба',
        ]);

        return $response->assertOk();
    }

    public function test_delete_organization()
    {
        $orgId = '1';
        $user = User::where('email', 'muhammed1942ali@gmail.com')->first();
        $response = $this->actingAs($user)->delete('/api/organizations/' . $orgId, []);

        return $response->assertOk();
    }
}
