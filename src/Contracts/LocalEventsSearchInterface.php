<?php

namespace ViralVector\LaravelScoutElastic\Contracts;

interface LocalEventsSearchInterface
{
    public static function search($query, $callback = null);
}
