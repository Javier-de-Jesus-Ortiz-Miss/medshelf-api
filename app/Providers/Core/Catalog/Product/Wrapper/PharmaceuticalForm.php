<?php

namespace App\Providers\Core\Catalog\Product\Wrapper;

readonly class PharmaceuticalForm
{
    public function __construct(
        public string $name,
        public string $consumptionType,
    )
    {
    }
}