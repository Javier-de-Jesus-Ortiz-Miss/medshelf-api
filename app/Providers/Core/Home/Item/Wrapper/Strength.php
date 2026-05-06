<?php

namespace App\Providers\Core\Home\Item\Wrapper;

readonly class Strength
{
    public function __construct(
        public float  $value,
        public string $unit,
    )
    {
    }
}