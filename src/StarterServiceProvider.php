<?php
namespace haunv\artStarter;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use Spatie\Permission\PermissionServiceProvider;
use Spatie\Permission\Middleware\RoleMiddleware;
use Spatie\Permission\Middleware\RoleOrPermissionMiddleware;
use Mckenziearts\Notify\LaravelNotifyServiceProvider;
use eloquentFilter\ServiceProvider as FilterService;
use eloquentFilter\Facade\EloquentFilter;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;
use haunv\artStarter\Console\starterInstall;


class StarterServiceProvider extends ServiceProvider {
    public function boot()
    {

        $this->commands([starterInstall::class]);

        $this->app->register(PermissionServiceProvider::class);
        $this->app->register(LaravelNotifyServiceProvider::class);
        $this->app->register(FilterService::class);

        $this->registerMiddleware();

        $this->publishing();

        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->loadRoutesFrom(__DIR__.'/routes/starter.php');
    }
    public function register()
    {
        require_once __DIR__ . '/Helpers/ArtHelper.php';

    }

    protected function registerMiddleware()
    {
        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('permission', \haunv\artStarter\Http\Middleware\PermissionMiddleware::class);
        $router->aliasMiddleware('role', RoleMiddleware::class);
        $router->aliasMiddleware('role_or_permission', RoleOrPermissionMiddleware::class);
        $router->aliasMiddleware('EloquentFilter', EloquentFilter::class);
    }

    public function publishing(): void
    {
        $this->publishes([
            __DIR__.'/../database/migrations/add_description_to_permissions_and_role_tables.php.stub' => $this->getMigrationFileName('add_description_to_permissions_and_role_tables.php'),
        ], 'permission-description');

        $this->publishes([
            __DIR__.'/routes/breadcrumbs.php' => base_path('routes/breadcrumbs.php'),
        ], 'laravel-breadcrumbs');

        $this->publishes([
            __DIR__.'/Http/Controllers/PermissionController.php.haunv' => base_path('app/Http/Controllers/Admin/PermissionController.php'),
        ], 'controller-permission');

        $this->publishes([
            __DIR__.'/Http/Controllers/RoleController.php.haunv' => base_path('app/Http/Controllers/Admin/RoleController.php'),
        ], 'controller-role');

        $this->publishes([
            __DIR__.'/routes/admin.php.haunv' => base_path('routes/admin.php'),
        ], 'admin-routes');

        $this->publishes([
            __DIR__.'/../../resources/views' => resource_path('views/admin/'),
        ], "pr-views");
    }

        /**
     * Returns existing migration file if found, else uses the current timestamp.
     */
    protected function getMigrationFileName(string $migrationFileName): string
    {
        $timestamp = date('Y_m_d');

        $filesystem = $this->app->make(Filesystem::class);

        return Collection::make([$this->app->databasePath().DIRECTORY_SEPARATOR.'migrations'.DIRECTORY_SEPARATOR])
            ->flatMap(fn ($path) => $filesystem->glob($path.'*_'.$migrationFileName))
            ->push($this->app->databasePath()."/migrations/{$timestamp}_999999_{$migrationFileName}")
            ->first();
    }
}
