<?php

namespace App\Core\Catalog\Product\Application\Dto\Request;

readonly class AddProductRequest
{
    public function __construct(
        public string                    $name,
        public ?NetContentRequest        $netContent,
        public ?int                      $totalQuantity,
        public PharmaceuticalFormRequest $pharmaceuticalForm,
        public CompositionRequest        $composition,
    )
    {
    }
}
