<?php

namespace App\Core\Catalog\Product\Application\Dto\Response;

use Carbon\Carbon;

readonly class ProductResponse
{
    public function __construct(
        public string                     $id,
        public string                     $name,
        public ?NetContentResponse        $netContent,
        public ?int                       $totalQuantity,
        public PharmaceuticalFormResponse $pharmaceuticalForm,
        public CompositionResponse        $composition,
        public Carbon                     $createdAt,
    )
    {
    }
}
