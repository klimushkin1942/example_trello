<?php

namespace App\Http\Controllers;

use App\Actions\Organizations\CreateOrganizationAction;
use App\Actions\Organizations\DeleteOrganizationAction;
use App\Actions\Organizations\GetAllOrganizationAction;
use App\Actions\Organizations\UpdateOrganizationAction;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getAllOrganizations(Request $request, GetAllOrganizationAction $action)
    {
        return $action->handle($request);
    }
    public function createOrganization(Request $request, CreateOrganizationAction $action)
    {
        return $action->handle($request);
    }
    public function updateOrganization(Request $request, UpdateOrganizationAction $action, $id)
    {
        return $action->handle($request, $id);
    }
    public function deleteOrganization(DeleteOrganizationAction $action, $id)
    {
        return $action->handle($id);
    }
}
