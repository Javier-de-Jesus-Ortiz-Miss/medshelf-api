<?php

namespace App\Core\Item\Application\Dto\Request;

use Carbon\Carbon;

readonly class AddMedicalItemRequest
{
    public function __construct(
        public string $medicalProductId,
        public string $placeId,
        public string $totalQuantity,
        public Carbon $expirationDate
    )
    {
    }
}
