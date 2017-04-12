<?php

namespace Domatskiy\PickPoint\Type;

use Domatskiy\PickPoint\Exception\APIException;

class ZoneList extends Type
{
    /**
     * @var Zone[]
     */
    public $data = [];

    /**
     * CityList constructor.
     * @param array $data
     */
    function __construct(array $data)
    {
        if(!array_key_exists('Zones', $data))
            throw new APIException('Zones not found');

        foreach ($data['Zones'] as $zone)
            $this->data[] = new Zone($zone);
    }
}