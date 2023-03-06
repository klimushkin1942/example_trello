<?php

namespace App\Actions\Projects;

use App\Enums\RoleTypes;
use App\Models\Organization;
use App\Models\Project;
use App\Models\User;
use App\Models\UsersRolesProjects;

class CreateProjectAction
{
    public function handle($credentials, $orgId, $userId)
    {
        $organization = Organization::findOrFail($orgId);
        $user = User::findOrFail($userId);
        $project = Project::create([
            'organization_id' => $organization->id,
            'name' => $credentials['name'],
            'description' => $credentials['description']
        ]);

        return UsersRolesProjects::create([
            'organization_id' => $orgId,
            'user_id' => $userId,
            'project_id' => $project->id,
            'role_id' => RoleTypes::ADMIN->value
        ]);
    }
}
