<?php

namespace App\Helpers;

class FormatRupiahHelper
{
    public static function currency($value)
    {
        return 'Rp. ' . number_format($value, 0, ',', '.');
    }
}
