<?php

namespace App\Enums;

final class CurrencyEnum
{
    const USD = 1;
    const JPY = 2;
    const GBP = 3;
    const EUR = 4;

    /**
     * Get currency symbols as CSV
     *
     * @return string
     */
    public static function getSymbols()
    {
        return 'JPY,GBP,EUR';
    }
}
