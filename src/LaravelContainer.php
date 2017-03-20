<?php

namespace Rosamarsky\CommandBus;

use Illuminate\Container\Container as IoC;

class LaravelContainer implements Container
{
    /**
     * @var Container
     */
    private $container;

    /**
     * Create a new LaravelContainer
     *
     * @param IoC $container
     */
    public function __construct(IoC $container)
    {
        $this->container = $container;
    }

    /**
     * Resolve the class out of the Container
     *
     * @param string $class
     * @return mixed
     */
    public function make($class)
    {
        return $this->container->make($class);
    }
}