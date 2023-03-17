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
    public function index(GetAllProjectAction $action, Organization $org, GetAllProjectRequest $request)
    {
        $this->authorize('can-get-all-project', [Project::class, $org]);
        return $action->handle($org, $request->validated());
    }

    public function store(ProjectStoreRequest $request, Organization $org, CreateProjectAction $action)
    {
        $this->authorize('can-create-project', [Project::class, $org]);
        return $action->handle($request->validated(), $org, Auth::user());
    }

    public function show(GetOneProjectAction $action, Organization $org, Project $project)
    {
        $this->authorize('can-read-project', [Project::class, $org, $project]);
        return $action->handle($project);
    }

    public function update(ProjectUpdateRequest $request, UpdateProjectAction $action, Organization $org, Project $project)
    {
        $this->authorize('can-update-project', [Project::class, $org]);
        return $action->handle($request->validated(), $project);
    }

    public function destroy(DeleteProjectAction $action, Organization $org, Project $project)
    {
        $this->authorize('can-delete-project', [Project::class, $org]);
        return $action->handle($project);
    }
}
