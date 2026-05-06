<?php

namespace App\Providers\Core\Home\Item\Resume;

readonly class ItemResume
{
    public function __construct(
        public string        $id,
        public ProductResume $product,
    )
    {
    }
}