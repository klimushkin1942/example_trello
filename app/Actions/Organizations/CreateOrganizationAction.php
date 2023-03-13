<?php

namespace App\Actions\Organizations;

use App\Models\Organization;
use App\Models\UsersOrganizations;

class CreateOrganizationAction
{
    public function handle($credentials)
    {
        $organization = Organization::create([
            'name' => $credentials['name'],
            'description' => $credentials['description'],
        ]);

        return UsersOrganizations::create([
            'user_id' => $credentials['user_id'],
            'organization_id' => $organization->id
        ]);
    }
}
