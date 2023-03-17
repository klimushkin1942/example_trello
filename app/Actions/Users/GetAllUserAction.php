<?php

namespace App\Actions\Users;
use App\Models\Organization;
use App\Models\User;
class GetAllUserAction
{
    public function handle(Organization $org, $params)
    {
        return $org->users()
            ->orderBy('id', 'asc')
            ->limit($params['limit'])
            ->offset($params['offset'])
            ->get();
    }
}
