<?php

namespace App\Actions\Projects;

use App\Models\Project;

class UpdateProjectAction
{
    public function handle($params, $project)
    {
        return $project->update([
            'name' => $params['name'],
            'description' => $params['description']
        ]);
    }
}
