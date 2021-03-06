<?php
/**
 * Created by PhpStorm.
 * User: viral
 * Date: 6/23/2018
 * Time: 12:34 PM
 */

namespace ViralVector\LocalEvents;


use ViralVector\LocalEvents\Contracts\LocalEventMappingInterface;

class CompoundMap implements LocalEventMappingInterface
{
    /**
     * @var array
     */
    private $map;

    /**
     * @var callable
     */
    private $cal;

    /**
     * CompoundMap constructor.
     * @param array $map
     * @param callable|null $cal
     */
    public function __construct(array $map, callable $cal = null)
    {
        $this->map = $map;
        $this->cal = $cal;
    }

    /**
     * @return mixed
     */
    public function getMap()
    {
        return $this->map;
    }

    /**
     * @param array $data
     * @return array
     */
    public function format(array $data)
    {
        if($this->cal) {
            $method = $this->cal;

            return $method($data);
        }

        return $data;
    }
}