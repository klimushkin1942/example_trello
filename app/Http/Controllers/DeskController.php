<?php

namespace App\Http\Controllers;

use App\Actions\Desks\CreateDeskAction;
use App\Actions\Desks\DeleteDeskAction;
use App\Actions\Desks\GetDeskAction;
use App\Models\Desk;
use App\Models\Organization;
use App\Models\Project;
use Illuminate\Http\Request;

class DeskController extends Controller
{
    public function store(CreateDeskAction $action, Organization $org, Project $project, Request $request)
    {
        $this->authorize('can-create-desk', [Desk::class, $org, $project]);
        return $action->handle($project, $request->desk_template_id);
    }

    public function show(GetDeskAction $action, Organization $org, Project $project, Desk $desk)
    {
        $this->authorize('can-read-desk', [Desk::class, $org, $project]);
        return $action->handle($desk);
    }
    public function destroy(DeleteDeskAction $action, Organization $org, Project $project, Desk $desk)
    {
        $this->authorize('can-delete-desk', [Desk::class, $org, $project]);
        return $action->handle($desk);
    }
}
