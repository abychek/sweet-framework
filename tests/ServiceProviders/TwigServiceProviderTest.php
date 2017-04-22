<?php

namespace Tests\ServiceProviders;
require_once __DIR__ . '/../../src/ServiceProviders/TwigServiceProvider.php';
use PHPUnit\Framework\TestCase;
use Pimple\Container;
use SweetFramework\ServiceProviders\TwigServiceProvider;
use Twig_Loader_Filesystem as Loader;
use Twig_Environment as Environment;

class TwigServiceProviderTest extends TestCase
{
    /** @test */
    function testTwig()
    {
        $options = require __DIR__ . '/../../config.php';
        $container = new Container($options);
        $container->register(new TwigServiceProvider());

        $this->assertInstanceOf(
            Loader::class,
            $container['twig.loader']
        );
        $this->assertInstanceOf(
            Environment::class,
            $container['twig.environment']
        );
    }
}
