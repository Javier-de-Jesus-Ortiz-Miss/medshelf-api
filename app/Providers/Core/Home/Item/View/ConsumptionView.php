<?php

namespace App\Providers\Core\Home\Item\View;

readonly class ConsumptionView
{
    public function __construct(
        public string $id,
        public float  $amount,
        public string $consumedAt
    )
    {
    }
}