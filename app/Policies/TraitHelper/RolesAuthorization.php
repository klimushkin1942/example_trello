<?php


namespace App\Policies\TraitHelper;

use App\Enums\RoleTypes;
use App\Models\UsersRolesOrganizations;
use App\Models\UsersRolesProjects;

trait RolesAuthorization
{
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

    public function isCurrentUser(?UsersRolesOrganizations $usersRolesOrganizations, ?UsersRolesProjects $usersRolesProjects)
    {
        return $usersRolesOrganizations?->user_id === $usersRolesProjects?->user_id;
    }
}
