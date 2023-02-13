<?php

namespace App\Actions\Organizations;

use App\Models\Organization;

class UpdateOrganizationAction
{
    public function handle($credentials, $id)
    {
        return Organization::where('id', $id)->where('user_id', $credentials['user_id'])->update(
            [
                'name' => $credentials['name'],
                'description' => $credentials['description']
            ]);
    }
}
