<?php

namespace Imberel\Imberel\Core\Widget\Html;

use Imberel\Imberel\Core\Interface\HtmlElement;

/**
 *  Class
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 */
class Button implements HtmlElement
{
    private string $type;

    private string $name;

    private string $text;

    private string $class;

    public function __construct(string $type = 'button', string $text, string $name = 'button', string $class = '')
    {
        $this->type = $type;
        $this->text = $text;
        $this->name = $name;
        $this->class = $class;
    }

    public function render(): string
    {
        return \sprintf('<button type="%s" name="%s" class="%s">%s</button>', $this->type, $this->name, $this->class, \ucwords($this->text));
    }
}