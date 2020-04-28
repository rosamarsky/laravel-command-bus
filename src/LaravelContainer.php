<?php
declare(strict_types=1);

namespace Rosamarsky\CommandBus;

use Illuminate\Container\Container as IoC;
use Illuminate\Container\EntryNotFoundException;
use Illuminate\Contracts\Container\BindingResolutionException;

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
     *
     * @return mixed
     * @throws BindingResolutionException|EntryNotFoundException
     */
    public function make(string $class)
    {
        return $this->container->make($class);
    }
}
