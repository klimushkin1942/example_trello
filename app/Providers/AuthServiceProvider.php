<?php

namespace App\Providers;

use App\Models\Desk;
use App\Models\DeskColumn;
use App\Models\Invite;
use App\Models\Organization;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\Models\UsersOrganizations;
use App\Policies\DeskColumnContentPolicy;
use App\Policies\DeskContentPolicy;
use App\Policies\InviteContentPolicy;
use App\Policies\OrganizationContentPolicy;
use App\Policies\ProjectContentPolicy;
use App\Policies\TaskContentPolicy;
use App\Policies\UserContentPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;


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
        Invite::class => InviteContentPolicy::class,
        Desk::class => DeskContentPolicy::class,
        DeskColumn::class => DeskColumnContentPolicy::class,
        Task::class => TaskContentPolicy::class,
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
