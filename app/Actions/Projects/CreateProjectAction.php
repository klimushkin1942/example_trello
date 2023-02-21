<?php

namespace App\Actions\Projects;

use App\Models\Organization;
use App\Models\Project;

class CreateProjectAction
{
    public function handle($credentials, $orgId)
    {
        $organization = Organization::find($orgId);

        return Project::create([
            'organization_id' => $organization->id,
            'name' => $credentials['name'],
            'description' => $credentials['description']
        ]);
    }
}
