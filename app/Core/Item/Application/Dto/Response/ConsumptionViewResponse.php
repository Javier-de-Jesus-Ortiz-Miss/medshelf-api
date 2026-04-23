<?php

namespace App\Core\Item\Application\Dto\Response;

use App\Core\Item\Application\Dto\Data\MedicalItemResume;
use Carbon\Carbon;

readonly class ConsumptionViewResponse
{
    public function __construct(
        public string            $id,
        public MedicalItemResume $medicalItem,
        public int               $amount,
        public Carbon            $consumptionDate,
    )
    {
    }
}
