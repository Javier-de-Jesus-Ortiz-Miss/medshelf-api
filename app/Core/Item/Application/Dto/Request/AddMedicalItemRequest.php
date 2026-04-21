<?php

namespace App\Core\Item\Application\Dto\Request;

use Carbon\Carbon;

readonly class AddMedicalItemRequest
{
    public function __construct(
        public string $medicalProductId,
        public string $storageUnitId,
        public string $totalQuantity,
        public Carbon $expirationDate
    )
    {
    }
}
