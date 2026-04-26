<?php

namespace App\Core\Product\Model;

final readonly class Concentration
{
    public function __construct(
        public string $unit,
        public float  $value
    )
    {
    }
}
