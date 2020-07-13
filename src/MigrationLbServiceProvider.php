<?php

namespace Netsells\MigrationLb;

use Illuminate\Support\ServiceProvider;

/**
 * The Laravel service provider, which registers, configures and bootstraps the package.
 */
class MigrationLbServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Make sure the migrator class is registered to prevent errors - by
        // default it's only registered in the console and unit tests.
        // Note: singletonIf() is not available until Laravel 6.0.
        $this->app->bindIf('migrator', static function () {
            return null;
        }, true);
    }

    public function boot(): void
    {
        //
    }
}
