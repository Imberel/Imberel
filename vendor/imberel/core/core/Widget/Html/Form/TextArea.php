<?php

namespace Imberel\Imberel\Core\Widget\Html\Form;

use Imberel\Imberel\Core\Interface\HtmlElement;

/**
 *  Class
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 */
class TextArea extends Field implements HtmlElement
{
    public function __construct(string $label, string $name, string $class = null)
    {
        parent::__construct($label, $name, $class);
    }

    public function render(): string
    {
        return \sprintf(
            '
            <div>
            <textarea name="%s" placeholder="%s" class="%s">%s</textarea>
            </div>
        ',
            $this->name,
            \ucwords($this->label),
            $this->model->hasError($this->name) ? 'is_invalid' : $this->class,
            $this->model->{$this->name}
        );
    }
}