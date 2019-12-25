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

        Gate::define('isAllowed', function ($user, $allowed){
           $roles = $user->roles->pluck('name')->toArray();
           return array_intersect($allowed->all(), $roles);
        });


     /*   Gate::define('isSubscriber', function ($user){
            return in_array('Subscriber', $user->roles->pluck('name')->toArray());
        });*/


    }
}
