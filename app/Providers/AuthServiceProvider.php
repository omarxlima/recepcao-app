<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\{
    Grupo,
    Permission,
    Role,
    User

};

use App\Policies\{
    GrupoPolicy,
    PermissionPolicy,
    RolePolicy,
    UserPolicy
};

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
        User::class => UserPolicy::class,
        Role::class => RolePolicy::class,
        Permission::class => PermissionPolicy::class,
        Grupo::class => GrupoPolicy::class,

    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
