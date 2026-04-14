<?php

namespace App\core\item\app\dto\request;

use Carbon\Carbon;

readonly class AddItemRequest
{
    public function __construct(
        public string $productId,
        public string $inventoryId,
        public string $quantity,
        public Carbon $expirationDate
    )
    {
    }
}
