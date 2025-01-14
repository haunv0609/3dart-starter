<?php

namespace haunv\artStarter\Console;

use Illuminate\Console\Command;

class starterInstall extends Command
{
    protected $signature = 'haunv:install';

    protected $description = 'Install the starter package';

    public function handle()
    {
        $this->comment('Publishing starter config...');

        $this->laravelPermission();
        $this->laravelNotify();
        $this->filemanagerConfig();
        $this->filemanagerPublic();
        $this->configBreadcrumbs();

        $this->info('starter config published successfully.');
    }

    private function laravelPermission()
    {
        $this->call('vendor:publish', [
            '--provider'    => 'Spatie\Permission\PermissionServiceProvider',
            '--force'       => true
        ]);
    }

    private function laravelNotify()
    {
        $this->call('vendor:publish', [
            '--provider'    => 'Mckenziearts\Notify\LaravelNotifyServiceProvider',
            '--force'       => true
        ]);
    }

    private function filemanagerConfig()
    {
        $this->call('vendor:publish', [
            '--tag'         => 'lfm_config',
            '--force'       => true
        ]);
    }

    private function filemanagerPublic()
    {
        $this->call('vendor:publish', [
            '--tag'         => 'lfm_public',
            '--force'       => true
        ]);
    }

    private function configBreadcrumbs()
    {
        $this->call('vendor:publish', [
            '--tag'         => 'breadcrumbs-config',
            '--force'       => true
        ]);
    }
}
