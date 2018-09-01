<?php
/**
 * Created by PhpStorm.
 * User: msvda
 * Date: 1-9-2018
 * Time: 15:01
 */

namespace App\router;


class Response
{
    public static function response($data, int $code)
    {
        http_response_code($code);
        header('Content-Type: application/json');
        return json_encode($data);
    }
}