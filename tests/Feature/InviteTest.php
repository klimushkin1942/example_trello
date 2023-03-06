<?php

namespace Tests\Feature;

use App\Models\Invite;
use App\Models\Role;
use App\Models\UsersOrganizations;
use App\Models\User;
use Tests\TestCase;

class InviteTest extends TestCase
{
    public function test_post_send_invite_user()
    {
        $user = User::where('email', 'muhammed1942ali@gmail.com')->first();
        $orgId = UsersOrganizations::where('user_id', $user->id)->first()->organization_id;

        $roleId = Role::find(3)->id;

        $response = $this->actingAs($user)->post('/api/organizations/' . $orgId . '/invite/' . $roleId, [
            'email' => 'lina.vasilenko.2001@mail.ru'
        ]);

        $this->assertDatabaseHas('invites', ['organization_id' => $orgId]);

        return $response->assertStatus(200);
    }

    public function test_post_accept_invite()
    {
        $invite = Invite::where('email', 'lina.vasilenko.2001@mail.ru')->first();
        $response = $this->get('/api/accept/' . $invite->token);
        return $response->assertStatus(200);
    }

    public function test_delete_invite_user()
    {
        User::where('email', 'lina.vasilenko.2001@mail.ru')->delete();
        return $this->assertDatabaseMissing('users', ['email' => 'lina.vasilenko.2001@mail.ru']);
    }
}
