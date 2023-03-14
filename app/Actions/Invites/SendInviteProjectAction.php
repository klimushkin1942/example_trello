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
    public function handle($params, $orgId, $projectId, $projectRoleId)
    {
        $organization = Organization::findOrFail($orgId);
        $user = User::where('email', $params['email'])->firstOrFail();
        $project = Project::findOrFail($projectId);
        $token = Str::random(10);

        UsersRolesProjects::create([
            'user_id' => $user->id,
            'project_id' => $projectId,
            'organization_id' => $orgId,
            'role_id' => $projectRoleId
        ]);

        $dataForMail = [
            'subject' => 'Приглашение',
            'name' => 'Приглашение',
            'body' => 'Организация ' . "\"" . $organization->name . "\"" .
                "приглашает Вас в проект: " . "\"" . $project->name . "\"",
        ];

        Invite::create([
            'email' => $params['email'],
            'token' => $token,
            'organization_id' => $organization->id
        ]);

        return Mail::to($params['email'])->send(new MailInviteProject($dataForMail));
    }
}
