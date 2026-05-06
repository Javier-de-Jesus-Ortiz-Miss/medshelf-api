<?php

namespace App\Providers\Core\Home\Item\Detail;

use App\Providers\Core\Home\Item\Resume\PlaceResume;
use App\Providers\Core\Home\Item\Wrapper\Product;

readonly class ItemDetail
{
    public function __construct(
        public string      $id,
        public Product     $product,
        public PlaceResume $place,
        public float       $availableContent,
        public string      $expirationDate,
        public string      $createdAt,
    )
    {
    }
}