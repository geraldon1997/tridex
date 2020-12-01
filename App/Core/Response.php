<?php
namespace App\Core;

class Response
{
    public static function code(int $code)
    {
        return http_response_code($code);
    }

    public static function redirect($url)
    {
        return header('location:'.$url);
    }
}
