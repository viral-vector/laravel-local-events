<?php

namespace ViralVector\LocalEvents\Drivers;


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
        $this->eventful = new Services_EVDB();
    }

    public static function search($query, $callback = null)
    {

    }
}