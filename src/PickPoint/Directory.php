<?php

namespace Domatskiy\PickPoint;

use Domatskiy\PickPoint\Type\CityList;
use Domatskiy\PickPoint\Type\PostomatList;
use Domatskiy\PickPoint\Type\StateList;

class Directory extends Request
{
    /**
     * @desc Получение справочника статусов отправления
     * @return StateList
     */
    public function getstates()
    {
        /**
         * @var $rs StateList
         */
        $rs = $this->__request(self::METHOD_GET, '/getstates', StateList::class);

        return $rs;
    }

    /**
     * @return CityList
     */
    public function citylist()
    {
        /**
         * @var $rs CityList
         */
        $rs = $this->__request(self::METHOD_GET, '/citylist', CityList::class);

        return $rs;
    }

    /**
     * @return PostomatList
     */
    public function postamatlist()
    {
        /**
         * @var $rs PostomatList
         */
        $rs = $this->__request(self::METHOD_GET, '/postamatlist', PostomatList::class);

        return $rs;
    }

}