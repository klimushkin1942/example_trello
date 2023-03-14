<?php

namespace App\Actions\Projects;

use App\Models\Organization;
use App\Models\Project;

class DeleteProjectAction
{
    public function handle(Organization $organization, Project $project)
    {
        return $project->delete();
    }
}
