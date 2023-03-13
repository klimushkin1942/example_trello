<?php

namespace App\Http\Controllers;

use App\Actions\Desks\DesksColumn\CreateDeskColumnAction;
use App\Actions\Desks\DesksColumn\DeleteDeskColumnAction;
use App\Actions\Desks\DesksColumn\UpdateDeskColumnAction;
use App\Http\Requests\Desks\Columns\DeskColumnUpdateRequest;
use App\Models\DeskColumn;
use Illuminate\Http\Request;

class DeskColumnController extends Controller
{
    public function store(CreateDeskColumnAction $action, $orgId, $projectId, $deskId)
    {
        $this->authorize('can-create-column', [DeskColumn::class, $orgId, $projectId]);
        return $action->handle($deskId);
    }

    public function update(UpdateDeskColumnAction $action, $orgId, $projectId, $deskId, $deskColumnId, DeskColumnUpdateRequest $request)
    {
        $this->authorize('can-update-column', [DeskColumn::class, $orgId, $projectId]);
        return $action->handle($deskId, $deskColumnId, $request->validated());
    }
    public function destroy(DeleteDeskColumnAction $action, $orgId, $projectId, $deskId, $deskColumnId)
    {
        $this->authorize('can-delete-column', [DeskColumn::class, $orgId, $projectId]);
        return $action->handle($deskId, $deskColumnId);
    }
}
