<?php

namespace App\Actions\Organizations;

use App\Models\Organization;
use App\Models\User;

class GetAllOrganizationAction
{
    public function handle($userId, $credentials)
    {
        return User::findOrFail($userId)
            ->organizations()
            ->orderBy('id', 'asc')
            ->limit($credentials['limit'])
            ->offset($credentials['offset'])
            ->get();
    }
}
