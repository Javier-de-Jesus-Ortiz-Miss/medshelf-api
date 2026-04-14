<?php

namespace App\core\item\app\dto\response;

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
        public Carbon $addedDate,
    )
    {
    }
}
