<?php

namespace App\Providers\Core\Home\Treatment\Detail;

use App\Providers\Core\Home\Treatment\Resume\ItemResume;
use App\Providers\Core\Home\Treatment\Resume\ProfileResume;

readonly class TreatmentDetail
{
    public function __construct(
        public string        $id,
        public ProfileResume $profile,
        public ItemResume    $item,
        public string        $status,
        public int           $frequencyValue,
        public string        $frequencyUnit,
        public float         $doseQuantity,
        public string        $startDate,
        public ?string       $endDate,
        public string        $createdAt,
    )
    {
    }
}
