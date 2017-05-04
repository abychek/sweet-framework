<?php

namespace SweetFramework\Controllers;

use Pimple\Container;
use SweetFramework\Twig\TwigTemplateEngine;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class MainController {

    /** @var Container $container */
    private $container;
    /** @var ..\SweetFramework\Entity\Book[] $books */
    private $books;

    function __construct($container, $books) {
        $this->container = $container;
        $this->books = $books;
    }

    public function renderAction(Request $request, $name = 'world')
    {
        /**
         * @return TwigTemplateEngine
         */
        $this->container['template_engine'] = function ()  {
            return new TwigTemplateEngine($this->container['twig.environment']);
        };

        /** @var TwigTemplateEngine $template */
        $template = $this->container['template_engine'];

       return new Response($template->render('books.html', array('books' => $this->books)));

    }

}