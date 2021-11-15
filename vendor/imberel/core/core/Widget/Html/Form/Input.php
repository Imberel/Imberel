<?php

namespace Imberel\Imberel\Core\Widget\Html\Form;

use Imberel\Imberel\Core\Interface\HtmlElement;

/**
 *  Class
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 */
class Input extends Field implements HtmlElement
{
    private string $type;

    private string|null $extra;

    private object $model;

    public function __construct(object $model, string $type, string $label, string $name, string $class = null, string|null $extra = null)
    {
        parent::__construct($label, $name, $class);
        $this->type = $type;
        $this->extra = $extra;
        $this->model = $model;
    }

    public function render(): string
    {
        return \sprintf(
            '
            <div class="input-space">
                <i class="%s"></i>
                <input type="%s" name="%s" value="%s" class="%s" placeholder="%s">
            </div>
            <div class="error">%s</div>
            
        ',
            $this->extra,
            $this->type,
            $this->name,
            $this->model->{$this->name},
            $this->model->hasError($this->name) ? 'is_invalid' : $this->class,
            \ucwords($this->label),
            $this->model->hasError($this->name) ? \ucwords($this->model->getError($this->name)) : null

        );
    }
}