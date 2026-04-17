<?php

namespace App\Core\Item\Application\Dto\Response;

use Carbon\Carbon;

readonly class ItemResponse
{
    public function __construct(
        public string $id,
        public string $productId,
        public string $inventoryId,
        public int    $totalQuantity,
        public int    $quantity,
        public Carbon $expirationDate,
        public Carbon $addedDate
    )
    {
    }
}
