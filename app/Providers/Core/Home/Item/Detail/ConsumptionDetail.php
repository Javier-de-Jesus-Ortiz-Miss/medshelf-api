<?php

namespace App\Providers\Core\Home\Item\Detail;

use App\Providers\Core\Home\Item\Resume\ItemResume;

readonly class ConsumptionDetail
{
    public function __construct(
        public string     $id,
        public ItemResume $item,
        public float      $amount,
        public string     $consumedAt,
    )
    {
    }
}