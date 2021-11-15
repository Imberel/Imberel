<?php

namespace Imberel\Imberel\Core\Widget\Html\Form;

use Imberel\Imberel\Core\Interface\HtmlElement;

/**
 *  Class
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 */
class Form implements HtmlElement
{
    private string $method;

    private string|null $action;

    private bool $multipart;

    public function __construct(string $method = "get", string|null $action = null, bool $multipart = false)
    {
        $this->method = $method;
        $this->action = $action;
        $this->multipart = $multipart;
    }

    /**
     * Add Elements for the Form
     *
     * @param \Imberel\Widgets\HtmlElement $el
     *
     * @return void
     */
    public function add(HtmlElement $el): void
    {
        $this->elements[] = $el;
    }


    final public function render(): string
    {
        $content = \implode(PHP_EOL, \array_map(fn ($el) => $el->render(), $this->elements));
        if ($this->multipart === true) {
            return \printf(
                '
        <div class="form">
        <form action="%s" method="%s" enctype="multipart/form-data">%s
        </form>
        </div>
        ',
                $this->action,
                $this->method,
                $content
            );
        }

        return \printf(
            '
        <div class="form">
        <form action="%s" method="%s">%s
        </form>
        </div>
        ',
            $this->action,
            $this->method,
            $content
        );
    }
}