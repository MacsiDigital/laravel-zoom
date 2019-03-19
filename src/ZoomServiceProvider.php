<?php
namespace MacsiDigital\Zoom;

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
        $this->publishes([
            '../config/zoom.php' => config_path('zoom.php'),
        ]);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Zoom', function () {
            return new Zoom();
        });

    }
}
