<?php

namespace SherifAlaa55\Lever\Lever\Providers;

use Illuminate\Support\ServiceProvider;
use SherifAlaa55\Lever\Lever\Activation;
use SherifAlaa55\Lever\Commands\MigrationCommand;

class LeverServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // The publication files to publish
        $this->publishes([__DIR__ . '/../../config/config.php' => config_path('lever.php')]);

        // Append the country settings
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/config.php', 'lever'
        );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerCommands();
    }


    /**
     * Register Migrations Command
     *
     * @return void
     */
    public function registerCommands()
    {
        $this->app->singleton('command.activations.migration', function ($app) {
            return new MigrationCommand($app);
        });

        $this->commands('command.activations.migration');
    }
}
