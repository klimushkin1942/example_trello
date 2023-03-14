<?php

namespace App\Http\Controllers;

use App\Actions\Projects\CreateProjectAction;
use App\Actions\Projects\DeleteProjectAction;
use App\Actions\Projects\GetAllProjectAction;
use App\Actions\Projects\GetOneProjectAction;
use App\Actions\Projects\UpdateProjectAction;
use App\Http\Requests\Project\GetAllProjectRequest;
use App\Http\Requests\Project\ProjectStoreRequest;
use App\Http\Requests\Project\ProjectUpdateRequest;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use App\Models\Organization;
class ProjectsController extends Controller
{
    public function index(GetAllProjectAction $action, $orgId, GetAllProjectRequest $request)
    {
        $this->authorize('can-get-all-project', [Project::class, $orgId]);
        return $action->handle(Organization::findOrFail($orgId), $request->validated());
    }

    public function store(ProjectStoreRequest $request, $orgId, CreateProjectAction $action)
    {
        $this->authorize('can-create-project', [Project::class, $orgId]);
        return $action->handle($request->validated(), Organization::findOrFail($orgId), Auth::user());
    }

    public function show(GetOneProjectAction $action, $orgId, $projectId)
    {
        $this->authorize('can-read-project', [Project::class, $orgId, $projectId]);
        return $action->handle($projectId);
    }

    public function update(ProjectUpdateRequest $request, UpdateProjectAction $action, $orgId, $projectId)
    {
        $this->authorize('can-update-project', [Project::class, $orgId]);
        return $action->handle($request->validated(), Project::findOrFail($projectId));
    }

    public function destroy(DeleteProjectAction $action, $orgId, $projectId)
    {
        $this->authorize('can-delete-project', [Project::class, $orgId]);
        return $action->handle(Organization::findOrFail($orgId), Project::where('organization_id', $orgId)->findOrFail($projectId));
    }
}