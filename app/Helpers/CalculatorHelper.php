<?php

namespace App\Helpers;

class CalculatorHelper
{
    public static function discount($amount, $percent)
    {
        return $amount - ($amount * $percent / 100);
    }

    public static function add($a, $b)
    {
        return $a + $b;
    }

    public static function subtract($a, $b)
    {
        return $a - $b;
    }
}
