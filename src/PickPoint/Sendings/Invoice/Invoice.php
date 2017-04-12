<?php

namespace Domatskiy\PickPoint\Sending;

use Domatskiy\PickPoint\Request;

class Invoice implements \ArrayAccess
{
    protected $data = [];

    /*
    'SenderCode':	'<Номер заказа магазина (50 символов)>',
    ‘Description':	'<Описание отправления, обязательное поле (200 символов)>',
    'RecipientName':	'<Имя получателя (150 символов)>',
    'PostamatNumber':	'<Номер постамата, обязательное поле (8 символов)>',
    'MobilePhone': '<один номер телефона получателя, обязательное поле(100 символов)>',
    'Email': '<Адрес электронной почты получателя (256 символов)>',
    'PostageType': <Тип услуги, (см. таблицу ниже) обязательное поле >,
    'GettingType': <Тип сдачи отправления, (см. таблицу ниже) обязательное поле >,
    'PayType': <Тип оплаты, (см. таблицу ниже) обязательное поле >,
    'Sum': <Сумма, обязательное поле (число, два знака после запятой)>,
    'InsuareValue':	<Страховка (число, два знака после запятой)>,
    'ClientReturnAddress':	'<Адрес клиентского возврата>' Данный блок можно не передавать. Если передаете, то необходимо заполнение всех полей блока.
    'UnclaimedReturnAddress':	'<Адрес возврата невостребованного >' Данный блок можно не передавать. Если передаете, то необходимо заполнение всех полей блока.
    'Places':
    */


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