<?php

namespace App\Core\Catalog\Product\Application\Dto\Request;

readonly class CompositionRequest
{
    public function __construct(
        public float $referenceAmount,
        /** @var array<int, ActiveIngredientRequest> */
        public array $activeIngredients,
    )
    {
    }
}

