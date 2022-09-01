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
     * Tipos de usuarios:
     * Admin (Tiene todas las capacidades)
     * Business (Tiene permisos para ver solo su negocio)
     * Editor (Usuario interno que puede ver administración de la plataforma)
     * User (Rol de usuario como postulante, solo puede editar su CV y sus postulaciones)
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        /** Define Gate admin role
         *
         * Gate que define si es administrador
         */
        Gate::define('is-admin', function (User $user) {
            if ($user->role == 'admin') {
                return true;
            } else {
                return false;
            }
        });

        /** Define Gate business role
         *
         * Gate que define si el usuario es negocio
         */
        Gate::define('is-business', function (User $user) {
            if ($user->role == 'business') {
                return true;
            } else {
                return false;
            }
        });

        /** Define Gate editor role
         *
         * Gate que define si el usuario es editor interno
         */
        Gate::define('is-editor', function (User $user) {
            if ($user->role == 'editor') {
                return true;
            } else {
                return false;
            }
        });

        /** Define Gate user role
         * Gate que define si el usuario es postulante
         */
        Gate::define('is-user', function (User $user) {
            if ($user->role == 'user') {
                return true;
            } else {
                return false;
            }
        });
    }
}
