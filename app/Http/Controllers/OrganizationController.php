<?php

namespace App\Http\Controllers;

use App\Actions\Organizations\CreateOrganizationAction;
use App\Actions\Organizations\DeleteOrganizationAction;
use App\Actions\Organizations\GetAllOrganizationAction;
use App\Actions\Organizations\GetOneOrganizationAction;
use App\Actions\Organizations\UpdateOrganizationAction;
use App\Http\Requests\Organization\OrganizationStoreRequest;
use App\Http\Requests\Organization\OrganizationUpdateRequest;
use Illuminate\Support\Facades\Auth;

class OrganizationController extends Controller
{
    public function index(GetAllOrganizationAction $action)
    {
        return $action->handle(Auth::id());
    }

    public function store(OrganizationStoreRequest $request, CreateOrganizationAction $action)
    {
        return $action->handle(Auth::id(), $request->all());
    }

    public function show($orgId, GetOneOrganizationAction $action)
    {
        return $action->handle(Auth::id(), $orgId);
    }

    public function update(OrganizationUpdateRequest $request, $orgId, UpdateOrganizationAction $action)
    {
        $this->authorize('can-update-organization', [self::class, $orgId]);
        return $action->handle(Auth::id(), $orgId, $request->all());
    }

    public function destroy($orgId, DeleteOrganizationAction $action)
    {
        $this->authorize('can-delete-organization', [self::class, $orgId]);
        return $action->handle(Auth::id(), $orgId);
    }
}
