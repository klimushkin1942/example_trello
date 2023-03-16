<?php

namespace Tests\Feature;

use App\Models\Organization;
use App\Models\UsersOrganizations;
use App\Models\UsersRolesOrganizations;
use http\Env\Response;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;
use App\Models\User;

class OrganizationTest extends TestCase
{
    /**
     * @return \Illuminate\Testing\TestResponse
     */
    public function testPostCreateOrganization()
    {
        $user = User::where('email', 'muhammed1942ali@gmail.com')->first();

        $response = $this->actingAs($user)->post('/api/organizations', [
            'name' => 'Созданная',
            'description' => 'Как там и что',
        ]);

        $this->assertDatabaseHas('organizations', [
            'name' => 'Созданная',
            'description' => 'Как там и что',
        ]);

        return $response->assertStatus(201);
    }

    public function testGetAllOrganizations()
    {
        $user = User::where('email', 'muhammed1942ali@gmail.com')->first();
        $response = $this->actingAs($user)->json('GET', '/api/organizations', ['limit' => 5, 'offset' => 0]);
        return $response->assertStatus(200);
    }

    public function testGetOneOrganization()
    {
        $user = User::where('email', 'muhammed1942ali@gmail.com')->first();
        $organization = UsersOrganizations::where('user_id', $user->id)->first();

        $response = $this->actingAs($user)->get('/api/organizations/' . $organization->organization_id);

        $this->assertDatabaseHas('organizations',['id' => $organization->id]);
        return $response->assertStatus(200);
    }

    public function testPutUpdateOrganization()
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

    public function testDeleteOrganization()
    {
        $orgId = UsersRolesOrganizations::first()->organization_id;
        $user = User::where('email', 'muhammed1942ali@gmail.com')->first();
        $response = $this->actingAs($user)->delete('/api/organizations/' . $orgId);

        $response->assertStatus(200);
        return $this->assertDatabaseMissing('organizations', ['id' => $orgId]);
    }
}
