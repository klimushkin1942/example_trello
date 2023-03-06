<?php

namespace App\Actions\Projects;

use App\Models\Project;

class GetAllProjectAction
{
    public function handle($orgId, $limit, $offset)
    {
        return Project::where('organization_id', $orgId)
            ->orderBy('created_at', 'asc')
            ->limit($limit)
            ->offset($offset)
            ->get();
    }
}
