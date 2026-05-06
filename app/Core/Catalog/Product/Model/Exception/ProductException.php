<?php

namespace App\Core\Catalog\Product\Model\Exception;

use App\Core\Shared\Domain\DomainException;

class ProductException extends DomainException
{

    public static function netContentNotAllowedForDiscreteProducts(): self
    {
        return new self('Net content not allowed for discrete products.');
    }

    public static function quantityRequiredForDiscreteProducts(): self
    {
        return new self('Quantity required for discrete products.');
    }

    public static function quantityNotAllowedForContinuousOrApplicableProducts(): self
    {
        return new self('Quantity not allowed for continuous or applicable products.');
    }

    public static function netContentRequiredForContinuousOrApplicableProducts(): self
    {
        return new self('Net content required for continuous or applicable products.');
    }

    public static function netContentLessThanCompositionReferenceAmount(): self
    {
        return new self('Net content must be greater than or equal to the composition reference amount.');
    }

    public static function compositionReferenceAmountMustEqualActiveIngredientStrengthForSingleIngredientProducts(): self
    {
        return new self('For products with a single active ingredient, the composition reference amount must equal the active ingredient strength.');
    }
}