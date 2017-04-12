<?php

/**
'EDTN':	'<Идентификатор запроса, используемый для ответа. Указывайте уникальное число (50 символов)>',
'IKN': '<ИКН – номер договора (10 символов)>',
'Invoice':
 */

namespace Domatskiy\PickPoint\Sendings;

use Domatskiy\PickPoint\Invoice;

class Sending implements \ArrayAccess
{
    protected $data = [];

    /**
     * Sending constructor.
     * @param $EDTN / <Идентификатор запроса, используемый для ответа. Указывайте уникальное число (50 символов)>
     * @param $IKN / ИКН – номер договора (10 символов)
     * @param Invoice $Invoice
     */
    function __construct($EDTN, $IKN, Invoice $Invoice)
    {
        $this->data['EDTN'] = $EDTN;
        $this->data['IKN'] = $IKN;
        $this->data['Invoice'] = $Invoice;
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