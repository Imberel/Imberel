<?php

namespace Imberel\Imberel\Core\Application;

use Imberel\Imberel\Core\Interface\Middleware as InterfaceMiddleware;

/**
 *  Class
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 */
abstract class Middleware implements InterfaceMiddleware
{
    /**
     * Array of Middleware Acrions
     *
     * @var array
     */
    public array $actions;

    public function __construct(array $actions = [])
    {
        $this->actions = $actions;
    }
}