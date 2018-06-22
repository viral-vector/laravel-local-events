<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Current in use driver
    |--------------------------------------------------------------------------
    |
    */

    'driver' => [
        env('LOCAL_EVENTS_DRIVER', 'eventful'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Possible drivers
    |--------------------------------------------------------------------------
    |
    | List of possible drivers that conform to specified contracts
    |
    */

    'drivers' => [
        'eventful' => [
            'key' => env('LOCAL_EVENTS_KEY', null)
        ]
    ],

];
