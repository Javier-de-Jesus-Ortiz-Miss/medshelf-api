<?php

namespace App\Providers\Core\Catalog\Product\View;

use App\Core\Shared\Domain\PaginableByCursor;
use App\Providers\Core\Catalog\Product\Wrapper\NetContent;
use App\Providers\Core\Catalog\Product\Wrapper\PharmaceuticalForm;

readonly class ProductView implements PaginableByCursor
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

    public function getCursor(): string
    {
        return $this->id;
    }
}