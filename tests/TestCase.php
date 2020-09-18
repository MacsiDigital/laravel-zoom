<?php

namespace MacsiDigital\Zoom\Tests;

use MacsiDigital\Zoom\Providers\ZoomServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    public function setUp() : void
    {
        parent::setUp();

        $this->setupEnvironment(app());
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            ZoomServiceProvider::class,
        ];
    }

    /**
     * Set up the environment.
     *
     * @param \Illuminate\Foundation\Application $app
     */
    protected function setupEnvironment($app)
    {
        if (env('USE_LIVE_API')) {
            $app['config']->set('zoom.client_key');
            $app['config']->set('zoom.client_secret');
        } else {
        }
    }
}
