<?php

namespace App\Core\Item\Application\Dto\Request;

use Carbon\Carbon;

readonly class AddItemRequest
{
    public function __construct(
        public string $productId,
        public string $storageUnitId,
        public string $quantity,
        public Carbon $expirationDate
    )
    {
    }
}
