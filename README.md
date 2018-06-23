# Laravel Local Events
**Alpha 2.0 [production capable]

The aim is to create a simple library for searching for events. 
This was born out of the "official" Eventful PHP lib being a PER lib & no current Laravel love. 
Eventually i thought, why not pool from multiple sources.

    * Currently only Eventful API is supported.
    * Expect breaking changes in future versions.

## Installation

currently just grab this...will composer

    1. php artisan vendor:publish -  the config file
    2. configure api keys, drivers & mappings in config file


## Example
   - config 
    
    * model  => your model to map
    * driver => the driver config to load at run
   
   
   - mapping
```php
[model key => api key or [...api keys] or LocalEventMappingInterface]

'model_map' => [
    'id'        => 'id',
    'title'     => 'title',
    'content'   => 'description',
    'timestamp' => 'start_time',
    'location'  => new \ViralVector\LocalEvents\CompoundMap([
        'lat'   => 'latitude',
        'lng'   => 'longitude',
        'value' => ['venue_name', 'venue_address', 'city_name', 'region_abbr']
    ], function ($data){
        $data['value'] = implode(', ', $data['value']);

        return $data;
    }),
   'venue'  => ['venue_name', 'venue_address', 'city_name', 'region_abbr'],
]
```

- usage
```php
    $events = app(LocalEventsSearchInterface::class);

    $user = User::first();

    $result = $events->search([
        'within'    => $user->search_distance,
        'units'     => 'km',
        'mature'    => 'safe',
        'page_size '=> 30,
        'location'  => $user->location
    ]);
```

## Credits

[Eventful](https://api.eventful.com/)

## License

The MIT License (MIT).
