<?php

namespace App\Actions\Organizations;

use App\Models\Organization;
use App\Models\User;

class DeleteOrganizationAction
{
    public function handle(User $user, $id)
    {
        return $user->organizations()->where('organization_id', $id)->delete();
    }
}
