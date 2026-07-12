<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Modules\UserManagement\Policies\PermissionPolicy;
use Modules\UserManagement\Policies\RolePolicy;
use Modules\UserManagement\Policies\UserPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        User::class => UserPolicy::class,
        'Spatie\\Permission\\Models\\Role' => RolePolicy::class,
        'Spatie\\Permission\\Models\\Permission' => PermissionPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}
