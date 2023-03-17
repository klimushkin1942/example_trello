<?php

namespace App\Http\Controllers;

use App\Actions\Tasks\CreateTaskAction;
use App\Actions\Tasks\DeleteTaskAction;
use App\Actions\Tasks\UpdateTaskAction;
use App\Http\Requests\Desks\Tasks\TaskStoreRequest;
use App\Http\Requests\Desks\Tasks\TaskUpdateRequest;
use App\Models\DeskColumn;
use App\Models\Organization;
use App\Models\Project;
use App\Models\Desk;
use App\Models\Task;

class TaskController extends Controller
{
    public function store(CreateTaskAction $action, Organization $org, Project $project, Desk $desk,
                          DeskColumn $column, TaskStoreRequest $request)
    {
        $this->authorize('can-create-task', [Task::class, $org, $project]);
        return $action->handle($desk, $column, $request->validated());
    }

    public function update(UpdateTaskAction $action, Organization $org, Project $project, Desk $desk,
                           DeskColumn $column, Task $task, TaskUpdateRequest $request)
    {
        $this->authorize('can-update-task', [Task::class, $org, $project]);
        return $action->handle($task, $request->validated());
    }

    public function destroy(DeleteTaskAction $action, Organization $org, Project $project, Desk $desk, DeskColumn $column, Task $task)
    {
        $this->authorize('can-delete-task', [Task::class, $org, $project]);
        return $action->handle($task);
    }
}
