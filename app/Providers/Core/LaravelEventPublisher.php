<?php

namespace App\Providers\Core;

use App\Core\Shared\Application\EventPublisher;
use Illuminate\Events\Dispatcher;

final readonly class LaravelEventPublisher implements EventPublisher
{
    public function __construct(
        private Dispatcher $dispatcher
    )
    {
    }

    public function publish(object ...$events): void
    {
        foreach ($events as $event) {
            $this->dispatcher->dispatch($event);
        }
    }
}