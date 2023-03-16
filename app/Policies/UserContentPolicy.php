<?php

namespace App\Policies;

use App\Enums\RoleTypes;
use App\Models\Role;
use App\Models\User;
use App\Models\UsersRolesOrganizations;
use App\Models\UsersRolesProjects;
use App\Policies\TraitHelper\RolesAuthorization;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class UserContentPolicy
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

    }
    public function canGetAllUsers(User $user, $orgId)
    {
        $usersRolesOrganization = UsersRolesOrganizations::where('user_id', $user->id)
            ->where('organization_id', $orgId)
            ->first();

        if ($this->isAdminOrganization($usersRolesOrganization)) {
            return Response::allow('Admin');
        }
        return Response::deny('Нет доступа');
    }

    public function canReadUser(User $user, $orgId)
    {
        $usersRolesOrganization = UsersRolesOrganizations::where('user_id', $user->id)
            ->where('organization_id', $orgId)
            ->first();

        if ($this->isAdminOrganization($usersRolesOrganization)) {
            return Response::allow('Admin');
        }
        return Response::deny('Нет доступа');
    }

    public function canDeleteUser(User $user, $orgId)
    {
        $usersRolesOrganization = UsersRolesOrganizations::where('user_id', $user->id)
            ->where('organization_id', $orgId)
            ->first();

        if ($this->isAdminOrganization($usersRolesOrganization)) {
            return Response::allow('Admin');
        }
        return Response::deny('Нет доступа');
    }
}
