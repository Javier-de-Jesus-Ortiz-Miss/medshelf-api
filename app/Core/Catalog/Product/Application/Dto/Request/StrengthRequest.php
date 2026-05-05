<?php

namespace App\Core\Catalog\Product\Application\Dto\Request;

readonly class StrengthRequest
{
    public function __construct(
        public float  $value,
        public string $unit,
    ) {
    }
}

