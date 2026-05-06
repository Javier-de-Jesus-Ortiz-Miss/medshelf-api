<?php

namespace App\Core\Catalog\Product\Model\Exception;

use App\Core\Shared\Domain\DomainException;

class StrengthException extends DomainException
{

    public static function invalidValue(): self
    {
        return new self('The strength value must be greater than zero.');
    }
}