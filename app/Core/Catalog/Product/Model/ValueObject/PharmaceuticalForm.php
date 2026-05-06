<?php

namespace App\Core\Catalog\Product\Model\ValueObject;

readonly class PharmaceuticalForm
{
    public function __construct(
        public string          $name,
        public ConsumptionType $consumptionType,
    )
    {
    }
}