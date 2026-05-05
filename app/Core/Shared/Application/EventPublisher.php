<?php

namespace App\Core\Shared\Application;

use App\Core\Shared\Domain\DomainEvent;

interface EventPublisher
{
    public function publish(DomainEvent ...$events): void;
}