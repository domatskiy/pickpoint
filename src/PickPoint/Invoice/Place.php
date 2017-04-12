<?php

namespace Domatskiy\PickPoint\Invoice;

use Domatskiy\PickPoint\Invoice\Place\SubEnclose;

class Place implements \ArrayAccess
{
    private $data = [];

    /**
     * Place constructor.
     * @param $Width / Ширина, обязательное поле (число, два знака после запятой)
     * @param $Height / Высота, обязательное поле (число, два знака после запятой)
     * @param $Depth / Глубина, обязательное поле (число, два знака после запятой)
     * @param string $BarCode / Штрих код от PickPoint. Отправляйте поле пустым, в ответ будет ШК (50 символов)
     * @param string $GCBarCode / Клиентский штрих-код. Поле не обязательное. Можно не отправлять (255 символов)
     * @param SubEnclose $SubEncloses[]
     * @throws \Exception
     */
    function __construct($Width, $Height, $Depth, $BarCode = '', $GCBarCode = '', array $SubEncloses = array())
    {
            $this->data['Width'] = $Width;
            $this->data['Height'] = $Height;
            $this->data['Depth'] = $Depth;
            $this->data['BarCode'] = $BarCode;
            $this->data['GCBarCode'] = $GCBarCode;
            $this->data['SubEncloses'] = $SubEncloses;

            foreach ($this->data['SubEncloses'] as $SubEnclose)
            {
                if(!($SubEnclose instanceof SubEnclose))
                    throw new \Exception('SubEnclose need as array SubEnclose');
            }
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
