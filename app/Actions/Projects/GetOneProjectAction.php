<?php

namespace App\Actions\Projects;

use App\Models\Project;

class GetOneProjectAction
{
    public function handle(Project $project)
    {
        return Project::findOrFail($project->id);
    }
}
