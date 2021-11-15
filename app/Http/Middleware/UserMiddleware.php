<?php

namespace Imberel\Imberel\Http\Middleware;

use Imberel\Imberel\Core\Application\Core;
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
        if (Core::$core->isGuest()) {
            if (!empty($this->actions)) {
                throw new \Exception("Forbidden", 403);
            }
        }
    }
}
