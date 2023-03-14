<?php

namespace App\Actions\Organizations;

use App\Models\Organization;
use App\Models\User;

class GetAllOrganizationAction
{
    public function handle(User $user, $params)
    {
        return $user->organizations()
            ->orderBy('id')
            ->limit($params['limit'])
            ->offset($params['offset'])
            ->get();
    }
}
