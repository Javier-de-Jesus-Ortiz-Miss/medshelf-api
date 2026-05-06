<?php

namespace App\Core\Catalog\Product\Model\Exception;

use App\Core\Shared\Domain\DomainException;

class ActiveIngredientException extends DomainException
{

    public static function invalidStrength(): self
    {
        return new self('The strength of the active ingredient must be greater than zero.');
    }
}