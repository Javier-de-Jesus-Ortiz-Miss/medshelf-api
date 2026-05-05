<?php

namespace App\Providers\Core\Home\Item\View;

use App\Providers\Core\Home\Item\Resume\ProductResume;

readonly class ItemView
{
    public function __construct(
        public string        $id,
        public ProductResume $product,
        public string        $expirationDate,
    )
    {
    }
}