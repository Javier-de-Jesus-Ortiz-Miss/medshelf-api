<?php

namespace App\Core\Item\Application\Dto\Response;

use App\Core\Item\Application\Dto\Data\MedicalProductResume;
use App\Core\Item\Application\Dto\Data\StorageUnitResume;
use Carbon\Carbon;

readonly class MedicalItemViewResponse
{
    public function __construct(
        public string               $id,
        public MedicalProductResume $medicalProduct,
        public StorageUnitResume    $storageUnit,
        public int                  $totalQuantity,
        public int                  $availableQuantity,
        public Carbon               $expirationDate,
        public Carbon               $addedDate
    )
    {
    }
}
