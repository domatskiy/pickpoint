<?php

namespace Domatskiy\PickPoint\Type;

class StateList extends Type
{
    /**
     * @var City[]
     */
    public $data = [];

    /**
     * StateList constructor.
     * @param array $data
     */
    function __construct(array $data)
    {
        foreach ($data as $state)
            $this->data[] = new State($state);
    }
}