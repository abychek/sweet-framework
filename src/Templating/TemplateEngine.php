<?php

namespace SweetFramework\Templating;

interface TemplateEngine
{
    public function render($template, array $values);
}
