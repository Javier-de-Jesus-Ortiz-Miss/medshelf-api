<?php

namespace App\Core\Home\Item\Model;

use App\Core\Home\Item\Model\ValueObject\ConsumptionType;

readonly class Product
{
    public function __construct(
        public string          $id,
        public ?float          $contentValue,
        public ?int            $totalQuantity,
        public ConsumptionType $consumptionType,
    )
    {
    }
}