<?php

namespace App\Http\Controllers;

use App\Actions\Projects\CreateProjectAction;
use App\Actions\Projects\DeleteProjectAction;
use App\Actions\Projects\GetAllProjectAction;
use App\Actions\Projects\GetOneProjectAction;
use App\Actions\Projects\UpdateProjectAction;
use App\Http\Requests\Project\ProjectStoreRequest;
use App\Http\Requests\Project\ProjectUpdateRequest;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class ProjectsController extends Controller
{
    public function index(GetAllProjectAction $action, $orgId)
    {
        return $action->handle(Auth::id(), $orgId);
    }

    public function store(ProjectStoreRequest $request, $orgId, CreateProjectAction $action)
    {
        $this->authorize('can-create-project', [Project::class, $orgId]);
        return $action->handle($request->all(), $orgId);
    }

    public function show(GetOneProjectAction $action, $orgId, $projectId)
    {
        $this->authorize('can-read-project', [Project::class, $orgId]);
        return $action->handle($orgId, $projectId);
    }

    public function update(ProjectUpdateRequest $request, UpdateProjectAction $action, $orgId, $projectId)
    {
        $this->authorize('can-update-project', [Project::class, $orgId]);
        return $action->handle($orgId, $request->all(), $projectId);
    }

    public function destroy(DeleteProjectAction $action, $orgId, $projectId)
    {
        $this->authorize('can-delete-project', [Project::class, $orgId]);
        return $action->handle($orgId, $projectId);
    }
}
