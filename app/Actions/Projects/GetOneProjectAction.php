<?php

namespace App\Actions\Projects;

use App\Models\Project;

class GetOneProjectAction
{
    public function handle($orgId, $projectId)
    {
        return Project::findOrFail($projectId);
    }
}
