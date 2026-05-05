<?php

namespace App\Core\Home\Item\Application\Dto\Response;

use Carbon\Carbon;

readonly class ConsumptionResponse
{
    public function __construct(
        public string $id,
        public string $itemId,
        public int    $amount,
        public Carbon $consumedAt,
    )
    {
    }
}
