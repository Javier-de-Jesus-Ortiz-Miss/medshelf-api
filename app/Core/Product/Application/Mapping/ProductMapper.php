<?php

namespace App\Core\Product\Application\Mapping;

use App\Core\Product\Application\Dto\Response\ProductResponse;
use App\Core\Product\Model\Product;

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
