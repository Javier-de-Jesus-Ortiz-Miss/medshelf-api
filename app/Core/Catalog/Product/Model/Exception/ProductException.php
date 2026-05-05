<?php

namespace App\Core\Catalog\Product\Model\Exception;

use App\Core\Shared\Domain\DomainException;

class ProductException extends DomainException
{

    public static function netContentNotAllowedForUnitaryProducts(): self
    {
        return new self('Net content is not allowed for unitary products.');
    }

    public static function quantityRequiredForUnitaryProducts(): self
    {
        return new self('Quantity required for unitary products.');
    }

    public static function quantityNotAllowedForDoseProducts(): self
    {
        return new self('Quantity not allowed for dose products.');
    }

    public static function netContentRequiredForDoseProducts(): self
    {
        return new self('Net content required for dose products.');
    }

    public static function netContentLessThanCompositionReferenceAmount(): self
    {
        return new self('Net content must be greater than or equal to the composition reference amount.');
    }
}