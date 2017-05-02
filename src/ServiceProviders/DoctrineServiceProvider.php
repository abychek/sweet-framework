<?php

namespace SweetFramework\ServiceProviders;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class DoctrineServiceProvider implements ServiceProviderInterface
{
    /**
     * Register Doctrine's entity manager
     * @param Container $container
     */
    public function register(Container $container)
    {
        $container['doctrine.em'] = function () use ($container) {
            $configuration = Setup::createAnnotationMetadataConfiguration(
                $container['doctrine']['mapping_dirs'],
                $container['doctrine']['dev_mode']
            );
            $entityManager = EntityManager::create(
                $container['doctrine']['connection'], $configuration
            );

            return $entityManager;
        };
    }
}
