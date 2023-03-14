<?php

namespace App\Actions\Projects;

use App\Enums\RoleTypes;
use App\Models\Organization;
use App\Models\Project;
use App\Models\User;
use App\Models\UsersRolesProjects;

class CreateProjectAction
{
    public function handle($params, Organization $organization, User $user)
    {
        $project = Project::create([
            'organization_id' => $organization->id,
            'name' => $params['name'],
            'description' => $params['description']
        ]);

        return UsersRolesProjects::create([
            'organization_id' => $organization->id,
            'user_id' => $user->id,
            'project_id' => $project->id,
            'role_id' => RoleTypes::ADMIN->value
        ]);
    }
}
