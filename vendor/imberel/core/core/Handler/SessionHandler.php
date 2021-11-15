<?php

namespace Imberel\Imberel\Core\Handler;

use Imberel\Imberel\Core\Connection\Connection;
use Imberel\Imberel\Core\Extra\Random;
use Imberel\Imberel\Core\Interface\Session;

/**
 *  Class
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 */
abstract class SessionHandler extends Connection implements Session
{
    private Random $random;

    public function __construct()
    {
        parent::__construct();
        $this->random = new Random;
        $this->setcookie();
        $this->storage();
    }

    public function setcookie()
    {
        if (empty($_COOKIE)) {
            \setcookie(collect('SESSID_NAME'), $this->random->string(35), \time() + \intval(collect('COOKIE_LIFETIME')));
            cons('USER_SESSION_ID,'
                . null);
            return;
        }

        cons('USER_SESSION_ID,'
            . $_COOKIE[collect('SESSID_NAME')]);
        return;
    }
}