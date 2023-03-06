<?php

namespace App\Actions\Invites;
use App\Models\Organization;
use App\Models\UsersOrganizations;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Invite;
use Illuminate\Support\Facades\Mail;
use App\Mail\Invites\MailInviteOrganization;
use App\Models\UsersRolesOrganizations;
class SendInviteOrganizationAction
{
    public function handle($credentials, $orgId, $roleId)
    {
        $organization = Organization::findOrFail($orgId);
        $token = Str::random(10);

        $user = User::create([
            'name' => 'default',
            'email' => $credentials['email'],
            'password' => 'password'
        ]);

        UsersOrganizations::create([
            'user_id' => $user->id,
            'organization_id' => $orgId
        ]);

        UsersRolesOrganizations::create([
            'user_id' => $user->id,
            'organization_id' => $orgId,
            'role_id' => $roleId
        ]);

        $dataForMail = [
            'subject' => 'Приглашение',
            'name' => 'Приглашение',
            'url'  => config("app.url") . "/api/accept/" . $token,
            'body' => 'Организация ' . "\"" . $organization->name . "\"" . "ждёт Вас",
        ];

        Invite::create([
            'email' => $credentials['email'],
            'token' => $token,
            'organization_id' => $organization->id
        ]);

        return Mail::to($credentials['email'])->send(new MailInviteOrganization($dataForMail));
    }
}
