<?php

namespace Imberel\Imberel\Core\Widget\Html;

use Imberel\Imberel\Core\Interface\HtmlElement;

/**
 *  Class
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 */
class Link implements HtmlElement
{
    protected string|null $class;

    private string $link;

    private string $text;

    public function __construct(string $link, string $text, $class = null)
    {
        $this->class = $class;
        $this->link = $link;
        $this->text = $text;
    }

    public function render(): string
    {
        return \sprintf(
            '
        <div class="input-space">
            <a class="%s" href="%s">%s</a>
        </div>',
            $this->class,
            $this->link,
            \ucwords($this->text)
        );
    }
}