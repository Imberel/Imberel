<?php

namespace Imberel\Imberel\Core\Extra;

use Imberel\Imberel\Core\Interface\Console;

/**
 *  Class
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 */
class DecideDisplay implements Console
{
    /**
     * Message to be Display
     *
     * @var mixed
     */
    private mixed $message;

    public mixed $package;

    final public function __construct(mixed $message, mixed $package)
    {
        $this->message = $message;
        $this->package = $package;
        $this->decide();
    }

    /**
     * Run and Decide is User is running on Browser or terminal
     *
     * @return void
     */
    private function decide(): void
    {
        if (empty($_SERVER['HTTP_USER_AGENT']) && empty($_SERVER['REMOTE_ADDRESS'])) {
            $this->log();
            exit;
        }

        return;
    }

    /**
     * Log Message if User is runnung on terminal
     *
     * @return void
     */
    public function log(): void
    {
        if ($this->package !== null) {
            print "[" . date("h:m:s D d M Y") . "]" . " - " . "$this->package Error: " . $this->message . PHP_EOL;
            return;
        }

        print "[" . date("h:m:s D d M Y") . "]" . " - " . $this->message . PHP_EOL;
        return;
    }
}