<?php

namespace App\Core\Home\Item\Application\Exception;

use App\Core\Shared\Domain\DomainException;

class ProductNotFound extends DomainException
{
    public function __construct(string $productId)
    {
        parent::__construct("Product with id $productId not found");
    }
}