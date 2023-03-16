<?php

namespace App\Actions\Projects;

use App\Models\Project;

class UpdateProjectAction
{
    public function handle($params, Project $project)
    {
        return $project->update([
            'name' => $params['name'],
            'description' => $params['description']
        ]);
    }
}
