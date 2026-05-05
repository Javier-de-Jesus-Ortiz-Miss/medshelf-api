<?php

namespace App\Providers\Core\Catalog\Product\View;

use App\Providers\Core\Catalog\Product\Wrapper\NetContent;
use App\Providers\Core\Catalog\Product\Wrapper\PharmaceuticalForm;

readonly class ProductView
{
    public function __construct(
        public string             $id,
        public string             $name,
        public ?NetContent        $netContent,
        public ?float             $totalQuantity,
        public PharmaceuticalForm $pharmaceuticalForm
    )
    {
    }
}