<?php

namespace Domatskiy\PickPoint;

use Domatskiy\PickPoint\Exception\ValidateException;
use Domatskiy\PickPoint\Invoice\ClientReturnAddress;
use Domatskiy\PickPoint\Invoice\UnclaimedReturnAddress;

class Invoice implements \ArrayAccess
{
    const POSTAGE_TYPE_STANDART = 10001; #Стандарт. Оплаченный заказ. При этом поле «Sum=0»
    #const POSTAGE_TYPE_PRIORITET = 10002;
    const POSTAGE_TYPE_STANDART_NP = 10003; # Стандарт НП Отправление с наложенным платежом. Поле «Sum>0»
    #const POSTAGE_TYPE_ = 10004;

    const GETTING_TYPE_CURIER = 101;
    const GETTING_TYPE_SC = 102;

    const PAY_TYPE = 1;

    #const GETTING_TYPE_PT = 103;
    #const GETTING_TYPE_PT_USELF = 104;

    protected $data = [];

    public function getPostageTypes()
    {
        return [
            self::POSTAGE_TYPE_STANDART => 'Стандарт. Оплаченный заказ.',
            self::POSTAGE_TYPE_STANDART_NP => 'Стандарт НП Отправление с наложенным платежом.',
        ];
    }

    public function getGettingTypes()
    {
        return [
            self::GETTING_TYPE_CURIER => 'Курьер',
            self::GETTING_TYPE_SC => 'СЦ',
        ];
    }

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

    function __construct($SenderCode, $Description, $RecipientName, $PostamatNumber, $MobilePhone, $Email, $PostageType, $GettingType, $PayType, $Sum, $InsuareValue, ClientReturnAddress $ClientReturnAddress, UnclaimedReturnAddress $UnclaimedReturnAddress, array $Places)
    {
        if(strlen($SenderCode) > 50)
            throw new ValidateException('not correct $SenderCode, max length 50');

        if(strlen($Description) > 200)
            throw new ValidateException('not correct $Description, max length 200');

        if(strlen($RecipientName) > 150)
            throw new ValidateException('not correct $Description, max length 150');

        if(strlen($PostamatNumber) > 8)
            throw new ValidateException('not correct $PostamatNumber, max length 8');

        if(strlen($MobilePhone) > 100)
            throw new ValidateException('not correct $MobilePhone, max length 100');

        if(strlen($Email) > 256)
            throw new ValidateException('not correct $Email, max length 256');

        if(!array_key_exists($PostageType, self::getPostageTypes()))
            throw new ValidateException('not correct $PostageType');

        if(!array_key_exists($GettingType, self::getGettingTypes()))
            throw new ValidateException('not correct $GettingType');

        if($PayType != self::PAY_TYPE)
            throw new ValidateException('not correct $PayType');

        if($PostageType == self::POSTAGE_TYPE_STANDART && $Sum > 0)
            throw new ValidateException('not correct $Sum for this postage type');

        if($PostageType == self::POSTAGE_TYPE_STANDART && $Sum == 0)
            throw new ValidateException('not correct $Sum for this postage type');

        $this->data['SenderCode'] = $SenderCode;
        $this->data['Description'] = $Description;
        $this->data['RecipientName'] = $RecipientName;
        $this->data['PostamatNumber'] = $PostamatNumber;
        $this->data['MobilePhone'] = $MobilePhone;
        $this->data['Email'] = $Email;

        $this->data['PostageType'] = $PostageType;
        $this->data['GettingType'] = $GettingType;
        $this->data['PayType'] = $PayType;
        $this->data['InsuareValue'] = 0;

        $this->data['ClientReturnAddress'] = $ClientReturnAddress;
        $this->data['UnclaimedReturnAddress'] = $UnclaimedReturnAddress;
        $this->data['Places'] = $Places;
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