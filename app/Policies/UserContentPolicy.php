<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UsersRolesOrganizations;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class UserContentPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {

    }
    public function canUpdateOrganization(User $user, $orgId)
    {
        $users_role = UsersRolesOrganizations::where('user_id', $user->id)
            ->where('organization_id', $orgId)
            ->first();

        if (!empty($users_role) && $users_role->role_id == 1) {
            return Response::allow('Admin');
        }
        return Response::deny('Нет доступа');
    }

    public function canDeleteOrganization(User $user, $orgId)
    {
        $users_role = UsersRolesOrganizations::where('user_id', $user->id)
            ->where('organization_id', $orgId)
            ->first();

        if (!empty($users_role) && $users_role->role_id == 1) {
            return Response::allow('Admin');
        }
        return Response::deny('Нет доступа');
    }


    public function canCreateProject(User $user, $orgId)
    {
        $users_role = UsersRolesOrganizations::where('user_id', $user->id)
            ->where('organization_id', $orgId)
            ->first();

        if (!empty($users_role) && $users_role->role_id == 1) {
            return Response::allow('Admin');
        } elseif (!empty($users_role) && $users_role->role_id == 2) {
            return Response::allow('User');
        }
        return Response::deny('Нет доступа');
    }

    public function canDeleteProject(User $user, $orgId)
    {
        $users_role = UsersRolesOrganizations::where('user_id', $user->id)
            ->where('organization_id', $orgId)
            ->first();

        if (!empty($users_role) && $users_role->role_id == 1) {
            return Response::allow('Admin');
        } elseif (!empty($users_role) && $users_role->role_id == 2) {
            return Response::allow('User');
        }
        return Response::deny('Нет доступа');
    }

    public function canUpdateProject(User $user, $orgId)
    {
        $users_role = UsersRolesOrganizations::where('user_id', $user->id)
            ->where('organization_id', $orgId)
            ->first();

        if (!empty($users_role) && $users_role->role_id == 1) {
            return Response::allow('Admin');
        } elseif (!empty($users_role) && $users_role->role_id == 2) {
            return Response::allow('User');
        }
        return Response::deny('Нет доступа');
    }
}
