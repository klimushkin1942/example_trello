<?php

namespace App\Actions\Organizations;

use App\Models\Organization;
use App\Models\User;

class DeleteOrganizationAction
{
    public function handle($userId, $id)
    {
        return User::find($userId)
            ->organizations()
            ->where('organization_id', $id)
            ->delete();
    }
}
