<?php

namespace App\Core\Catalog\Product\Application\Dto\Response;

readonly class CompositionResponse
{
    public function __construct(
        public float $referenceAmount,
        /** @var array<int, ProductActiveIngredientResume> */
        public array $activeIngredients,
    )
    {
    }
}

