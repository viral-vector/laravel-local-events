<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Current in use driver
    |--------------------------------------------------------------------------
    |
    */

    'driver' => env('LOCAL_EVENTS_DRIVER', 'eventful'),


    /*
    |--------------------------------------------------------------------------
    | Model Class
    |--------------------------------------------------------------------------
    |
    */

    'model' => null,

    /*
    |--------------------------------------------------------------------------
    | Possible drivers
    |--------------------------------------------------------------------------
    |
    | List of possible drivers that conform to specified contracts
    |
    */

    'drivers' => [
        'chain'    => [
          // N.A. -> chain to allow for pooling of events from multiple sources
        ],
        'eventful' => [
            'key' => env('LOCAL_EVENTS_KEY', null),
            'class' => \ViralVector\LocalEvents\Drivers\EventfulLocalEventsDriver::class,
            'model_map' => [
                'id' => null,
                'url ' => null,
                'title' => null,
                'description' => null,
                'start_time' => null,
                'stop_time' => null,
                'city_name' => null,
                'latitude' => null,
                'longitude' => null
            ]
        ]
    ],

];
