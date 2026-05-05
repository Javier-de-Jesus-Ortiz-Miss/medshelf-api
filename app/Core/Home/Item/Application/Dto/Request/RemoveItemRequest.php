<?php

namespace App\Core\Home\Item\Application\Dto\Request;

readonly class RemoveItemRequest
{
    public function __construct(
        public string $itemId,
        public string $houseId
    )
    {
    }
}