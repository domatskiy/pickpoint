<?php
/**
 * Created by PhpStorm.
 * User: domatskiy
 * Date: 12.04.2017
 * Time: 18:52
 */

namespace Domatskiy\PickPoint\Type;

abstract class Type
{
    public $EDTN;

    function __construct(array $object)
    {
        $vars = array();

        if(is_object($object) && $object !== null)
            $vars = get_object_vars($object);
        elseif (is_array($object))
            $vars = $object;

        unset($object);

        foreach ($vars as $code => $value)
            $this->{$code} = $value;

    }
}