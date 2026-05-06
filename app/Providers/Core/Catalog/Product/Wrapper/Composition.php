<?php

namespace App\Providers\Core\Catalog\Product\Wrapper;

readonly class Composition
{
    public function __construct(
        public float $referenceAmount,
        /** @var array<int, ActiveIngredient> */
        public array $activeIngredients,
    )
    {
    }
}