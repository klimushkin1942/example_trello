<?php

namespace App\Http\Controllers;

use App\Actions\Organizations\CreateOrganizationAction;
use App\Actions\Organizations\DeleteOrganizationAction;
use App\Actions\Organizations\GetAllOrganizationAction;
use App\Actions\Organizations\UpdateOrganizationAction;
use App\Http\Requests\OrganizationStoreRequest;
use App\Models\Organization;
use App\Models\UsersOrganizations;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $credentials = UsersOrganizations::where('user_id', $request->user_id)->get();
        $orgIds = [];
        foreach ($credentials as $credential) {
            array_push($orgIds, $credential->organization_id);
        }

        return Organization::all()->whereIn('id',$orgIds);
    }

    public function store(OrganizationStoreRequest $request)
    {
        $organization = Organization::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        UsersOrganizations::create([
            'user_id' => $request->user_id,
            'organization_id' => $organization->id
        ]);
    }

    public function show()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }
//    public function getAllOrganizations(Request $request, GetAllOrganizationAction $action)
//    {
//        return $action->handle($request->all());
//    }
//    public function createOrganization(OrganizationStoreRequest $request, CreateOrganizationAction $action)
//    {
//        $credentials = $request->all();
//        return $action->handle($credentials);
//    }
//    public function updateOrganization(OrganizationStoreRequest $request, UpdateOrganizationAction $action, $id)
//    {
//        $credentials = $request->all();
//        return $action->handle($credentials, $id);
//    }
//    public function deleteOrganization(DeleteOrganizationAction $action, $id)
//    {
//        return $action->handle($id);
//    }
}
