<?php

require_once __DIR__ . '/src/ServiceProviders/DoctrineServiceProvider.php';
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Pimple\Container;
use SweetFramework\ServiceProviders\DoctrineServiceProvider;

$options = require __DIR__ . '/config.php';
$container = new Container($options);
$container->register(new DoctrineServiceProvider());
$em = $container['doctrine.em'];
return ConsoleRunner::createHelperSet($em);