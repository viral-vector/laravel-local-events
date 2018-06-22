<?php

namespace ViralVector\LocalEvents\Contracts;

interface LocalEventsSearchInterface
{
    public static function search($query, $callback = null);
}
