<?php

namespace App\Actions\Projects;

use App\Models\Project;

class DeleteProjectAction
{
    public function handle($orgId, $projectId)
    {
        return Project::where('organization_id', $orgId)->where('id', $projectId)->delete();
    }
}
