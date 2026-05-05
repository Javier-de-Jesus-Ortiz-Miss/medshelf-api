<?php

namespace App\Core\Catalog\Product\Application\Mapping;

use App\Core\Catalog\Product\Application\Dto\Response\CompositionResponse;
use App\Core\Catalog\Product\Application\Dto\Response\NetContentResponse;
use App\Core\Catalog\Product\Application\Dto\Response\PharmaceuticalFormResponse;
use App\Core\Catalog\Product\Application\Dto\Response\ProductActiveIngredientResume;
use App\Core\Catalog\Product\Application\Dto\Response\ProductResponse;
use App\Core\Catalog\Product\Application\Dto\Response\StrengthResponse;
use App\Core\Catalog\Product\Model\Product;
use App\Core\Catalog\Product\Model\ValueObject\ActiveIngredient;
use App\Core\Catalog\Product\Model\ValueObject\Composition;
use App\Core\Catalog\Product\Model\ValueObject\NetContent;
use App\Core\Catalog\Product\Model\ValueObject\PharmaceuticalForm;

final class ProductMapper
{
    private function __construct()
    {
    }

    public static function toResponse(Product $product): ProductResponse
    {
        return new ProductResponse(
            id: $product->getId(),
            name: $product->getName(),
            netContent: self::mapNetContent($product->getNetContent()),
            quantity: $product->getTotalQuantity(),
            pharmaceuticalForm: self::mapPharmaceuticalForm($product->getPharmaceuticalForm()),
            composition: self::mapComposition($product->getComposition()),
            createdAt: $product->getCreatedAt(),
        );
    }

    private static function mapNetContent(?NetContent $netContent): ?NetContentResponse
    {
        if (!$netContent) return null;

        return new NetContentResponse(
            value: $netContent->value,
            unit: $netContent->unit->symbol(),
        );
    }

    private static function mapPharmaceuticalForm(PharmaceuticalForm $form): PharmaceuticalFormResponse
    {
        return new PharmaceuticalFormResponse(
            name: $form->name,
            consumptionType: $form->consumptionType->value,
        );
    }

    private static function mapComposition(Composition $composition): CompositionResponse
    {
        return new CompositionResponse(
            referenceAmount: $composition->referenceAmount,
            activeIngredients: array_map(
                fn(ActiveIngredient $ingredient) => new ProductActiveIngredientResume(
                    name: $ingredient->name,
                    strength: new StrengthResponse(
                        value: $ingredient->strength->value,
                        unit: $ingredient->unit->symbol(),
                    ),
                ),
                $composition->activeIngredients
            ),
        );
    }
}
