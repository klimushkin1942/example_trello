<?php

namespace App\Actions\Organizations;

use App\Models\Organization;

class DeleteOrganizationAction
{
    public function handle($id)
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
