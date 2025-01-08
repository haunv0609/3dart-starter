<?php
namespace haunv\artStarter;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use Spatie\Permission\PermissionServiceProvider;
use Spatie\Permission\Middleware\RoleMiddleware;
use Spatie\Permission\Middleware\RoleOrPermissionMiddleware;


class StarterServiceProvider extends ServiceProvider {
    public function boot()
    {
        $this->app->register(PermissionServiceProvider::class);

        $this->registerMiddleware();

        $this->publishes([
            __DIR__.'/config/starter.php' => config_path('starter.php'),
        ], 'starter-config');

        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        $this->loadRoutesFrom(__DIR__.'/routes/starter.php');
    }
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/starter.php', 'starter'
        );
    }

    protected function registerMiddleware()
    {
        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('permission', \haunv\Starter\Http\Middleware\PermissionMiddleware::class);
        $router->aliasMiddleware('role', RoleMiddleware::class);
        $router->aliasMiddleware('role_or_permission', RoleOrPermissionMiddleware::class);
    }
}
