<?php

require_once __DIR__ . '/vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

$routes = new RouteCollection();
$routes->add(
    'hello',
    new Route(
        '/hello/{name}',
        [
            '_controller' => 'SweetFramework\Controllers\DefaultController::helloAction',
        ]
    )
);
$routes->add(
    'bye',
    new Route(
        '/bye/{name}',
        [
            '_controller' => 'SweetFramework\Controllers\DefaultController::byeAction',
        ]
    )
);

$request = Request::createFromGlobals();
$context = new RequestContext();
$context->fromRequest($request);

$matcher = new UrlMatcher($routes, $context);

$path = $request->getPathInfo();

$parameters = $matcher->match($path);

$controller = explode('::', $parameters['_controller']);
$controllerName = $controller[0];
$actionName = $controller[1];
$controller = new $controllerName();
/** @var Response $response */
$response = $controller->$actionName($request, $parameters['name']);
$response->send();

