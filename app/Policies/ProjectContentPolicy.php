<?php

namespace App\Policies;

use App\Enums\RoleTypes;
use App\Models\User;
use App\Models\UsersRolesOrganizations;
use App\Models\UsersRolesProjects;
use App\Policies\TraitHelper\RolesAuthorization;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
class ProjectContentPolicy
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
    public function canCreateProject(User $user, $orgId)
    {
        $usersRolesOrganization = UsersRolesOrganizations::where('user_id', $user->id)
            ->where('organization_id', $orgId)
            ->first();

        if ($this->isAdminOrganization($usersRolesOrganization)) {
            return Response::allow('Admin');
        }
        return Response::deny('Нет доступа');
    }

    public function canDeleteProject(User $user, $orgId)
    {
        $usersRolesProject = UsersRolesProjects::where('user_id', $user->id)
            ->where('organization_id', $orgId)
            ->first();

        if ($this->isAdminProject($usersRolesProject)) {
            return Response::allow('Admin');
        }
        return Response::deny('Нет доступа');
    }

    public function canReadProject(User $user, $orgId, $projectId)
    {
        $usersRolesOrganization = UsersRolesOrganizations::where('user_id', $user->id)
            ->where('organization_id', $orgId)
            ->first();

        $usersRolesProject = UsersRolesProjects::where('user_id', $user->id)
            ->where('organization_id', $orgId)
            ->where('project_id', $projectId)
            ->first();

        if ($this->isCurrentUser($usersRolesOrganization, $usersRolesProject) && $this->isAdminProject($usersRolesProject)
            || $this->isAdminOrganization($usersRolesOrganization)) {
            return Response::allow('Admin');
        } elseif ($this->isUserProject($usersRolesProject))  {
            return Response::allow('User');
        }
        return Response::deny('Нет доступа');
    }

    public function canGetAllProject(User $user, $orgId)
    {
        $usersRolesOrganization = UsersRolesOrganizations::where('user_id', $user->id)
            ->where('organization_id', $orgId)
            ->first();

        if ($this->isAdminOrganization($usersRolesOrganization)) {
            return Response::allow('Admin');
        }
        return Response::deny('Нет доступа');
    }

    public function canUpdateProject(User $user, $orgId)
    {
        $usersRolesOrganization = UsersRolesOrganizations::where('user_id', $user->id)
            ->where('organization_id', $orgId)
            ->first();

        $usersRolesProject = UsersRolesProjects::where('user_id', $user->id)
            ->where('organization_id', $orgId)
            ->first();

        if ($this->isAdminOrganization($usersRolesOrganization) || $this->isAdminProject($usersRolesProject)) {
            return Response::allow('Admin');
        }
        return Response::deny('Нет доступа');
    }
}
