<?php

namespace App\Core\Shared\Application;

interface EventPublisher
{
    public function publish(object ...$events): void;
}