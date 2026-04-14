<?php

namespace App\core\product\app\mapping;

use App\core\product\app\dto\response\ProductResponse;
use App\core\product\model\Product;

final class ProductMapper
{
    private function __construct()
    {
    }

    public static function toProductResponse(Product $product): ProductResponse
    {
        return new ProductResponse(
            id: $product->getId(),
            name: $product->getName(),
            description: $product->getDescription(),
            presentationType: $product->getPresentationType()->type,
            concentrationUnit: $product->getConcentration()->unit,
            concentrationValue: $product->getConcentration()->value,
            addedDate: $product->getAddedDate()
        );
    }
}
