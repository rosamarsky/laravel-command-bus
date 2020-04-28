<?php
declare(strict_types=1);

namespace Rosamarsky\CommandBus;

class CommandBus
{
    /**
     * @var Container
     */
    private $container;

    /**
     * @var Inflector
     */
    private $inflector;

    /**
     * Create a new CommandBus
     *
     * @param Container $container
     * @param Inflector $inflector
     */
    public function __construct(Container $container, Inflector $inflector)
    {
        $this->container = $container;
        $this->inflector = $inflector;
    }

    /**
     * Execute a Command by passing it to a Handler
     *
     * @param Command $command
     * @return mixed
     */
    public function execute(Command $command)
    {
        return $this->handler($command)->handle($command);
    }

    /**
     * Get the Command Handler
     *
     * @param Command $command
     * @return Handler
     */
    private function handler(Command $command): Handler
    {
        $class = $this->inflector->inflect($command);

        return $this->container->make($class);
    }
}
