<?php

namespace Imberel\Imberel\Http\Middleware;

use Imberel\Imberel\Core\Application\Middleware;

/**
 *  Class
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 */
class UserMiddleware extends Middleware
{
    public function handle()
    {
        if (core()->isGuest() && empty($this->actions)) {
            throw new \Exception("Forbidden", 403);
        }
    }
}