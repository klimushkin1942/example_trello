<?php

namespace App\Actions\Users;
use App\Models\User;
use App\Models\Organization;
class DeleteUserAction
{
    public function handle($orgId, $userId)
    {
        return Organization::findOrFail($orgId)
            ->users()
            ->where('user_id', $userId)
            ->delete();
    }
}
