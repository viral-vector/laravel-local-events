<?php

namespace ViralVector\LocalEvents\Drivers;

use Services_EVDB;
use ViralVector\LocalEvents\Contracts\LocalEventsSearchInterface;

class EventfulLocalEventsDriver implements LocalEventsSearchInterface
{

    /**
     * @var Services_EVDB
     */
    protected $eventful;

    /**
     * EventfulLocalEventsDriver constructor.
     */
    public function __construct()
    {
        $this->eventful = new Services_EVDB(config('local-events.key'));
    }

    public static function search($query, $callback = null)
    {

    }
}