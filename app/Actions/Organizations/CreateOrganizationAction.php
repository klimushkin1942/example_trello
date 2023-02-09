<?php

namespace App\Actions\Organizations;

use App\Models\Organization;
use Illuminate\Support\Facades\Validator;

class CreateOrganizationAction
{
    public function handle($data)
    {
        try {
            $validateOrganization = Validator::make($data->all(),
                [
                    'name' => 'required|string|min:6',
                    'description' => 'required|string|max:255',
                    'user_id' => 'required'
                ]);

            if ($validateOrganization->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation error',
                    'errors' => $validateOrganization->errors()
                ], 401);
            }

            Organization::create([
                'name' => $data->name,
                'description' => $data->description,
                'user_id' => $data->user_id
            ]);

//            $adminRole = Role::where('slug', 'admin-user');
//            $createOrganization = Permission::where('slug', 'create-organizations');
//            $user = User::query()->where('id', $request->user_id)->get();
//
//            $user->with('roles')->attach($adminRole);
//            $user->with("permissions")->attach($createOrganization);
//
//            UserRoleOrganization::create([
//                'organization_id' => $organization->id,
//                'user_id' => $request->user_id,
//                'role_id' => $adminRole->id
//            ]);

            return response()->json([
                'status' => true,
                'message' => 'Organization created',
            ], 201);

        } catch (\Throwable $throwable) {
            return response()->json([
                'status' => false,
                'message' => $throwable->getMessage(),
            ], 500);
        }
    }
}
