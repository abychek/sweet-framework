<?php

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

$routes->add(
    'render',
    new Route(
        '/render/{name}',
        [
            '_controller' => 'SweetFramework\Controllers\MainController::renderAction',
        ]
    )
);

return $routes;