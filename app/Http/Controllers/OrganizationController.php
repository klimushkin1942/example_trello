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

    public function show(Organization $org, GetOneOrganizationAction $action)
    {
        $this->authorize('can-read-organization', [Organization::class, $org]);
        return $action->handle(Auth::user(), $org);
    }

    public function update(OrganizationUpdateRequest $request, Organization $org, UpdateOrganizationAction $action)
    {
        $this->authorize('can-update-organization', [Organization::class, $org]);
        return $action->handle(Auth::user(), $org, $request->validated());
    }

    public function destroy(Organization $org, DeleteOrganizationAction $action)
    {
        $this->authorize('can-delete-organization', [Organization::class, $org]);
        return $action->handle(Auth::user(), $org);
    }
}
