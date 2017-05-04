<?php
/**
 * Created by PhpStorm.
 * User: marina
 * Date: 16.04.17
 * Time: 10:35
 */

namespace SweetFramework\Controllers;

use Pimple\Container;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController
{
    /** @var Container $container */
    private $container;

    function __construct($container) {
        $this->container = $container;
    }

    public function helloAction(Request $request, $name = 'world')
    {
        return new Response("Hello " . $name, Response::HTTP_BAD_REQUEST);
    }

    public function byeAction(Request $request, $name = 'world')
    {
        return new Response("Bye " . $name);
    }
}