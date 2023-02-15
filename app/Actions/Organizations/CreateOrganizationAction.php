<?php

namespace App\Actions\Organizations;

use App\Models\User;

class CreateOrganizationAction
{
    public function handle($userId, $credentials)
    {
        return User::find($userId)
            ->organizations()
            ->create(
                [
                    'name' => $credentials['name'],
                    'description' => $credentials['description']
                ]);
    }
}
