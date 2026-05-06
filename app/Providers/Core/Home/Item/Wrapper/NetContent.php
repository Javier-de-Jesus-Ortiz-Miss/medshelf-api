<?php

namespace App\Providers\Core\Home\Item\Wrapper;

readonly class NetContent
{
    public function __construct(
        public float  $value,
        public string $unit,
    )
    {
    }
}