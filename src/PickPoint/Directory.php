<?php

namespace Domatskiy\PickPoint;

class Directory extends Request
{
    /**
     * @desc Получение справочника статусов отправления
     * @return RequestResult
     */
    public function getstates()
    {
        $result = $this->__request(self::METHOD_GET, '/getstates');

        return $result;
    }

    /**
     * @return RequestResult
     */
    public function citylist()
    {
        $result = $this->__request(self::METHOD_GET, '/citylist');

        return $result;
    }

    public function postamatlist()
    {
        $result = $this->__request(self::METHOD_GET, '/postamatlist');

        return $result;
    }



}