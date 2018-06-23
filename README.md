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

```php
    $events = app(LocalEventsSearchInterface::class);

    $user = User::first();

    $result = $events->search([
        'within'    => $user->settings['search_distance'],
        'units'     => 'km',
        'mature'    => 'safe',
        'page_size '=> 100,
        'location'  => $user->location
    ]);
```

## Credits

[Eventful](https://api.eventful.com/)

## License

The MIT License (MIT).
