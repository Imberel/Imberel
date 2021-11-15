<?php

namespace Imberel\Imberel\Core\Widget\Html\Form;

use Imberel\Imberel\Core\Interface\HtmlElement;

/**
 *  Class
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 */
abstract class Field implements HtmlElement
{
    protected string $label;

    protected string $name;

    protected string|null $class;

    public function __construct(string $label, string $name, string|null $class)
    {
        $this->label = $label;
        $this->name = $name;
        $this->class = $class;
    }
}