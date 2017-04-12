<?php

namespace Domatskiy\PickPoint\Invoice;

class ClientReturnAddress implements \ArrayAccess
{
    protected $data = [];

    function __construct($CityName, $RegionName, $Address, $FIO, $PostCode, $Organisation, $PhoneNumber, $Comment)
    {
        if(strlen($CityName) > 50)
            throw new \Exception('not correct CityName, max length 50');

        if(strlen($RegionName) > 50)
            throw new \Exception('not correct RegionName, max length 50');

        if(strlen($Address) > 150)
            throw new \Exception('not correct Address, max length 150');

        if(strlen($FIO) > 150)
            throw new \Exception('not correct FIO, max length 150');

        if(strlen($PostCode) > 20)
            throw new \Exception('not correct PostCode, max length 20');

        if(strlen($Organisation) > 100)
            throw new \Exception('not correct Organisation, max length 20');

        if(strlen($Comment) > 255)
            throw new \Exception('not correct Comment, max length 255');

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