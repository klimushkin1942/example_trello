<?php

namespace App\Actions\Organizations;

use App\Models\Organization;
use App\Models\User;

class GetAllOrganizationAction
{
    public function handle($userId, $limit, $offset)
    {
        return User::findOrFail($userId)
            ->organizations()
            ->orderBy('id', 'asc')
            ->limit($limit)
            ->offset($offset)
            ->get();
    }
}
