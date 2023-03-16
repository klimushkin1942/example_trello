<?php

namespace App\Actions\Invites;
use App\Models\Organization;
use App\Models\Project;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\UsersRolesProjects;
use App\Models\Invite;
use Illuminate\Support\Facades\Mail;
use App\Mail\Invites\MailInviteProject;

class SendInviteProjectAction
{
    public function handle($params, Organization $org, Project $project, $projectRoleId)
    {
        $user = User::where('email', $params['email'])->firstOrFail();
        $token = Str::random(10);

        UsersRolesProjects::create([
            'user_id' => $user->id,
            'project_id' => $project->id,
            'organization_id' => $org->id,
            'role_id' => $projectRoleId
        ]);

        $dataForMail = [
            'subject' => 'Приглашение',
            'name' => 'Приглашение',
            'body' => 'Организация ' . "\"" . $org->name . "\"" .
                "приглашает Вас в проект: " . "\"" . $project->name . "\"",
        ];

        Invite::create([
            'email' => $params['email'],
            'token' => $token,
            'organization_id' => $org->id
        ]);

        return Mail::to($params['email'])->send(new MailInviteProject($dataForMail));
    }
}
