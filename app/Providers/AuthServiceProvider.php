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

//      Gate::define('isAllowed', 'App\Gate\PostGate@allowed' ); // readable code
//      Gate::define('allow-edit-action', 'App\Gate\PostGate@allowedEditAction' ); // readable code
//      Gate::define('allow-delete-action', 'App\Gate\PostGate@allowedDeleteAction' ); // readable code

    }
}
