<?php

namespace App\Core\Catalog\Product\Model\Exception;

use App\Core\Shared\Domain\DomainException;

class NetContentException extends DomainException
{

    public static function invalidValue(): self
    {
        return new self('Net content value must be greater than zero.');
    }
}