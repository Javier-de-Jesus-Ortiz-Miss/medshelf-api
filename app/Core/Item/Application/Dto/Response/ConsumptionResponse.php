<?php

namespace App\Core\Item\Application\Dto\Response;

use Carbon\Carbon;

readonly class ConsumptionResponse
{
    public function __construct(
        public string $id,
        public string $medicalItemId,
        public int    $amount,
        public Carbon $consumptionDate,
    )
    {
    }
}
