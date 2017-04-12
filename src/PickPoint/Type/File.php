<?php

namespace Domatskiy\PickPoint\Type;

class File extends Type
{
    public $file;

    function __construct($file)
    {
        $this->file = $file;
    }
}