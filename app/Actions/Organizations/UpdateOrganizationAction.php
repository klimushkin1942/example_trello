<?php

namespace App\Actions\Organizations;

use App\Models\Organization;
use App\Models\UsersOrganizations;
use App\Models\User;

class UpdateOrganizationAction
{
    public function handle($userId, $id, $data)
    {
        return User::findOrFail($userId)
            ->organizations()
            ->where('organization_id', $id)
            ->update($data);
    }
}
