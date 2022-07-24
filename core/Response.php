<?php

namespace app\core;

class Response
{
    public function getStatus($url)
    {
        return http_response_code($url);
    }

    public function redirect($url)
    {
        header("Location: $url");
    }
}
