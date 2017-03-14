<?php

namespace Domatskiy\PickPoint;


class RequestResult
{
    const ERROR_UNFORESEEN = -1;
    const ERROR_SESSION = 1;
    const ERROR_AUTH = 10;
    const ERROR_QUERY_PARAMS = 20;
    const ERROR_NOT_FOUND = 21;
    const ERROR_NOT_FOUND_DEPARTURE = 25;
    const ERROR_INVALID_CONTRACT_NUMBER = 30;
    const ERROR_NOT_FOUND_SUBCLIENT = 35;
    const ERROR_TEMPORARY = 100;

    private $errors = array();
    private $data = array();
    private $url = array();

    function __construct()
    {

    }

    /**
     * @return bool
     */
    public function isSuccess()
    {
        return empty($this->errors);
    }

    /**
     * @return array
     */
    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }
    /**
     * @param $code
     * @param string $message
     */
    public function setError($code, $message = '')
    {
        if(!$message)
            $message = self::getErrorMessagesByCode($code);

        $this->errors[$code] = $message;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function setData(array $data)
    {
        $this->data = $data;
    }

    /**
     * @param $code
     * @return mixed|null
     */
    public static function getErrorMessagesByCode($code)
    {
        $messages = [
            self::ERROR_UNFORESEEN => 'Непредвиденная ошибка',
            self::ERROR_SESSION => 'Неверная сессия или сессия истекла',
            self::ERROR_AUTH => 'Неверный логин или пароль',
            self::ERROR_QUERY_PARAMS => 'Неверные параметры запроса',
            self::ERROR_NOT_FOUND => 'Данные не найдены',
            self::ERROR_NOT_FOUND_DEPARTURE => 'Отправление не найдено',
            self::ERROR_INVALID_CONTRACT_NUMBER => 'Неверный номер контракта',
            self::ERROR_NOT_FOUND_SUBCLIENT => 'Субклиент не найден',
            self::ERROR_TEMPORARY => 'Временная ошибка',
            ];

        if(array_key_exists($code, $messages))
            return $messages[$code];

        return null;
    }

}