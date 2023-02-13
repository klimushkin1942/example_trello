<?php

namespace App\Actions\Organizations;

use App\Models\Organization;

class GetAllOrganizationAction
{
    public function handle($credentials)
    {
        return Organization::all()->where('user_id', $credentials['user_id']);
    }
}
