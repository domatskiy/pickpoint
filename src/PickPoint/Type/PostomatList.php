<?php

namespace Domatskiy\PickPoint\Type;

class PostomatList extends Type
{
    /**
     * @var Postomat[]
     */
    public $data = [];

    /**
     * PostomatList constructor.
     * @param array $data
     */
    function __construct(array $data)
    {
        foreach ($data as $city)
            $this->data[] = new Postomat($city);
    }
}