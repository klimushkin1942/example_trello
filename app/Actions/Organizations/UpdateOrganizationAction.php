<?php

namespace App\Actions\Organizations;

use App\Models\Organization;
use Illuminate\Support\Facades\Validator;

class UpdateOrganizationAction
{
    public function handle($data, $id)
    {
        try {
            $input = $data->all();
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
            $organization->name = $data->name;
            $organization->description = $data->description;
            $organization->user_id = $data->user_id;

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
}
