<?php
/**
 * Created by PhpStorm.
 * User: marina
 * Date: 16.04.17
 * Time: 10:35
 */

namespace SweetFramework\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController
{
    public function helloAction(Request $request, $name = 'world')
    {
        return new Response("Hello " . $name);
    }

    public function byeAction(Request $request, $name = 'world')
    {
        return new Response("Bye " . $name);
    }
}