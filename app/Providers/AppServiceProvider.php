<?php

namespace App\Providers;

use App\Http\Kernel;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Spatie\Permission\Middleware\RoleOrPermissionMiddleware;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */    public function boot()
    {
        $kernel = $this->app->make(Kernel::class);
        $kernel->pushMiddleware([
            'role' => RoleMiddleware::class,
            'permission' => PermissionMiddleware::class,
            'role_or_permission' => RoleOrPermissionMiddleware::class,
        ]);
    }
}
