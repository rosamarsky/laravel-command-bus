<?php
declare(strict_types=1);

namespace Rosamarsky\CommandBus;

use Illuminate\Support\ServiceProvider;

class CommandBusServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(Container::class, LaravelContainer::class);
        $this->app->bind(Inflector::class, NameInflector::class);
    }
}
