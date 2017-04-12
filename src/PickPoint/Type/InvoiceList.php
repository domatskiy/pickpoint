<?php

namespace Domatskiy\PickPoint\Type;

class InvoiceList extends Type
{
    /**
     * @var Invoice[]
     */
    public $data = [];

    /**
     * InvoiceList constructor.
     * @param array $data
     */
    function __construct(array $data)
    {
        foreach ($data as $city)
            $this->data[] = new City($city);
    }
}