<?php

namespace ViralVector\LocalEvents;

use Illuminate\Support\ServiceProvider;
use ViralVector\LocalEvents\Contracts\LocalEventsSearchInterface;
use ViralVector\LocalEvents\Drivers\EventfulLocalEventsDriver;

class LocalEventsServiceProvider extends ServiceProvider
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
                __DIR__ . '/../config/localevents.php' => config_path('localevents.php'),
            ]);
        }

        $this->app->singleton(LocalEventsSearchInterface::class, function ($app) {
            config(['localevents' => config('localevents.drivers.eventful')]);

            return $app->make(EventfulLocalEventsDriver::class);
        });
    }
}
