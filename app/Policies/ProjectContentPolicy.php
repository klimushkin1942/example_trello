<?php

namespace App\Policies;

use App\Enums\RoleTypes;
use App\Models\Organization;
use App\Models\Project;
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
    public function canCreateProject(User $user, Organization $org)
    {
        $usersRolesOrganization = UsersRolesOrganizations::where('user_id', $user->id)
            ->where('organization_id', $org->id)
            ->first();

        if ($this->isAdminOrganization($usersRolesOrganization)) {
            return Response::allow('Admin');
        }
        return Response::deny('Нет доступа');
    }

    public function canDeleteProject(User $user, Organization $org)
    {
        $usersRolesProject = UsersRolesProjects::where('user_id', $user->id)
            ->where('organization_id', $org->id)
            ->first();

        if ($this->isAdminProject($usersRolesProject)) {
            return Response::allow('Admin');
        }
        return Response::deny('Нет доступа');
    }

    public function canReadProject(User $user, Organization $org, Project $project)
    {
        $usersRolesOrganization = UsersRolesOrganizations::where('user_id', $user->id)
            ->where('organization_id', $org->id)
            ->first();

        $usersRolesProject = UsersRolesProjects::where('user_id', $user->id)
            ->where('organization_id', $org->id)
            ->where('project_id', $project->id)
            ->first();

        if ($this->isCurrentUser($usersRolesOrganization, $usersRolesProject) && $this->isAdminProject($usersRolesProject)
            || $this->isAdminOrganization($usersRolesOrganization)) {
            return Response::allow('Admin');
        } elseif ($this->isUserProject($usersRolesProject))  {
            return Response::allow('User');
        }
        return Response::deny('Нет доступа');
    }

    public function canGetAllProject(User $user, Organization $org)
    {
        $usersRolesOrganization = UsersRolesOrganizations::where('user_id', $user->id)
            ->where('organization_id', $org->id)
            ->first();

        if ($this->isAdminOrganization($usersRolesOrganization)) {
            return Response::allow('Admin');
        }
        return Response::deny('Нет доступа');
    }

    public function canUpdateProject(User $user, Organization $org)
    {
        $usersRolesOrganization = UsersRolesOrganizations::where('user_id', $user->id)
            ->where('organization_id', $org->id)
            ->first();

        $usersRolesProject = UsersRolesProjects::where('user_id', $user->id)
            ->where('organization_id', $org->id)
            ->first();

        if ($this->isAdminOrganization($usersRolesOrganization) || $this->isAdminProject($usersRolesProject)) {
            return Response::allow('Admin');
        }
        return Response::deny('Нет доступа');
    }
}
