<?php

namespace ViralVector\LaravelScoutElastic;

use Illuminate\Support\ServiceProvider;

class LaravelLocalEventsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {

    }

    public function register()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/local-events.php' => config_path('local-events.php'),
            ]);
        }
    }
}
