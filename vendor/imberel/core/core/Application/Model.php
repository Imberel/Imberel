<?php

namespace Imberel\Imberel\Core\Application;

use Imberel\Imberel\Core\Connection\Connection;
use Imberel\Imberel\Core\Request\Request;
use Imberel\Imberel\Core\Response\Response;

/**
 *  Class
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 */
class Model extends Connection
{

    public Request $request;

    public  Response $response;

    public function __construct()
    {
        $this->request = new Request;
        $this->response = new Response;
        parent::__construct();
    }

    /**
     * Loads Database
     *
     * @param array $data
     *
     * @return void
     */
    public function load(array $data): void
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }
}