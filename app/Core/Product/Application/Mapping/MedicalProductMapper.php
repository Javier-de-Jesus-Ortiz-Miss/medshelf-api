<?php

namespace App\Core\Product\Application\Mapping;

use App\Core\Product\Application\Dto\Response\MedicalProductResponse;
use App\Core\Product\Model\MedicalProduct;

final class MedicalProductMapper
{
    private function __construct()
    {
    }

    public static function toProductResponse(MedicalProduct $product): MedicalProductResponse
    {
        return new MedicalProductResponse(
            id: $product->getId(),
            name: $product->getName(),
            description: $product->getDescription(),
            presentationType: $product->getPresentationType()->value,
            concentrationUnit: $product->getConcentration()->unit,
            concentrationValue: $product->getConcentration()->value,
            addedDate: $product->getAddedDate()
        );
    }
}
