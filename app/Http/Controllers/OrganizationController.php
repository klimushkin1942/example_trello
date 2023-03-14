<?php

namespace App\Http\Controllers;

use App\Actions\Organizations\CreateOrganizationAction;
use App\Actions\Organizations\DeleteOrganizationAction;
use App\Actions\Organizations\GetAllOrganizationAction;
use App\Actions\Organizations\GetOneOrganizationAction;
use App\Actions\Organizations\UpdateOrganizationAction;
use App\Http\Requests\Organization\GetAllOrganizationRequest;
use App\Http\Requests\Organization\OrganizationStoreRequest;
use App\Http\Requests\Organization\OrganizationUpdateRequest;
use App\Models\Organization;
use Illuminate\Support\Facades\Auth;

class OrganizationController extends Controller
{
    public function index(GetAllOrganizationAction $action, GetAllOrganizationRequest $request)
    {
        return $action->handle(Auth::user(), $request->validated());
    }

    public function store(OrganizationStoreRequest $request, CreateOrganizationAction $action)
    {
        return $action->handle(Auth::user(), $request->validated());
    }

    public function show($orgId, GetOneOrganizationAction $action)
    {
        $this->authorize('can-read-organization', [Organization::class, $orgId]);
        return $action->handle(Auth::user(), $orgId);
    }

    public function update(OrganizationUpdateRequest $request, $orgId, UpdateOrganizationAction $action)
    {
        $this->authorize('can-update-organization', [Organization::class, $orgId]);
        return $action->handle(Auth::user(), $orgId, $request->validated());
    }

    public function destroy($orgId, DeleteOrganizationAction $action)
    {
        $this->authorize('can-delete-organization', [Organization::class, $orgId]);
        return $action->handle(Auth::user(), $orgId);
    }
}
