<?php

namespace App\Actions\Projects;

use App\Models\Project;

class GetAllProjectAction
{
    public function handle($userId, $orgId)
    {
        return Project::where('organization_id', $orgId)
            ->orderBy('created_at', 'asc')
            ->limit(5)
            ->offset(0)
            ->get();
    }
}
