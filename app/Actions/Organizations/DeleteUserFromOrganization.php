<?php

namespace App\Actions\Organizations;
use App\Models\Organization;
use App\Models\User;

class DeleteUserFromOrganization
{
    public function handle(Organization $organization, User $user)
    {
        return $organization->users()->where('user_id', $user->id)->delete();
    }
}
