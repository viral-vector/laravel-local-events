<?php
/**
 * Created by PhpStorm.
 * User: viral
 * Date: 6/23/2018
 * Time: 12:51 PM
 */

namespace ViralVector\LocalEvents\Contracts;


interface LocalEventMappingInterface
{
    public function getMap();

    public function format($data): ?callable;
}