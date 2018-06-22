<?php

namespace ViralVector\LocalEvents\Drivers;

use EVDB;
use ViralVector\LocalEvents\Contracts\LocalEventsSearchInterface;

class EventfulLocalEventsDriver implements LocalEventsSearchInterface
{
    /**
     * @var EVDB
     */
    protected $eventful;

    /**
     * EventfulLocalEventsDriver constructor.
     */
    public function __construct()
    {
        $this->eventful = new EVDB(config('local-events.key'));
    }

    /**
     * @param $query
     * @param null $callback
     */
    public static function search($query, $callback = null)
    {

    }
}