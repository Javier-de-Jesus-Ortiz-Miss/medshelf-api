<?php

namespace App\Core\Catalog\Product\Model\Exception;

use App\Core\Shared\Domain\DomainException;

class CompositionException extends DomainException
{
    public static function emptyActiveIngredients(): self
    {
        return new self('The composition must have at least one active ingredient.');
    }

    public static function invalidReferenceAmount(): self
    {
        return new self('The composition must have at least one active ingredient.');
    }

}