<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('isAdmin', function () {
            return Auth::user()->role_id === 3;
        });

        Gate::define('isDeveloper', function () {
            return Auth::user()->role_id === 2;
        });

        Gate::define('isClient', function () {
            return Auth::user()->role_id === 1;
        });

        Gate::define('viewLogViewer', function () {
            return Auth::user()->role_id === 3;
        });
    }
}
