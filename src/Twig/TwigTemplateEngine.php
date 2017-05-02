<?php

namespace SweetFramework\Twig;

use SweetFramework\Templating\TemplateEngine;
use Twig_Environment as Twig;

class TwigTemplateEngine implements TemplateEngine
{
    /** @var Twig */
    private $twig;

    public function __construct(Twig $twig)
    {
        $this->twig = $twig;
    }

    public function render($template, array $values)
    {
        return $this->twig->render($template, $values);
    }
}
