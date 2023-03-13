<?php

namespace App\Http\Controllers;

use App\Actions\Desks\CreateDeskAction;
use App\Actions\Desks\DeleteDeskAction;
use App\Actions\Desks\GetDeskAction;
use App\Models\Desk;
use Illuminate\Http\Request;

class DeskController extends Controller
{
    public function index()
    {
        return 1;
    }

    public function store(CreateDeskAction $action, $orgId, $projectId, Request $request)
    {
        $this->authorize('can-create-desk', [Desk::class, $orgId, $projectId]);
        return $action->handle($projectId, $request->desk_template_id);
    }

    public function show(GetDeskAction $action, $orgId, $projectId, $deskId)
    {
        $this->authorize('can-read-desk', [Desk::class, $orgId, $projectId]);
        return $action->handle($deskId);
    }

    public function update()
    {
        return 4;
    }

    public function destroy(DeleteDeskAction $action, $orgId, $projectId, $deskId)
    {
        $this->authorize('can-delete-desk', [Desk::class, $orgId, $projectId]);
        return $action->handle($deskId);
    }
}
