<?php

namespace Domatskiy\PickPoint\Type;

class CalcResult extends Type
{
    /**
     * @var TarifList[]
     */
    public $Services = [];

    public $InvoiceNumber = [];
    public $DPMin = [];
    public $DPMax = [];
    public $Zone = [];


    /**
     * StateList constructor.
     * @param array $data
     */
    function __construct(array $data)
    {
        foreach ($data as $key => $value)
        {
            if($key == 'Services')
                $this->data[$key] = new TarifList($value);
            else
                $this->data[$key] = new Tarif($value);
        }

    }
}