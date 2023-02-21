<?php

namespace App\Providers;

use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\UserController;
use App\Models\Organization;
use App\Models\User;
use App\Models\UsersOrganizations;
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
        UserController::class => UserContentPolicy::class,
        OrganizationController::class => UserContentPolicy::class,
        ProjectsController::class => UserContentPolicy::class
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
