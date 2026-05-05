<?php

namespace App\Core\Catalog\Product\Model\ValueObject;

use App\Core\Catalog\Product\Model\Exception\CompositionException;

readonly class Composition
{
    public function __construct(
        public float $referenceAmount,
        /* @var array<int, ActiveIngredient> $activeIngredients */
        public array $activeIngredients,
    )
    {
        if (empty($this->activeIngredients)) {
            throw CompositionException::emptyActiveIngredients();
        }
        if ($this->referenceAmount <= 0) {
            throw CompositionException::invalidReferenceAmount();
        }
    }
}