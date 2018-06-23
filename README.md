# Laravel Local Events
**Alpha 1.0 [not production ready]

The aim is to create a simple library for searching for events. 
This was born out of the "official" Eventful PHP lib being a PER lib & no current Laravel love. 
Eventually i thought, why not pool from multiple sources.

    * Currently only Eventful API is supported.
    * Expect breaking changes in future versions.

## Installation

currently just grab this...will composer


## Example
   - config & mapping
```php
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
