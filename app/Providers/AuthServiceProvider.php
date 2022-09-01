<?php

namespace App\Providers;

use App\Models\User;
use App\Policies\UserPolicies;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        /** Define Gate admin role */
        Gate::define('is-admin', function (User $user) {
            if ($user->role == 'admin') {
                return true;
            } else {
                return false;
            }
        });

        /** Define Gate business role */
        Gate::define('is-business', function (User $user) {
            if ($user->role == 'business') {
                return true;
            } else {
                return false;
            }
        });

        /** Define Gate editor role */
        Gate::define('is-editor', function (User $user) {
            if ($user->role == 'editor') {
                return true;
            } else {
                return false;
            }
        });

        /** Define Gate user role */
        Gate::define('is-user', function (User $user) {
            if ($user->role == 'user') {
                return true;
            } else {
                return false;
            }
        });
    }
}
