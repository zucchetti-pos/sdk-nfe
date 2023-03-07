<?php

namespace App\Modules\Core;

/**
 * @author Jonathan Muller Kunz <jonathanmullerkunz@gmail.com>
 */
class Identifier
{
    public static function isCPF($value)
    {
        return preg_match('/^[0-9]{11}$/', $value) ? true : false;
    }

    public static function isCNPJ($value)
    {
        return preg_match('/^[0-9]{14}$/', $value) ? true : false;
    }
}
