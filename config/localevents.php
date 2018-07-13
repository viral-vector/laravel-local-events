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
            'parser' => '' // -> \ViralVector\LocalEvents\Contracts\LocalEventParserInterface::class
        ]
    ],

];
