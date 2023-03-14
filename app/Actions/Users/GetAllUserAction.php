<?php

namespace App\Actions\Users;
use App\Models\Organization;
use App\Models\User;
class GetAllUserAction
{
    public function handle($orgId, $params)
    {
        return Organization::findOrFail($orgId)
            ->users()
            ->orderBy('id', 'asc')
            ->limit($params['limit'])
            ->offset($params['offset'])
            ->get();
    }
}
