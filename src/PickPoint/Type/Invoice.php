<?php

namespace Domatskiy\PickPoint\Type;

class Invoice extends Type
{
    public $InvoiceNumber;
    public $SenderInvoiceNumber;
    public $ChequeNumber;
    public $PayType;

    /**
     * @var RefundInfo
     */
    public $RefundInfo;
    /**
     * @var ReturnInfo
     */
    public $ReturnInfo;

    /**
     * @var InvoiceState[]
     */
    public $States;
}