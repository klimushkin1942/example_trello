<?php

namespace Tests\Feature;

use App\Models\Organization;
use App\Models\UsersOrganizations;
use App\Models\UsersRolesOrganizations;
use http\Env\Response;
use Tests\TestCase;
use App\Models\User;

class OrganizationTest extends TestCase
{
    /**
     * @return \Illuminate\Testing\TestResponse
     */
    public function test_post_create_organization()
    {
        $user = User::where('email', 'muhammed1942ali@gmail.com')->first();

        $response = $this->actingAs($user)->post('/api/organizations', [
            'name' => 'Привет, что-то там...',
            'description' => 'Как там и что',
        ]);

        $this->assertDatabaseHas('organizations', [
            'name' => 'Привет, что-то там...',
            'description' => 'Как там и что',
        ]);

        return $response->assertStatus(200);
    }

    public function test_get_all_organizations()
    {
        $user = User::where('email', 'muhammed1942ali@gmail.com')->first();
        $response = $this->actingAs($user)->get('/api/organizations', []);
        return $response->assertStatus(200);
    }

    public function test_get_one_organization()
    {
        $user = User::where('email', 'muhammed1942ali@gmail.com')->first();
        $organization = UsersOrganizations::where('user_id', $user->id)->first();

        $response = $this->actingAs($user)->get('/api/organizations/' . $organization->organization_id, []);

        $this->assertDatabaseHas('organizations',['id' => $organization->id]);
        return $response->assertStatus(200);
    }

    public function test_put_update_organization()
    {

        $user = User::where('email', 'muhammed1942ali@gmail.com')->first();
        $organization = UsersOrganizations::where('user_id', $user->id)->first();
        $response = $this->actingAs($user)->put('/api/organizations/' . $organization->organization_id, [
            'name' => 'Саламуля, ребята',
            'description' => 'Биба и Боба',
        ]);

        $this->assertDatabaseHas('organizations', [
            'id' => $organization->organization_id,
            'name' => 'Саламуля, ребята',
            'description' => 'Биба и Боба'
        ]);

        return $response->assertStatus(200);
    }

    public function test_delete_organization()
    {
        $orgId = UsersRolesOrganizations::first()->organization_id;
        $user = User::where('email', 'muhammed1942ali@gmail.com')->first();
        $response = $this->actingAs($user)->delete('/api/organizations/' . $orgId);

        $response->assertStatus(200);
        return $this->assertDatabaseMissing('organizations', ['id' => $orgId]);
    }
}
