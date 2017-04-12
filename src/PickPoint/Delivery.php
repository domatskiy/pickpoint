<?php

namespace Domatskiy\PickPoint;

class Delivery extends Request
{
    /**
     * @param $FromCity /город отправитель груза, обязательное поле
     * @param $ToPT / Номер пункта выдачи
     * @return RequestResult
     */
    public function getzone($FromCity, $ToPT)
    {
        $result = $this->__request(self::METHOD_POST, '/getzone', [
            'FromCity' => $FromCity,
            'ToPT' => $ToPT,
            ]);

        return $result;
    }


    public function calctariff($IKN, $FromCity, $FromRegion, $PTNumber, $EncloseCount = 1, $Length, $Depth, $Width, $Weight = 1)
    {
        # Данная функция работает только на Рабочей версии сервиса

        $result = $this->__request(self::METHOD_POST, '/getzone', [
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