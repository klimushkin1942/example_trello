<?php

namespace App\Actions\Organizations;

use App\Models\Organization;
use App\Models\UsersOrganizations;
use App\Models\User;

class UpdateOrganizationAction
{
    public function handle(User $user, Organization $org, $data)
    {
        return $user->organizations()->where('organization_id', $org->id)->update($data);
    }
}
