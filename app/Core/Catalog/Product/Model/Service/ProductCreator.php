<?php

namespace App\Core\Catalog\Product\Model\Service;

use App\Core\Catalog\Product\Model\Exception\ProductException;
use App\Core\Catalog\Product\Model\Product;
use App\Core\Catalog\Product\Model\ValueObject\Composition;
use App\Core\Catalog\Product\Model\ValueObject\ConsumptionType;
use App\Core\Catalog\Product\Model\ValueObject\NetContent;
use App\Core\Catalog\Product\Model\ValueObject\PharmaceuticalForm;

final class ProductCreator
{
    public function __construct()
    {
    }

    public static function create(
        string             $name,
        ?NetContent        $netContent,
        ?int               $quantity,
        PharmaceuticalForm $pharmaceuticalForm,
        Composition        $composition,
    ): Product
    {
        if ($pharmaceuticalForm->consumptionType === ConsumptionType::UNITARY) {
            if ($netContent) {
                throw ProductException::netContentNotAllowedForUnitaryProducts();
            }
            if ($quantity === null) {
                throw ProductException::quantityRequiredForUnitaryProducts();
            }
        }

        if ($pharmaceuticalForm->consumptionType === ConsumptionType::DOSE) {
            if ($quantity !== null) {
                throw ProductException::quantityNotAllowedForDoseProducts();
            }
            if (!$netContent) {
                throw ProductException::netContentRequiredForDoseProducts();
            }
        }

        if ($netContent && $netContent->value < $composition->referenceAmount) {
            throw ProductException::netContentLessThanCompositionReferenceAmount();
        }

        return Product::create(
            name: $name,
            netContent: $netContent,
            quantity: $quantity,
            pharmaceuticalForm: $pharmaceuticalForm,
            composition: $composition,
        );
    }
}

