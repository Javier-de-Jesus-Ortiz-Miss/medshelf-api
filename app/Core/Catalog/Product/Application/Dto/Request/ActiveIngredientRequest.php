<?php

namespace App\Core\Catalog\Product\Application\Dto\Request;

readonly class ActiveIngredientRequest
{
    public function __construct(
        public string          $name,
        public StrengthRequest $strength,
    )
    {
    }
}
