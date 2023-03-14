<?php

namespace App\Actions\Organizations;

use App\Models\Organization;
use App\Models\UsersOrganizations;
use App\Models\User;

class UpdateOrganizationAction
{
    public function handle(User $user, $orgId, $data)
    {
        return $user->organizations()->where('organization_id', $orgId)->update($data);
    }
}
