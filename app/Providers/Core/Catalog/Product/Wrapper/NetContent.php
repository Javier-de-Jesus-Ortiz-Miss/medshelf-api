<?php

namespace App\Providers\Core\Catalog\Product\Wrapper;

readonly class NetContent
{
    public function __construct(
        public float  $value,
        public string $unit,
    )
    {
    }
}