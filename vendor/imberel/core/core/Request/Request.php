<?php

namespace Imberel\Imberel\Core\Request;

/**
 *  Class
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 */
class Request
{
    protected array $body = [];

    public function path(): string
    {
        return $_SERVER['PATH_INFO'] ?? '/';
    }

    public function method(): string
    {
        return \strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function body(): array
    {
        if ($this->method() === 'get') {
            foreach ($_GET as $key => $value) {
                $this->body[$key] = \filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        if ($this->method() === 'post') {
            foreach ($_POST as $key => $value) {
                $this->body[$key] = \filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        return $this->body;
    }

    public function isPost(): bool
    {
        return $this->method() === 'post';
    }

    public function isGet(): bool
    {
        return $this->method() === 'get';
    }
}