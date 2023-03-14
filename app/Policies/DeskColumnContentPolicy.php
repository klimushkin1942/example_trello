<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UsersRolesOrganizations;
use App\Models\UsersRolesProjects;
use App\Policies\TraitHelper\RolesAuthorization;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class DeskColumnContentPolicy
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

    public function canCreateColumn(User $user, $orgId, $projectId)
    {
        $usersRolesOrganization = UsersRolesOrganizations::where('user_id', $user->id)
            ->where('organization_id', $orgId)
            ->first();

        $usersRolesProject = UsersRolesProjects::where('user_id', $user->id)
            ->where('organization_id', $orgId)
            ->where('project_id', $projectId)
            ->first();

        if ($this->isAdminOrganization($usersRolesOrganization) && $this->isCurrentUser($usersRolesOrganization, $usersRolesProject)
            || $this->isAdminProject($usersRolesProject)) {
            return Response::allow('Admin');
        } elseif ($this->isUserOrganization($usersRolesOrganization) || $this->isUserProject($usersRolesProject)) {
            return Response::allow('User');
        }
        return Response::deny('Нет доступа');
    }

    public function canDeleteColumn(User $user, $orgId, $projectId)
    {
        $usersRolesOrganization = UsersRolesOrganizations::where('user_id', $user->id)
            ->where('organization_id', $orgId)
            ->first();

        $usersRolesProject = UsersRolesProjects::where('user_id', $user->id)
            ->where('organization_id', $orgId)
            ->where('project_id', $projectId)
            ->first();

        if ($this->isAdminOrganization($usersRolesOrganization) && $this->isCurrentUser($usersRolesOrganization, $usersRolesProject)
            || $this->isAdminProject($usersRolesProject)) {
            return Response::allow('Admin');
        } elseif ($this->isUserOrganization($usersRolesOrganization) || $this->isUserProject($usersRolesProject)) {
            return Response::allow('User');
        }
        return Response::deny('Нет доступа');
    }

    public function canUpdateColumn(User $user, $orgId, $projectId)
    {
        $usersRolesOrganization = UsersRolesOrganizations::where('user_id', $user->id)
            ->where('organization_id', $orgId)
            ->first();

        $usersRolesProject = UsersRolesProjects::where('user_id', $user->id)
            ->where('organization_id', $orgId)
            ->where('project_id', $projectId)
            ->first();

        if ($this->isAdminOrganization($usersRolesOrganization) && $this->isCurrentUser($usersRolesOrganization, $usersRolesProject)
            || $this->isAdminProject($usersRolesProject)) {
            return Response::allow('Admin');
        } elseif ($this->isUserOrganization($usersRolesOrganization) || $this->isUserProject($usersRolesProject)) {
            return Response::allow('User');
        }
        return Response::deny('Нет доступа');
    }
}
