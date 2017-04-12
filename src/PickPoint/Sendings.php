<?php


namespace Domatskiy\PickPoint;

use Domatskiy\PickPoint\Sending\Invoice;
use Domatskiy\PickPoint\Sendings\Sending;
use Domatskiy\PickPoint\Type\File;
use Domatskiy\PickPoint\Type\InvoiceList;
use Domatskiy\PickPoint\Type\Result;

class Sendings extends Request
{

    /**
     * @desc Регистрация отправлений (одноместных)
     * @param Sending $sendings[]
     * @return Sendings
     */
    public function createSending(array $sendings)
    {
        /**
         * @var $result Sendings
         */
        $result = $this->__request(self::METHOD_POST, '/createsending', Sendings::class, [
            'Sendings' => $sendings
            ]);

        return $result;
    }

    /**
     * @desc Регистрация отправлений (многоместных)
     * @param Sending $sendings[]
     * @return Sendings
     */
    public function createShipment(array $sendings)
    {
        /**
         * @var $result Sendings
         */
        $result = $this->__request(self::METHOD_POST, '/CreateShipment', Sendings::class, [
            'Sendings' => $sendings
            ]);

        return $result;
    }

    /**
     * @desc Формирование этикеток pdf для принтера Zebra
     * @param array $invoiceNum
     * @return File
     */
    public function makeZLabel(array $invoiceNum)
    {
        /**
         * @var $result File
         */
        $result = $this->__request(self::METHOD_POST, '/makeZLabel', File::class, [
            'Invoices' => $invoiceNum
            ]);

        return $result;
    }

    /**
     * @desc Формирование реестра (по списку отправлений) в pdf
     * @param $CityName
     * @param $RegionName
     * @param array $invoiceNum
     * @return File
     */
    public function makeReestr($CityName, $RegionName, array $invoiceNum)
    {
        /**
         * @var $result File
         */
        $result = $this->__request(self::METHOD_POST, '/makereestr', File::class, [
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
     * @return File
     */
    public function makeReestrNumber($CityName, $RegionName, array $invoiceNum)
    {
        /**
         * @var $result File
         */
        $result = $this->__request(self::METHOD_POST, '/makereestr', File::class, [
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
     * @return Result
     */
    public function removeInvoiceFromReestr($IKN, $InvoiceNumber, $SenderCode)
    {
        /**
         * @var $result Result
         */
        $result = $this->__request(self::METHOD_POST, '/removeinvoicefromreestr', Result::class, [
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
     * @return Result
     */
    public function updateInvoice($InvoiceNumber, $GCInvoiceNumber, $PostamatNumber = '', $Phone = '', $RecipientName = '', $Email = '', $Sum = 0)
    {
        /**
         * @var $result Result
         */
        $result = $this->__request(self::METHOD_POST, '/updateInvoice', Result::class, [
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

    /**
     * @param $InvoiceNumber
     * @param $GCInvoiceNumber
     * @return Result
     */
    public function cancelInvoice($InvoiceNumber, $GCInvoiceNumber)
    {
        /**
         * @var $result Result
         */
        $result = $this->__request(self::METHOD_POST, '/cancelInvoice', Result::class, [
            'InvoiceNumber' => $InvoiceNumber,
            'GCInvoiceNumber' => $GCInvoiceNumber,
            ]);

        return $result;
    }

    /**
     * @param $InvoiceNumber
     * @param $SenderInvoiceNumber
     * @return InvoiceList
     */
    public function trackSending($InvoiceNumber, $SenderInvoiceNumber)
    {
        /**
         * @var $result InvoiceList
         */
        $result = $this->__request(self::METHOD_POST, '/tracksending', InvoiceList::class, [
            'InvoiceNumber' => $InvoiceNumber,
            'SenderInvoiceNumber' => $SenderInvoiceNumber,
            ]);

        return $result;
    }
}