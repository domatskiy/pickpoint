<?php
/**
 * Created by PhpStorm.
 * User: domatskiy
 * Date: 12.04.2017
 * Time: 19:02
 */

namespace Domatskiy\PickPoint\Exception;


use Throwable;

class ErrorException extends \Exception
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

    function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        if(!$message)
        {
            $arMess = self::getErrorMessages();

            if(array_key_exists($code, $arMess))
                $message = $arMess[$code];
        }

        parent::__construct($message, $code, $previous);
    }

    public static function getErrorMessages()
    {
        return [
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
    }
}