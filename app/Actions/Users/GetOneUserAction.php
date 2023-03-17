<?php

namespace App\Actions\Users;
use App\Models\User;
use App\Models\Organization;
class GetOneUserAction
{
    public function handle(Organization $org, User $user)
    {
        return $org->users()->findOrFail($user->id);
    }
}
