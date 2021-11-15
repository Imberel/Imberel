<?php

namespace Imberel\Imberel\Core\Widget\Html\Form;

use Imberel\Imberel\Core\Interface\HtmlElement;

/**
 *  Class
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 */
class FormTitle extends Field implements HtmlElement
{
    protected string $text;

    protected string|null $class;

    public function __construct(string $text, string|null $class = null)
    {
        $this->text = $text;
        $this->class = $class;
    }

    public function render(): string
    {
        return \sprintf(
            '  
        <div class="%s">
            %s
        </div>',
            $this->class,
            \ucwords($this->text)
        );
    }
}