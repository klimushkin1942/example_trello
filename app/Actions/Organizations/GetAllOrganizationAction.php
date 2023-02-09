<?php

namespace App\Actions\Organizations;

use App\Models\Organization;

class GetAllOrganizationAction
{
    public function handle($data)
    {
        try {
            $organizations = Organization::all()->where('user_id', $data->user_id);
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
}
