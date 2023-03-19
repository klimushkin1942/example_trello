<?php

namespace App\Policies;

use App\Enums\RoleTypes;
use App\Models\Organization;
use App\Models\User;
use App\Models\UsersRolesOrganizations;
use App\Models\UsersRolesProjects;
use App\Policies\TraitHelper\RolesAuthorization;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class OrganizationContentPolicy
{
    use HandlesAuthorization;
    use RolesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function canUpdateOrganization(User $user, Organization $org)
    {
        $usersRolesOrganization = UsersRolesOrganizations::where('user_id', $user->id)
            ->where('organization_id', $org->id)
            ->first();

        if ($this->isAdminOrganization($usersRolesOrganization)) {
            return Response::allow('Admin');
        }
        return Response::deny('Нет доступа');
    }

    public function canReadOrganization(User $user, Organization $org)
    {
        $usersRolesOrganization = UsersRolesOrganizations::where('user_id', $user->id)
            ->where('organization_id', $org->id)
            ->first();

        if ($this->isAdminOrganization($usersRolesOrganization)) {
            return Response::allow('Admin');
        } elseif ($this->isUserOrganization($usersRolesOrganization)) {
            return Response::allow('User');
        }
        return Response::deny('Нет доступа');
    }

    public function canDeleteOrganization(User $user, Organization $org)
    {
        $usersRolesOrganization = UsersRolesOrganizations::where('user_id', $user->id)
            ->where('organization_id', $org->id)
            ->first();

        if ($this->isAdminOrganization($usersRolesOrganization)) {
            return Response::allow('Admin');
        }
        return Response::deny('Нет доступа');
    }
}
