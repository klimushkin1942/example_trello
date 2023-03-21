<?php

namespace App\Http\Controllers;

use App\Actions\Desks\DesksColumn\CreateDeskColumnAction;
use App\Actions\Desks\DesksColumn\DeleteDeskColumnAction;
use App\Actions\Desks\DesksColumn\UpdateDeskColumnAction;
use App\Http\Requests\Desks\Columns\DeskColumnUpdateRequest;
use App\Models\Desk;
use App\Models\DeskColumn;
use App\Models\Organization;
use App\Models\Project;
use Illuminate\Http\Request;

class DeskColumnController extends Controller
{
    public function store(CreateDeskColumnAction $action, Organization $org, Project $project, Desk $desk)
    {
        $this->authorize('can-create-column', [DeskColumn::class, $org, $project]);
        return $action->handle($desk);
    }

    public function update(UpdateDeskColumnAction $action, Organization $org, Project $project, Desk $desk, DeskColumn $column, DeskColumnUpdateRequest $request)
    {
        $this->authorize('can-update-column', [DeskColumn::class, $org, $project]);
        return $action->handle($column, $request->validated());
    }
    public function destroy(DeleteDeskColumnAction $action, Organization $org, Project $project, Desk $desk, DeskColumn $column)
    {
        $this->authorize('can-delete-column', [DeskColumn::class, $org, $project]);
        return $action->handle($column);
    }
}
