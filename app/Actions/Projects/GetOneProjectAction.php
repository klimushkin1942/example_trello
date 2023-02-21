<?php

namespace App\Actions\Projects;

use App\Models\Project;

class GetOneProjectAction
{
    public function handle($orgId, $projectId)
    {
        return Project::where('organization_id', $orgId)->where('id', $projectId)->first();
    }
}
