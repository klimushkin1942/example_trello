<?php

namespace App\Actions\Projects;

use App\Models\Project;

class UpdateProjectAction
{
    public function handle($orgId, $credentials, $projectId)
    {
        return Project::where('organization_id', $orgId)->where('id', $projectId)->update([
            'name' => $credentials['name'],
            'description' => $credentials['description']
        ]);
    }
}
