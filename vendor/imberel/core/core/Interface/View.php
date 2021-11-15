<?php

namespace Imberel\Imberel\Core\Interface;

/**
 *  Class
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 */
interface View
{
    public function view(string $view, array $params): string;

    public function layout(): string;

    public function render(string $view, array $params): string;
}