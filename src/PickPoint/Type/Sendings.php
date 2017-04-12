<?php

namespace Domatskiy\PickPoint\Type;

class Sendings extends Type
{
    /**
     * @var CreatedSendings[]
     */
    public $CreatedSendings = [];

    /**
     * @var RejectedSendings[]
     */
    public $RejectedSendings = [];
}