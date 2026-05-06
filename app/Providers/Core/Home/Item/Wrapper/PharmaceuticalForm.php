<?php

namespace App\Providers\Core\Home\Item\Wrapper;

readonly class PharmaceuticalForm
{
    public function __construct(
        public string $name,
        public string $consumptionType,
    )
    {
    }
}