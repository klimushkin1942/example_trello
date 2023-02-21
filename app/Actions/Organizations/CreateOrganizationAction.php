<?php

namespace App\Actions\Organizations;

use App\Models\User;
use App\Models\UsersRolesOrganizations;

class CreateOrganizationAction
{
    public function handle($userId, $credentials)
    {
        $organization = User::find($userId)
            ->organizations()
            ->create(
                [
                    'name' => $credentials['name'],
                    'description' => $credentials['description']
                ]);

        UsersRolesOrganizations::create([
            'user_id' => $userId,
            'organization_id' => $organization->id,
            'role_id' => '1'
        ]);
    }
}
