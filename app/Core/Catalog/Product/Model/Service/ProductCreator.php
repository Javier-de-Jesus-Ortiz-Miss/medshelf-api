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
        ?int               $totalQuantity,
        PharmaceuticalForm $pharmaceuticalForm,
        Composition        $composition,
    ): Product
    {
        if ($pharmaceuticalForm->consumptionType === ConsumptionType::DISCRETE) {
            if ($netContent) {
                throw ProductException::netContentNotAllowedForDiscreteProducts();
            }
            if ($totalQuantity === null) {
                throw ProductException::quantityRequiredForDiscreteProducts();
            }
        }

        if ($pharmaceuticalForm->consumptionType === ConsumptionType::CONTINUOUS
            || $pharmaceuticalForm->consumptionType === ConsumptionType::APPLICABLE) {
            if ($totalQuantity !== null) {
                throw ProductException::quantityNotAllowedForContinuousOrApplicableProducts();
            }
            if (!$netContent) {
                throw ProductException::netContentRequiredForContinuousOrApplicableProducts();
            }
        }

//        if ($netContent && $netContent->value < $composition->referenceAmount) {
//            throw ProductException::netContentLessThanCompositionReferenceAmount();
//        }

//        if (count($composition->activeIngredients) === 1) {
//            $activeIngredient = $composition->activeIngredients[0];
//            if ($composition->referenceAmount !== $activeIngredient->strength->value) {
//                throw ProductException::compositionReferenceAmountMustEqualActiveIngredientStrengthForSingleIngredientProducts();
//            }
//        }

        return Product::create(
            name: $name,
            netContent: $netContent,
            totalQuantity: $totalQuantity,
            pharmaceuticalForm: $pharmaceuticalForm,
            composition: $composition,
        );
    }
}

