<?php

namespace App\Actions\Organizations;

use App\Models\User;
use App\Models\UsersRolesOrganizations;
use App\Enums\RoleTypes;

class CreateOrganizationAction
{

    public function handle(User $user, $params)
    {
        $organization = User::findOrFail($user->id)
            ->organizations()
            ->create(
                [
                    'name' => $params['name'],
                    'description' => $params['description']
                ]);

        return UsersRolesOrganizations::create([
            'user_id' => $user->id,
            'organization_id' => $organization->id,
            'role_id' => RoleTypes::ADMIN->value
        ]);
    }
}
