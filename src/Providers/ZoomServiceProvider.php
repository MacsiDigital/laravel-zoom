<?php

namespace MacsiDigital\Zoom\Providers;

use MacsiDigital\Zoom\Zoom;
use Illuminate\Support\ServiceProvider;

class ZoomServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../../config/config.php' => config_path('zoom.php'),
            ], 'config');
        }
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../../config/config.php', 'zoom');

        // Register the main class to use with the facade
        $this->app->bind('zoom', function () {
            return new Zoom();
        });
    }
}
