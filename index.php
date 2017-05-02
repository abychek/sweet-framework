<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/app/config/routing.php';

use Doctrine\ORM\EntityManager;
use SweetFramework\BaseContainer;
use SweetFramework\Twig\TwigTemplateEngine;
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

$bookRepository = $em->getRepository('SweetFramework\Repository\Book');

/** @var SweetFramework\Entity\Book[] $books */
$books = $bookRepository->findAll();

$container['template_engine'] = function () use ($container) {
    return new TwigTemplateEngine($container['twig.environment']);
};

/** @var TwigTemplateEngine $template */
$template = $container['template_engine'];
echo  $template->render('books.html', array('books' => $books));


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

