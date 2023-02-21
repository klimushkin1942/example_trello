<?php

namespace App\Actions\Organizations;

use App\Models\User;

class GetOneOrganizationAction
{
    public function handle($userId, $id)
    {
        return User::find($userId)
            ->organizations()
            ->where('organization_id', $id)
            ->first();
    }
}
