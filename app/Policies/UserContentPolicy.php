<?php

namespace App\Policies;

use App\Enums\RoleTypes;
use App\Models\Role;
use App\Models\User;
use App\Models\UsersRolesOrganizations;
use App\Models\UsersRolesProjects;
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

    public function isCurrentUser(UsersRolesOrganizations $usersRolesOrganizations, ?UsersRolesProjects $usersRolesProjects)
    {
        return $usersRolesOrganizations->user_id === $usersRolesProjects?->user_id;
    }

    public function isAdminOrganization(?UsersRolesOrganizations $usersRolesOrganizations)
    {
        return $usersRolesOrganizations?->role_id == RoleTypes::ADMIN->value;
    }

    public function isAdminProject(?UsersRolesProjects $usersRolesProjects)
    {
        return $usersRolesProjects?->role_id == RoleTypes::ADMIN->value;
    }

    public function isUserOrganization(?UsersRolesOrganizations $usersRolesOrganizations)
    {
        return $usersRolesOrganizations?->role_id == RoleTypes::USER->value;
    }

    public function isUserProject(?UsersRolesProjects $usersRolesProjects)
    {
        return $usersRolesProjects?->role_id == RoleTypes::USER->value;
    }

    public function isObserverOrganization(?UsersRolesOrganizations $usersRolesOrganizations)
    {
        return $usersRolesOrganizations?->role_id == RoleTypes::OBSERVER->value;
    }

    // =============================

    public function canUpdateOrganization(User $user, $orgId)
    {
        $usersRolesOrganization = UsersRolesOrganizations::where('user_id', $user->id)
            ->where('organization_id', $orgId)
            ->first();

        if ($this->isAdminOrganization($usersRolesOrganization)) {
            return Response::allow('Admin');
        }
        return Response::deny('Нет доступа');
    }

    public function canReadOrganization(User $user, $orgId)
    {
        $usersRolesOrganization = UsersRolesOrganizations::where('user_id', $user->id)
            ->where('organization_id', $orgId)
            ->first();

        if ($this->isAdminOrganization($usersRolesOrganization)) {
            return Response::allow('Admin');
        } elseif ($this->isUserOrganization($usersRolesOrganization)) {
            return Response::allow('User');
        }
        return Response::deny('Нет доступа');
    }

    public function canDeleteOrganization(User $user, $orgId)
    {
        $usersRolesOrganization = UsersRolesOrganizations::where('user_id', $user->id)
            ->where('organization_id', $orgId)
            ->first();

        if ($this->isAdminOrganization($usersRolesOrganization)) {
            return Response::allow('Admin');
        }
        return Response::deny('Нет доступа');
    }

    public function canCreateProject(User $user, $orgId)
    {
        $usersRolesOrganization = UsersRolesOrganizations::where('user_id', $user->id)
            ->where('organization_id', $orgId)
            ->first();

        $usersRolesProject = UsersRolesProjects::where('user_id', $user->id)
            ->where('organization_id', $orgId)
            ->first();

        if ($this->isAdminOrganization($usersRolesOrganization) || $this->isAdminProject($usersRolesProject)) {
            return Response::allow('Admin');
        } elseif ($this->isUserOrganization($usersRolesOrganization)) {
            return Response::allow('User');
        }
        return Response::deny('Нет доступа');
    }

    public function canDeleteProject(User $user, $orgId)
    {
        $usersRolesOrganization = UsersRolesOrganizations::where('user_id', $user->id)
            ->where('organization_id', $orgId)
            ->first();

        $usersRolesProject = UsersRolesProjects::where('user_id', $user->id)
            ->where('organization_id', $orgId)
            ->first();

        if ($this->isAdminOrganization($usersRolesOrganization) || $this->isAdminProject($usersRolesProject)) {
            return Response::allow('Admin');
        } elseif ($this->isUserOrganization($usersRolesOrganization)) {
            return Response::allow('User');
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

        if ($this->isAdminOrganization($usersRolesOrganization) && $this->isCurrentUser($usersRolesOrganization, $usersRolesProject)
            || $this->isAdminProject($usersRolesProject)) {
            return Response::allow('Admin');
        } elseif ($this->isUserOrganization($usersRolesOrganization) || $this->isUserProject($usersRolesProject))  {
            return Response::allow('User');
        } elseif ($this->isObserverOrganization($usersRolesOrganization)) {
            return Response::allow('Observer');
        }
        return Response::deny('Нет доступа');
    }

    public function canGetAllProject(User $user, $orgId)
    {
        $usersRolesOrganization = UsersRolesOrganizations::where('user_id', $user->id)
            ->where('organization_id', $orgId)
            ->first();

        $usersRolesProject = UsersRolesProjects::where('user_id', $user->id)
            ->where('organization_id', $orgId)
            ->first();

        if ($this->isAdminOrganization($usersRolesOrganization)) {
            return Response::allow('Admin');
        } elseif ($this->isUserOrganization($usersRolesOrganization) || $this->isUserProject($usersRolesProject))  {
            return Response::allow('User');
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
        } elseif ($this->isUserOrganization($usersRolesOrganization)) {
            return Response::allow('User');
        }
        return Response::deny('Нет доступа');
    }

    // users
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
