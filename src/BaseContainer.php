<?php

namespace SweetFramework;

use Pimple\Container;
use SweetFramework\ServiceProviders\DoctrineServiceProvider;
use SweetFramework\ServiceProviders\TwigServiceProvider;

class BaseContainer extends Container
{
    /**
     * Add service providers and application options.
     * @param array $arguments
     */
    public function __construct(array $arguments = [])
    {
        parent::__construct($arguments);
        $this->register(new DoctrineServiceProvider());
        $this->register(new TwigServiceProvider());
    }
}
