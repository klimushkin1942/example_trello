<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function getAllOrganizations(Request $request)
    {
        try {
            $organizations = Organization::all()->where('user_id', $request->user_id);
            return response()->json([
                'status' => true,
                'message' => 'Get all organizations success',
                'organizations' => $organizations
            ], 200);
        } catch (\Throwable $throwable) {
            return response()->json([
                'status' => false,
                'message' => $throwable->getMessage()
            ], 500);
        }
    }
    public function createOrganization(Request $request)
    {
        try {
            $validateOrganization = Validator::make($request->all(),
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
                'name' => $request->name,
                'description' => $request->description,
                'user_id' => $request->user_id
            ]);

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
    public function updateOrganization(Request $request, $id)
    {
        try {
            $input = $request->all();
            $validator = Validator::make($input, [
                'name' => 'required|string|min:6',
                'description' => 'required|string|max:255'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation error',
                    'errors' => $validator->errors()
                ], 401);
            }

            $organization = Organization::find($id);
            $organization->name = $request->name;
            $organization->description = $request->description;
            $organization->user_id = $request->user_id;

            $organization->save();

            return response()->json([
                'status' => true,
                'message' => 'Organization was updated',
            ], 200);

        } catch (\Throwable $throwable) {
            return response()->json([
                'status' => false,
                'message' => $throwable->getMessage()
            ], 400);
        }

    }

    public function deleteOrganization($id)
    {
        try {
            $organization = Organization::find($id);
            $organization->delete();
            return response()->json([
                'status' => true,
                'message' => 'Organization deleted'
            ], 200);
        } catch (\Throwable $throwable) {
            return response()->json([
                'status' => false,
                'message' => $throwable->getMessage()
            ], 400);
        }
    }
}
