<?php

namespace App\Core\Home\Item\Application\Dto\Response;

use Carbon\Carbon;

readonly class ItemResponse
{
    public function __construct(
        public string $id,
        public string $productId,
        public string $placeId,
        public float  $totalContent,
        public Carbon $expirationDate,
        public Carbon $createdAt,
    )
    {
    }
}
