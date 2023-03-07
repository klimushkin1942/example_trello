<?php

namespace App\Actions\Organizations;
use App\Models\Organization;

class DeleteUserFromOrganization
{
    public function handle($orgId, $userId)
    {
        return Organization::findOrFail($orgId)
            ->users()
            ->where('user_id', $userId)
            ->delete();
    }
}
