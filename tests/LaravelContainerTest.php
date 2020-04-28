<?php
declare(strict_types=1);

namespace Rosamarsky\CommandBus\Tests;

use Illuminate\Container\Container;
use Rosamarsky\CommandBus\LaravelContainer;
use PHPUnit_Framework_TestCase;

class User
{
    public $name = 'Roman';
}

class LaravelContainerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var LaravelContainer
     */
    private $container;

    public function setUp()
    {
        $this->container = new LaravelContainer(new Container());
    }

    /**
     * @test
     */
    public function should_make_class()
    {
        $user = $this->container->make(User::class);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals('Roman', $user->name);
    }

    /**
     * @test
     * @expectedException \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function should_throw_exception_on_nonexistent_class()
    {
        $this->container->make('NonexistentClass');
    }
}
