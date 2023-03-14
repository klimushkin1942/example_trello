<?php

namespace App\Actions\Projects;

use App\Models\Project;

class GetOneProjectAction
{
    public function handle($projectId)
    {
        return Project::findOrFail($projectId);
    }
}
