<?php

namespace SweetFramework\ServiceProviders;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Twig_Loader_Filesystem as Loader;
use Twig_Environment as Environment;

class TwigServiceProvider implements ServiceProviderInterface
{
    /**
     * Register Twig's loader and environment
     * @param Container $container
     */
    public function register(Container $container)
    {
        //templates
        $container['twig.loader'] = function () use ($container) {
            return new Loader($container['twig']['loader_paths']);
        };

        //init
        $container['twig.environment'] = function () use ($container) {
            return new Environment(
                $container['twig.loader'],
                $container['twig']['options']
            );
        };
    }
}
