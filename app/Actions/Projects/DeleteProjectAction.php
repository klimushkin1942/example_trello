<?php

namespace App\Actions\Projects;

use App\Models\Organization;
use App\Models\Project;

class DeleteProjectAction
{
    public function handle(Project $project)
    {
        return $project->delete();
    }
}
