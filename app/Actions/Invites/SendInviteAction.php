<?php

namespace App\Actions\Invites;
use App\Models\Invite;
use App\Models\Organization;
use App\Models\UsersRolesOrganizations;
use Illuminate\Support\Str;
use App\Models\User;
use App\Mail\MailInvite;
use Illuminate\Support\Facades\Mail;
class SendInviteAction
{
    public function handle($credentials, $orgId, $roleId)
    {
        $organization = Organization::findOrFail($orgId);
        $token = Str::random(10);

        $user = User::create([
            'email' => $credentials['email'],
            'name' => 'default',
            'password' => 'password',
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

        return Mail::to($credentials['email'])->send(new MailInvite($dataForMail));
    }

}
