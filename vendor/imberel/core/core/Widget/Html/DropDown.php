<?php

namespace Imberel\Imberel\Core\Widget\Html;

use Imberel\Imberel\Core\Interface\HtmlElement;

/**
 *  Class
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 */
class DropDown implements HtmlElement
{
    protected string $name;

    protected string|null $class;

    protected array $options;

    protected string|null $extra;

    protected string|null $value = '';

    public function __construct(string $name, array $options, string|null $class = null, string|null $extra = null)
    {
        $this->name = $name;
        $this->class = $class;
        $this->options = $options;
        $this->extra = $extra;
        $this->loop();
    }

    private function loop()
    {
        foreach ($this->options as $key => $value) {
            $this->value .= \sprintf('<option value="%s">%s</option>', $key, \ucwords($value));
        }
    }

    public function render(): string
    {
        return \printf(
            '
            <div class="input-space">
            <i class="%s"></i>
            <select name="%s" class="%s">%s</select>
            </div>
            ',
            $this->extra,
            $this->name,
            $this->class,
            $this->value
        );
    }
}