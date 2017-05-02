<?php
namespace Tests\ServiceProviders;
require_once __DIR__ . '/../../src/ServiceProviders/DoctrineServiceProvider.php';

use Doctrine\ORM\EntityManager;
use PHPUnit\Framework\TestCase;
use Pimple\Container;
use SweetFramework\ServiceProviders\DoctrineServiceProvider;

class DoctrineServiceProviderTest extends TestCase
{
    /** @test */
    function testEm()
    {
        $options = require __DIR__ . '/../../app/config/config.php';
        $container = new Container($options);
        $container->register(new DoctrineServiceProvider());

        $this->assertInstanceOf(
            EntityManager::class,
            $container['doctrine.em']
        );
    }
}
