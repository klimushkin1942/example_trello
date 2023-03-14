<?php

namespace App\Actions\Users;
use App\Models\User;
use App\Models\Organization;
class GetOneUserAction
{
    public function handle($orgId, $userId)
    {
        return Organization::findOrFail($orgId)
            ->users()
            ->findOrFail($userId);
    }
}
