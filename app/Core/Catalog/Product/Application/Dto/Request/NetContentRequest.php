<?php

namespace App\Core\Catalog\Product\Application\Dto\Request;

readonly class NetContentRequest
{
    public function __construct(
        public float  $value,
        public string $unit,
    ) {
    }
}

