<?php

namespace Domatskiy\PickPoint;

use Domatskiy\PickPoint\Type\CalcResult;
use Domatskiy\PickPoint\Type\Zone;
use Domatskiy\PickPoint\Type\ZoneList;

class Delivery extends Request
{
    /**
     * @param $FromCity /город отправитель груза, обязательное поле
     * @param $ToPT / Номер пункта выдачи
     * @return ZoneList
     */
    public function getzone($FromCity, $ToPostomat)
    {
        /**
         * @var $result ZoneList
         */
        $result = $this->__request(self::METHOD_POST, '/getzone', ZoneList::class, [
            'FromCity' => $FromCity,
            'ToPT' => $ToPostomat,
            ]);

        return $result;
    }


    public function calctariff($IKN, $FromCity, $FromRegion, $PTNumber, $EncloseCount = 1, $Length, $Depth, $Width, $Weight = 1)
    {
        if($this->is_test)
            $IKN = $this->IKN_test;

        # Данная функция работает только на Рабочей версии сервиса

        $result = $this->__request(self::METHOD_POST, '/calctariff', CalcResult::class, [
            'IKN' => $IKN,
            'FromCity' => $FromCity,
            'FromRegion' => $FromRegion,
            'PTNumber' => $PTNumber,
            'EncloseCount' => $EncloseCount,
            'Length' => $Length,
            'Depth' => $Depth,
            'Width' => $Width,
            'Weight' => $Weight,
            ]);

        return $result;
    }

}