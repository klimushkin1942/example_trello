<?php

namespace App\Actions\Projects;

use App\Models\Organization;
use App\Models\Project;

class GetAllProjectAction
{
    public function handle(Organization $organization, $params)
    {
        return Project::where('organization_id', $organization->id)
            ->orderBy('created_at', 'asc')
            ->limit($params['limit'])
            ->offset($params['offset'])
            ->get();
    }
}
