<?php

namespace App\Core\Catalog\Product\Application\Dto\Response;

readonly class NetContentResponse
{
    public function __construct(
        public float  $value,
        public string $unit,
    ) {
    }
}

