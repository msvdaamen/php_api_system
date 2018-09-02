<?php
/**
 * Created by PhpStorm.
 * User: msvda
 * Date: 2-9-2018
 * Time: 13:58
 */

namespace App\Helpers;


class StringHelper
{
    public static function toUpperCase(string $string) {
        return strtoupper($string);
    }

    public static function toLowerCase(string $string) {
        return strtolower($string);
    }
}