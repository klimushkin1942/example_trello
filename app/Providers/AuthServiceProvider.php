<?php

namespace App\Providers;

use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\UserController;
use App\Models\Desk;
use App\Models\DeskColumn;
use App\Models\Organization;
use App\Models\Project;
use App\Models\User;
use App\Models\UsersOrganizations;
use App\Policies\DeskContentPolicy;
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
        Desk::class => DeskContentPolicy::class,
        DeskColumn::class => DeskContentPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
