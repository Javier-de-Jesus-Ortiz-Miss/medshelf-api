<?php

namespace App\Core\Catalog\Product\Application\Dto\Request;

readonly class PharmaceuticalFormRequest
{
    public function __construct(
        public string $name,
        public string $consumptionType,
    ) {
    }
}

