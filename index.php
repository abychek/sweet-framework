<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/src/Controllers/DefaultController.php';

use Pimple\Container;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

$container = new Container();

$loader = new Twig_Loader_Filesystem( __DIR__ . '/src/resources/templates');

$twig = new Twig_Environment($loader, array(
    'cache'       =>  __DIR__ . '/src/resources/compilation_cache',
    'auto_reload' => true
));

$books = array(
    array('number' => 'Книга 1', 'title' => 'Гарри Поттер и философский камень', 'date' => '30.06.1997'),
    array('number' => 'Книга 2', 'title' => 'Гарри Поттер и Тайная комната', 'date' => '2.07.1998'),
    array('number' => 'Книга 3', 'title' => 'Гарри Поттер и узник Азкабана', 'date' => '8.07.1999'),
    array('number' => 'Книга 4', 'title' => 'Гарри Поттер и Кубок огня', 'date' => '8.07.2000'),
    array('number' => 'Книга 5', 'title' => 'Гарри Поттер и Орден Феникса', 'date' => '21.07.2003'),
    array('number' => 'Книга 6', 'title' => 'Гарри Поттер и Принц-полукровка', 'date' => '16.07.2005'),
    array('number' => 'Книга 7', 'title' => 'Гарри Поттер и Дары Смерти', 'date' => '21.07.2007')
);

echo $twig->render('books.html', array('books' => $books));


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

