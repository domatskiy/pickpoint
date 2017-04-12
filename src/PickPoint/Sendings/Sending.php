<?php

/**
'EDTN':	'<Идентификатор запроса, используемый для ответа. Указывайте уникальное число (50 символов)>',
'IKN': '<ИКН – номер договора (10 символов)>',
'Invoice':
 */

namespace Domatskiy\PickPoint\Sendings;

use Domatskiy\PickPoint\Sending\Invoice;

class Sending implements \ArrayAccess
{
    protected $data = [];

    private $EDTN,
            $IKN,
            $Invoice;

    /**
     * Sending constructor.
     * @param $EDTN
     * @param $IKN
     * @param Invoice $Invoice
     */
    function __construct($EDTN, $IKN, Invoice $Invoice)
    {
        $this->EDTN = $EDTN;
        $this->IKN = $IKN;
        $this->Invoice = $Invoice;
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