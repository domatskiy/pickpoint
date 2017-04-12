<?php


namespace Domatskiy\PickPoint;

use Domatskiy\PickPoint\Sending\Invoice;
use Domatskiy\PickPoint\Sendings\Sending;

class Sendings extends Request
{

    /**
     * @desc Регистрация отправлений (одноместных)
     * @param Sending $sendings[]
     * @return RequestResult
     */
    public function createsending(array $sendings)
    {
        $result = $this->__request(self::METHOD_POST, '/createsending', [
            'Sendings' => $sendings
            ]);

        return $result;
    }

    /**
     * @desc Регистрация отправлений (многоместных)
     * @param Sending $sendings[]
     * @return RequestResult
     */
    public function createShipment(array $sendings)
    {
        $result = $this->__request(self::METHOD_POST, '/CreateShipment', [
            'Sendings' => $sendings
        ]);

        return $result;
    }

    /**
     * @desc Формирование этикеток pdf для принтера Zebra
     * @param array $invoiceNum
     * @return RequestResult
     */
    public function makeZLabel(array $invoiceNum)
    {
        $result = $this->__request(self::METHOD_POST, '/makeZLabel', [
            'Invoices' => $invoiceNum
            ]);

        return $result;
    }

    /**
     * @desc Формирование реестра (по списку отправлений) в pdf
     * @param $CityName
     * @param $RegionName
     * @param array $invoiceNum
     * @return RequestResult
     */
    public function makeReestr($CityName, $RegionName, array $invoiceNum)
    {
        $result = $this->__request(self::METHOD_POST, '/makereestr', [
            'CityName' => $CityName,
            'RegionName' => $RegionName,
            'Invoices' => $invoiceNum
        ]);

        return $result;
    }

    /**
     * @desc Формирование реестра (по списку отправлений)
     * @param $CityName
     * @param $RegionName
     * @param array $invoiceNum
     * @return RequestResult
     */
    public function makeReestrNumber($CityName, $RegionName, array $invoiceNum)
    {
        $result = $this->__request(self::METHOD_POST, '/makereestr', [
            'CityName' => $CityName,
            'RegionName' => $RegionName,
            'Invoices' => $invoiceNum
            ]);

        return $result;
    }

    /**
     * @desc Удаление отправления из реестра
     * @param $IKN
     * @param $InvoiceNumber
     * @param $SenderCode
     * @return RequestResult
     */
    public function removeInvoiceFromReestr($IKN, $InvoiceNumber, $SenderCode)
    {
        $result = $this->__request(self::METHOD_POST, '/removeinvoicefromreestr', [
            'IKN' => $IKN,
            'InvoiceNumber' => $InvoiceNumber,
            'SenderCode' => $SenderCode
        ]);

        return $result;
    }

    /**
     * @param $InvoiceNumber
     * @param $GCInvoiceNumber
     * @param string $PostamatNumber
     * @param string $Phone
     * @param string $RecipientName
     * @param string $Email
     * @param int $Sum
     * @return RequestResult
     */
    public function updateInvoice($InvoiceNumber, $GCInvoiceNumber, $PostamatNumber = '', $Phone = '', $RecipientName = '', $Email = '', $Sum = 0)
    {
        $result = $this->__request(self::METHOD_POST, '/updateInvoice', [
            'InvoiceNumber' => $InvoiceNumber,
            'GCInvoiceNumber' => $GCInvoiceNumber,
            'PostamatNumber' => $PostamatNumber,
            'Phone' => $Phone,
            'RecipientName' => $RecipientName,
            'Email' => $Email,
            'Sum' => $Sum,
            ]);

        return $result;
    }

    public function cancelInvoice($InvoiceNumber, $GCInvoiceNumber)
    {
        $result = $this->__request(self::METHOD_POST, '/cancelInvoice', [
            'InvoiceNumber' => $InvoiceNumber,
            'GCInvoiceNumber' => $GCInvoiceNumber,
            ]);

        return $result;
    }

    public function trackSending($InvoiceNumber, $SenderInvoiceNumber)
    {
        $result = $this->__request(self::METHOD_POST, '/tracksending', [
            'InvoiceNumber' => $InvoiceNumber,
            'SenderInvoiceNumber' => $SenderInvoiceNumber,
        ]);

        return $result;
    }
}