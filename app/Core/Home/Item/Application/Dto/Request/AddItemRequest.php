<?php

namespace App\Core\Home\Item\Application\Dto\Request;

use Carbon\Carbon;

readonly class AddItemRequest
{
    public function __construct(
        public string $productId,
        public string $placeId,
        public Carbon $expirationDate,
        public string $houseId,
    )
    {
    }
}
