<?php

namespace App\Core\Item\Application\Dto\Request;

readonly class ConsumeItemRequest
{
    public function __construct(
        public string $itemId,
        public int    $quantity
    )
    {
    }
}
