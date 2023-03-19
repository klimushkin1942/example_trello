<?php

namespace Tests\Feature;

use Illuminate\Support\Str;
use Tests\TestCase;
use App\Models\User;
use App\Models\UsersOrganizations;

class UserTest extends TestCase
{
    public function testGetAllUsers()
    {
        $user = User::where('email', 'muhammed1942ali@gmail.com')->first();

        $userInCompany = User::create([
            'name' => 'testUserForCompany',
            'password' => 'klimushkin1942',
            'email'  => Str::random(6) . '@gmail.com'
        ]);

        $orgId = UsersOrganizations::where('user_id', $user->id)->first()->id;

        UsersOrganizations::create([
            'user_id' => $userInCompany->id,
            'organization_id' => $orgId
        ]);

        $response = $this->actingAs($user)->get('/api/organizations/' . $orgId . '/users?limit=5&offset=0');
        return $response->assertStatus(200);
    }

    public function testGetOneUsers()
    {
        $user = User::where('email', 'muhammed1942ali@gmail.com')->first();
        $userCompanyId = User::where('name', 'testUserForCompany')->first()->id;
        $orgId = UsersOrganizations::where('user_id', $user->id)->first()->id;
        $response = $this->actingAs($user)->get('/api/organizations/' . $orgId . '/users/' . $userCompanyId);
        return $response->assertStatus(200);
    }

    public function testDeleteUserFromOrganization()
    {
        $user = User::where('email', 'muhammed1942ali@gmail.com')->first();
        $userCompany = User::where('name', 'testUserForCompany')->first();
        $orgId = UsersOrganizations::where('user_id', $user->id)->first()->id;
        $response = $this->actingAs($user)->delete('/api/organizations/' . $orgId . '/users/' . $userCompany->id);
        $userCompany->delete();
        return $response->assertStatus(200);
    }
}
