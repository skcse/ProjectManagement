<?php

namespace App\Providers;

use App\Policies\TeamPolicy;
use App\Policies\UserPolicy;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        'App\Team' => 'App\Policies\TeamPolicy',
        'App\User' => 'App\Policies\UserPolicy',
        'App\Project' =>'App\Policies\ProjectPolicy',
        'App\Projectmember' =>'App\Policies\ProjectmemberPolicy',
        Team::class => TeamPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
