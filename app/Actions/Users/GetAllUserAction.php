<?php

namespace App\Actions\Users;
use App\Models\Organization;
use App\Models\User;
class GetAllUserAction
{
    public function handle($orgId, $limit, $offset)
    {
        return Organization::findOrFail($orgId)
            ->users()
            ->orderBy('id', 'asc')
            ->limit($limit)
            ->offset($offset)
            ->get();
    }
}
