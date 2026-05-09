<?php

namespace App\Providers\Core\Catalog\Product\Detail;

use App\Providers\Core\Catalog\Product\Wrapper\Composition;
use App\Providers\Core\Catalog\Product\Wrapper\NetContent;
use App\Providers\Core\Catalog\Product\Wrapper\PharmaceuticalForm;

class ProductDetail
{
    public function __construct(
        public string             $id,
        public string             $name,
        public ?NetContent        $netContent,
        public ?float             $totalQuantity,
        public PharmaceuticalForm $pharmaceuticalForm,
        public string             $createdAt,
        public Composition        $composition,
    )
    {
    }
}