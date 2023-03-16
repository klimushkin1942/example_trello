<?php

namespace App\Providers;

use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\UserController;
use App\Models\Invite;
use App\Models\Organization;
use App\Models\Project;
use App\Models\User;
use App\Models\UsersOrganizations;
use App\Policies\DeskContentPolicy;
use App\Policies\InviteContentPolicy;
use App\Policies\OrganizationContentPolicy;
use App\Policies\ProjectContentPolicy;
use App\Policies\UserContentPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\Response;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        User::class => UserContentPolicy::class,
        Organization::class => OrganizationContentPolicy::class,
        Project::class => ProjectContentPolicy::class,
        Invite::class => InviteContentPolicy::class
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
