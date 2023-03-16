<?php

namespace App\Actions\Organizations;

use App\Models\Organization;
use App\Models\User;

class GetOneOrganizationAction
{
    public function handle(User $user, Organization $org)
    {
        return $user->organizations()->where('organization_id', $org->id)->first();
    }
}
