<?php

namespace SweetFramework\Controllers;

use Pimple\Container;
use SweetFramework\Twig\TwigTemplateEngine;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class MainController {

    /** @var Container $container */
    private $container;

    function __construct($container) {
        $this->container = $container;
    }

    public function renderAction(Request $request)
    {
       return new Response($this->container['template_engine']->render('main.html', array()));
    }

    public function loginAction(Request $request)
    {
        return new Response($this->container['template_engine']->render('profile.html', array()));
    }
}