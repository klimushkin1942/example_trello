<?php

namespace App\Actions\Projects;

use App\Models\Project;

class GetAllProjectAction
{
    public function handle($orgId, $credentials)
    {
        return Project::where('organization_id', $orgId)
            ->orderBy('created_at', 'asc')
            ->limit($credentials['limit'])
            ->offset($credentials['offset'])
            ->get();
    }
}
