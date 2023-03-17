<?php

namespace App\Policies;

use App\Models\Organization;
use App\Models\Project;
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

    public function canCreateColumn(User $user, Organization $org, Project $project)
    {
        $usersRolesOrganization = UsersRolesOrganizations::where('user_id', $user->id)
            ->where('organization_id', $org->id)
            ->first();

        $usersRolesProject = UsersRolesProjects::where('user_id', $user->id)
            ->where('organization_id', $org->id)
            ->where('project_id', $project->id)
            ->first();

        if ($this->isAdminOrganization($usersRolesOrganization) && $this->isCurrentUser($usersRolesOrganization, $usersRolesProject)
            || $this->isAdminProject($usersRolesProject)) {
            return Response::allow('Admin');
        } elseif ($this->isUserOrganization($usersRolesOrganization) || $this->isUserProject($usersRolesProject)) {
            return Response::allow('User');
        }
        return Response::deny('Нет доступа');
    }

    public function canDeleteColumn(User $user, Organization $org, Project $project)
    {
        $usersRolesOrganization = UsersRolesOrganizations::where('user_id', $user->id)
            ->where('organization_id', $org->id)
            ->first();

        $usersRolesProject = UsersRolesProjects::where('user_id', $user->id)
            ->where('organization_id', $org->id)
            ->where('project_id', $project->id)
            ->first();

        if ($this->isAdminOrganization($usersRolesOrganization) && $this->isCurrentUser($usersRolesOrganization, $usersRolesProject)
            || $this->isAdminProject($usersRolesProject)) {
            return Response::allow('Admin');
        } elseif ($this->isUserOrganization($usersRolesOrganization) || $this->isUserProject($usersRolesProject)) {
            return Response::allow('User');
        }
        return Response::deny('Нет доступа');
    }

    public function canUpdateColumn(User $user, Organization $org, Project $project)
    {
        $usersRolesOrganization = UsersRolesOrganizations::where('user_id', $user->id)
            ->where('organization_id', $org->id)
            ->first();

        $usersRolesProject = UsersRolesProjects::where('user_id', $user->id)
            ->where('organization_id', $org->id)
            ->where('project_id', $project->id)
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
