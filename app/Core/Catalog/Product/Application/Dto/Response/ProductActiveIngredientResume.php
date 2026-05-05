<?php

namespace App\Core\Catalog\Product\Application\Dto\Response;

readonly class ProductActiveIngredientResume
{
    public function __construct(
        public string           $name,
        public StrengthResponse $strength,
    ) {
    }
}
