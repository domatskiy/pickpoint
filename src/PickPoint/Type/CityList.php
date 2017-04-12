<?php

namespace Domatskiy\PickPoint\Type;

class CityList extends Type
{
    /**
     * @var City[]
     */
    public $data = [];

    /**
     * CityList constructor.
     * @param array $data
     */
    function __construct(array $data)
    {
        foreach ($data as $city)
            $this->data[] = new City($city);
    }
}