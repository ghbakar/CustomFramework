<?php


namespace App\core;

class Response
{
    /**
     * get or set Http response
     */
    public function setStatusCode(int $code)
    {
        http_response_code($code);
    }
}
