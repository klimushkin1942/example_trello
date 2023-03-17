<?php

namespace App\Policies;

use App\Models\Organization;
use App\Models\User;
use App\Models\UsersRolesOrganizations;
use App\Models\UsersRolesProjects;
use App\Policies\TraitHelper\RolesAuthorization;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class TaskContentPolicy
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

    public function canCreateTask(User $user, Organization $org)
    {
        $usersRolesOrganization = UsersRolesOrganizations::where('user_id', $user->id)
            ->where('organization_id', $org->id)
            ->first();

        $usersRolesProject = UsersRolesProjects::where('user_id', $user->id)
            ->where('organization_id', $org->id)
            ->first();

        if ($this->isAdminOrganization($usersRolesOrganization) || $this->isAdminProject($usersRolesProject)) {
            return Response::allow('Admin');
        } elseif ($this->isUserOrganization($usersRolesOrganization)) {
            return Response::allow('User');
        }
        return Response::deny('Нет доступа');
    }

    public function canUpdateTask(User $user, Organization $org)
    {
        $usersRolesOrganization = UsersRolesOrganizations::where('user_id', $user->id)
            ->where('organization_id', $org->id)
            ->first();

        $usersRolesProject = UsersRolesProjects::where('user_id', $user->id)
            ->where('organization_id', $org->id)
            ->first();

        if ($this->isAdminOrganization($usersRolesOrganization) || $this->isAdminProject($usersRolesProject)) {
            return Response::allow('Admin');
        } elseif ($this->isUserOrganization($usersRolesOrganization)) {
            return Response::allow('User');
        }
        return Response::deny('Нет доступа');
    }

    public function canDeleteTask(User $user, Organization $org)
    {
        $usersRolesOrganization = UsersRolesOrganizations::where('user_id', $user->id)
            ->where('organization_id', $org->id)
            ->first();

        $usersRolesProject = UsersRolesProjects::where('user_id', $user->id)
            ->where('organization_id', $org->id)
            ->first();

        if ($this->isAdminOrganization($usersRolesOrganization) || $this->isAdminProject($usersRolesProject)) {
            return Response::allow('Admin');
        } elseif ($this->isUserOrganization($usersRolesOrganization)) {
            return Response::allow('User');
        }
        return Response::deny('Нет доступа');
    }
}
