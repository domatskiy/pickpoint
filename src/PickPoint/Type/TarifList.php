<?php

namespace Domatskiy\PickPoint\Type;

class TarifList extends Type
{
    /**
     * @var Tarif[]
     */
    public $data = [];

    /**
     * StateList constructor.
     * @param array $data
     */
    function __construct(array $data)
    {
        foreach ($data as $tarif)
            $this->data[] = new Tarif($tarif);
    }
}