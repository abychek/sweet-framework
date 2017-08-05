<?php

namespace SweetFramework\ServiceProviders;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use SweetFramework\Twig\TwigTemplateEngine;
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

        /** @var Environment $twig */
        $twig = $container['twig.environment'];

        $twig->addFunction(new \Twig_SimpleFunction('asset', function ($asset) {
            return sprintf('/src/resources/assets/%s', ltrim($asset, '/'));
        }));

        /**
         * @return TwigTemplateEngine
         */
        $container['template_engine'] = function () use ($container) {
            return new TwigTemplateEngine($container['twig.environment']);
        };
    }
}
