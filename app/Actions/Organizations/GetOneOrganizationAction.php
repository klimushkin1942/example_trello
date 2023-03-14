<?php

namespace App\Actions\Organizations;

use App\Models\User;

class GetOneOrganizationAction
{
    public function handle(User $user, $orgId)
    {
        return $user->organizations()->where('organization_id', $orgId)->first();
    }
}
