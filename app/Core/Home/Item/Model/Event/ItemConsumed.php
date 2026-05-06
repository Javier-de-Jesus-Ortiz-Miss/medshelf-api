<?php

namespace App\Core\Home\Item\Model\Event;

use App\Core\Shared\Domain\DomainEvent;

readonly class ItemConsumed extends DomainEvent
{
    public function __construct(
        public string $itemId,
        public float  $amount
    )
    {
        parent::__construct();
    }
}