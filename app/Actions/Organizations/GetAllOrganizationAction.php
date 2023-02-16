<?php

namespace App\Actions\Organizations;

use App\Models\Organization;
use App\Models\User;

class GetAllOrganizationAction
{
    public function handle($userId)
    {
        return User::find($userId)
            ->organizations()
            ->orderBy('created_at', 'asc')
            ->limit(5)
            ->get();
    }
}
