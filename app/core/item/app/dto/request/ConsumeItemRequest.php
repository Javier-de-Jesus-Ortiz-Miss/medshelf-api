<?php

namespace App\core\item\app\dto\request;

readonly class ConsumeItemRequest
{
    public function __construct(
        public string $itemId,
        public int    $quantity
    )
    {
    }
}
