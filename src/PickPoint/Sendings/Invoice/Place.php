<?php

namespace Domatskiy\PickPoint\Invoice;

use Domatskiy\PickPoint\Invoice\Place\SubEnclose;

class Place
{
    /**
     * @var $SubEncloses SubEnclose[]
     */

    private $Width,
            $Height,
            $Depth,
            $BarCode = '',
            $GCBarCode = '',
            $SubEncloses = array();

    /**
     * Place constructor.
     * @param $Width / Ширина, обязательное поле (число, два знака после запятой)
     * @param $Height / Высота, обязательное поле (число, два знака после запятой)
     * @param $Depth / Глубина, обязательное поле (число, два знака после запятой)
     * @param string $BarCode / Штрих код от PickPoint. Отправляйте поле пустым, в ответ будет ШК (50 символов)
     * @param string $GCBarCode / Клиентский штрих-код. Поле не обязательное. Можно не отправлять (255 символов)
     * @param array $SubEncloses
     * @throws \Exception
     */
    function __construct($Width, $Height, $Depth, $BarCode = '', $GCBarCode = '', $SubEncloses = array())
    {
            $this->Width = $Width;
            $this->Height = $Height;
            $this->Depth = $Depth;
            $this->BarCode = $BarCode;
            $this->GCBarCode = $GCBarCode;
            $this->SubEncloses = $SubEncloses;

            foreach ($this->SubEncloses as $SubEnclose)
            {
                if(!($SubEnclose instanceof SubEnclose))
                    throw new \Exception('SubEnclose need as array SubEnclose');
            }
    }
}
