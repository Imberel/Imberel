<?php

namespace Imberel\Imberel\Core\Response;

/**
 *  Class
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 */
class Response
{
    final public function responseCode(int $code): void
    {
        \http_response_code($code);
        return;
    }

    public function redirect(string $location)
    {
        \header("location: $location");
    }

    public function refresh(int $duration, string $location)
    {
        \header("refresh: $duration url=$location");
    }
}