<?php

namespace App\Core\Catalog\Product\Application\Dto\Response;

readonly class PharmaceuticalFormResponse
{
    public function __construct(
        public string $name,
        public string $consumptionType,
    ) {
    }
}

