<?php

namespace App\Core\Item\Application\Dto\Response;

use Carbon\Carbon;

readonly class MedicalItemResponse
{
    public function __construct(
        public string $id,
        public string $medicalProductId,
        public string $storageUnitId,
        public int    $totalQuantity,
        public int    $availableQuantity,
        public Carbon $expirationDate,
        public Carbon $addedDate
    )
    {
    }
}
