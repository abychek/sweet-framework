<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/app/config/routing.php';

use Doctrine\ORM\EntityManager;
use SweetFramework\BaseContainer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;

$options = require __DIR__ . '/app/config/config.php';

$container = new BaseContainer($options);

/** @var EntityManager $em */
$em = $container['doctrine.em'];

/** @var SweetFramework\Entity\Book $bok */
$bok = new SweetFramework\Entity\Book();
$bok->setNumber("1");
$bok->setTitle("Book1");
$bok->setDate("23/04/17");
$em->persist($bok);
$em->flush();

$bookRepository = $em->getRepository('SweetFramework\Entity\Book');

$container['books'] = $bookRepository->findAll();

$request = Request::createFromGlobals();

$context = new RequestContext();
$context->fromRequest($request);

$matcher = new UrlMatcher($routes, $context);

$path = $request->getPathInfo();

$parameters = $matcher->match($path);

$controller = explode('::', $parameters['_controller']);
$controllerName = $controller[0];
$actionName = $controller[1];
$controller = new $controllerName($container);
/** @var Response $response */
$response = $controller->$actionName($request, $parameters['name']);
$response->send();
