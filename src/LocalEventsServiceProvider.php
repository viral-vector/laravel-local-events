<?php

namespace ViralVector\LocalEvents;

use Illuminate\Support\ServiceProvider;
use ViralVector\LocalEvents\Contracts\LocalEventParserInterface;
use ViralVector\LocalEvents\Contracts\LocalEventsSearchInterface;

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

        $this->app->singleton(LocalEventParserInterface::class, function ($app) {
            return $app->make(config('localevents.config.parser'));
        });

        $this->app->singleton(LocalEventsSearchInterface::class, function ($app) {
            $driver = config('localevents.driver');
            
            config(['localevents.config' => config("localevents.drivers.{$driver}")]);

            return $app->make(config('localevents.config.class'));
        });
    }
}
