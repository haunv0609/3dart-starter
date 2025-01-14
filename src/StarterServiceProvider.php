<?php
namespace haunv\artStarter;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Artisan;
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
        $this->mergeConfigFrom(
            __DIR__.'/config/starter.php', 'starter'
        );

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
            __DIR__.'/config/starter.php' => config_path('starter.php'),
        ], 'starter-config');

        $this->publishes([
            __DIR__.'/../database/migrations/add_description_to_permissions_and_role_tables.php.stub' => $this->getMigrationFileName('add_description_to_permissions_and_role_tables.php'),
        ], 'permission-description');

        $this->publishes([
            __DIR__.'/routes/breadcrumbs.php' => base_path('routes/breadcrumbs.php'),
        ], 'laravel-breadcrumbs');
    }

        /**
     * Returns existing migration file if found, else uses the current timestamp.
     */
    protected function getMigrationFileName(string $migrationFileName): string
    {
        $timestamp = date('Y_m_d_His');

        $filesystem = $this->app->make(Filesystem::class);

        return Collection::make([$this->app->databasePath().DIRECTORY_SEPARATOR.'migrations'.DIRECTORY_SEPARATOR])
            ->flatMap(fn ($path) => $filesystem->glob($path.'*_'.$migrationFileName))
            ->push($this->app->databasePath()."/migrations/{$timestamp}_{$migrationFileName}")
            ->first();
    }

    public function harumcpi()
    {
        Artisan::call('user-activity:install');
    }

    public function laravelPermission()
    {
        Artisan::call('vendor:publish', [
            '--provider' => 'Spatie\Permission\PermissionServiceProvider',
            '--force' => true
        ]);
    }

    public function laravelNotify()
    {
        Artisan::call('vendor:publish', [
            '--provider' => 'Mckenziearts\Notify\LaravelNotifyServiceProvider',
            '--force' => true
        ]);
    }

    public function filemanager()
    {
        Artisan::call('vendor:publish', [
            '--tag' => 'lfm_config',
            '--force' => true
        ]);

        Artisan::call('vendor:publish', [
            '--tag' => 'lfm_public',
            '--force' => true
        ]);
    }

    public function configBreadcrumbs()
    {
        Artisan::call('vendor:publish', [
            '--tag' => 'breadcrumbs-config',
            '--force' => true
        ]);
    }
}
