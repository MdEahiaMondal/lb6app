<?php

namespace App\Providers;

use App\Post;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('isAdmin', function ($user){
           $roles = $user->roles->pluck('name')->toArray();
           return in_array('Admin', $roles);
        });

        Gate::define('isSubscriber', function ($user){
            return in_array('Subscriber', $user->roles->pluck('name')->toArray());
        });


    }
}
