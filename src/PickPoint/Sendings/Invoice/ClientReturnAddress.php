<?php

namespace Domatskiy\PickPoint;

class ClientReturnAddress implements \ArrayAccess
{
    protected $data = [];

    function __construct($CityName, $RegionName, $Address, $FIO, $PostCode, $Organisation, $PhoneNumber, $Comment)
    {
        $this->data = [
            'CityName' => $CityName,
            'RegionName' => $RegionName,
            'Address' => $Address,
            'FIO' => $FIO,
            'PostCode' => $PostCode,
            'Organisation' => $Organisation,
            'PhoneNumber' => $PhoneNumber,
            'Comment' => $Comment,
            ];
    }

    public function offsetExists($offset)
    {
        return isset($this->data[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->offsetExists($offset) ? $this->data[$offset] : null;
    }

    public function offsetSet($offset, $value)
    {
        if (is_null($offset))
            $this->data[] = $value;
        else
            $this->data[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        if ($this->offsetExists($offset))
            unset($this->data[$offset]);
    }
}