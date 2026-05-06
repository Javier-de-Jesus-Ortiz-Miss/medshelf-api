<?php

namespace App\Core\Catalog\Product\Application\Dto\Request;

readonly class AddProductRequest
{
    public function __construct(
        public string             $name,
        public ?NetContentRequest $netContent,
        public ?int               $totalQuantity,
        public string             $pharmaceuticalForm,
        public CompositionRequest $composition,
    )
    {
    }
}
