<?php

namespace App\Providers\Core\Catalog\Product\Wrapper;

readonly class ActiveIngredient
{
    public function __construct(
        public string   $name,
        public Strength $strength,
    )
    {
    }
}