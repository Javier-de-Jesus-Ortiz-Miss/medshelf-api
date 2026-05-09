<?php

namespace App\Core\Catalog\Product\Model\ValueObject;

use App\Core\Catalog\Product\Model\Exception\ActiveIngredientException;

readonly class ActiveIngredient
{
    public function __construct(
        public string   $name,
        public Strength $strength,
    )
    {
        if ($this->strength->value <= 0) {
            throw ActiveIngredientException::invalidStrength();
        }
    }
}
