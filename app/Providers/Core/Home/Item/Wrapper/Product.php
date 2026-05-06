<?php

namespace App\Providers\Core\Home\Item\Wrapper;

class Product
{
    public function __construct(
        public string             $id,
        public string             $name,
        public ?NetContent        $netContent,
        public ?int               $totalQuantity,
        public PharmaceuticalForm $pharmaceuticalForm,
    )
    {
    }
}